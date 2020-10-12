<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;

use App\Models\SiswaModel;
use App\Models\AuthModel;
use CodeIgniter\I18n\Time;

class Siswa extends ResourceController
{
    protected $modelName = 'App\Models\SiswaModel';
    protected $format    = 'json';

    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->time = new Time();
        $this->siswa = new SiswaModel();
        $this->auth = new AuthModel();
    }

    public function index()
    {
        return $this->respond('aa', 200);
    }

    public function checkToken()
    {
        $secret_key = $this->encrypter->key;

        // ambil bearer token
        $post = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $post); // agar kata 'bearer' dalam token hilang
        $token = $arr[1]; // mengambil nilai token saja

        if ($token != null) {
            try {
                $decoded = JWT::decode($token, $secret_key, array('HS256')); // std class object
                if ($decoded) {
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function refreshToken()
    {
        $secret_key = $this->encrypter->key;

        // ambil bearer token
        $post = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $post); // agar kata 'bearer' dalam token hilang
        $refresh_token = $arr[1]; // mengambil nilai token saja

        if ($refresh_token != null) {
            try {
                $decoded = JWT::decode($refresh_token, $secret_key, array('HS256')); // std class object
                $json_decoded = json_decode(json_encode($decoded), true); // convert into json
                if ($decoded) {
                    $issuedat_claim = $this->time->getTimeStamp(); // dibuat pada
                    $notbefore_claim = $issuedat_claim + 10; // waktu sebelum claim
                    $expire_claim = $issuedat_claim + 3600; // waktu token habis

                    $payload = [
                        'iat' => $issuedat_claim,
                        'nbf' => $notbefore_claim,
                        'exp' => $expire_claim,
                        'data' => [
                            'no_induk' => $json_decoded['data']['no_induk'],
                        ]
                    ];

                    // access token
                    $expire_at = $this->time->createFromTimeStamp($expire_claim, 'Asia/Jakarta', 'id_ID')->toDateTimeString();
                    $access_token = JWT::encode($payload, $secret_key);
                    $dataToken = [
                        'no_induk' => $json_decoded['data']['no_induk'],
                        'access_token' => $access_token,
                        'expire_at' => $expire_at,
                    ];

                    return $dataToken;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function show($no_induk = null)
    {
        $grant_type = $this->request->getHeaderLine('Grant-Type');

        if ($grant_type == 'access_token') {
            $check_token = $this->checkToken();
        } else if ($grant_type == 'refresh_token') {
            $refresh_token = $this->refreshToken();
            return $this->respond($refresh_token, 200);
            die;
        }

        if ($check_token) {
            $get_siswa = $this->siswa->getMaster($no_induk);
            if ($get_siswa) {
                $decrypt_data = $this->siswa->decryptData($get_siswa);

                $siswa_data = [
                    'no_induk' => $get_siswa['no_induk'],
                    'kelasid' => $get_siswa['kelasid'],
                    'nama' =>  $decrypt_data['nama'],
                    'tempat_lahir' => $decrypt_data['tempat_lahir'],
                    'tanggal_lahir' =>  $get_siswa['tanggal_lahir'],
                    'agama' => $get_siswa['agama'],
                    'jenis_kelamin' => $get_siswa['jenis_kelamin'],
                    'alamat' => $decrypt_data['alamat'],
                    'email' => $decrypt_data['email'],
                    'no_hp' => $decrypt_data['no_hp'],
                    'foto' => $get_siswa['foto']
                ];

                $output = $siswa_data;

                return $this->respond($output, 200);
            } else {
                $output = [
                    'status' => 400,
                    'message' => 'Data tidak ditemukan'
                ];

                return $this->respond($output, 400);
            }
        } else {
            $output = [
                'status' => 400,
                'message' => 'Token tidak valid',
            ];
            return $this->respond($output, 400);
        }
    }

    public function create()
    {
        $grant_type = $this->request->getHeaderLine('Grant-Type');

        if ($grant_type == 'access_token') {
            $check_token = $this->checkToken();
        } else if ($grant_type == 'refresh_token') {
            $refresh_token = $this->refreshToken();
            return $this->respond($refresh_token, 200);
            die;
        }

        if ($check_token) {
            helper('form');

            if (!$this->validate([
                'no_induk' => [
                    'rules' => 'required|is_unique[mastersiswa.no_induk]',
                    'errors' => [
                        'is_unique' => 'No Induk sudah terdaftar'
                    ],
                ],
                'kelasid' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka'
                    ],
                ],
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'valid_date' => 'Hanya diperbolehkan tanggal'
                    ],
                ],
                'agama' => 'required',
                'jenis_kelamin' => 'required|string',
                'alamat' => 'required',
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'valid_email' => 'Nilai bukan email'
                    ],
                ],
                'no_hp' => [
                    'rules' => 'required|is_natural',
                    'errors' => [
                        'is_natural' => 'Hanya diperbolehkan angka'
                    ],
                ],
                'foto' => 'required',
            ])) {
                return $this->fail($this->validator->getErrors());
            } else {
                $data = $this->request->getRawInput();
                $post = $this->siswa->insertMaster($data);
                $post_auth = $this->auth->insertSiswa($data['no_induk']);

                if ($post && $post_auth) {
                    $output = [
                        'status' => 200,
                        'message' => 'Sukses menambahkan siswa',
                        'data' => $data
                    ];

                    return $this->respond($output, 200);
                }
            }
        } else {
            $output = [
                'status' => 400,
                'message' => 'Token tidak valid',
            ];
            return $this->respond($output, 400);
        }
    }

    public function update($no_induk = null)
    {
        $grant_type = $this->request->getHeaderLine('Grant-Type');

        if ($grant_type == 'access_token') {
            $check_token = $this->checkToken();
        } else if ($grant_type == 'refresh_token') {
            $refresh_token = $this->refreshToken();
            return $this->respond($refresh_token, 200);
            die;
        }

        if ($check_token) {
            helper('form');

            if (!$this->validate([
                'kelasid' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka'
                    ],
                ],
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'valid_date' => 'Hanya diperbolehkan tanggal'
                    ],
                ],
                'agama' => 'required',
                'jenis_kelamin' => 'required|string',
                'alamat' => 'required',
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'valid_email' => 'Nilai bukan email'
                    ],
                ],
                'no_hp' => [
                    'rules' => 'required|is_natural',
                    'errors' => [
                        'is_natural' => 'Hanya diperbolehkan angka'
                    ],
                ],
                'foto' => 'required',
            ])) {
                return $this->fail($this->validator->getErrors());
            } else {
                $data = $this->request->getRawInput();
                $data['no_induk'] = $no_induk;
                $update = $this->siswa->updateMaster($data);

                if ($update) {
                    $output = [
                        'status' => 200,
                        'message' => 'Sukses mengubah siswa',
                        'data' => $data
                    ];

                    return $this->respond($output, 200);
                } else {
                    $output = [
                        'status' => 400,
                        'message' => 'Data tidak ditemukan'
                    ];

                    return $this->respond($output, 400);
                }
            }
        } else {
            $output = [
                'status' => 400,
                'message' => 'Token tidak valid',
            ];
            return $this->respond($output, 400);
        }
    }

    public function delete($no_induk = null)
    {
        $grant_type = $this->request->getHeaderLine('Grant-Type');

        if ($grant_type == 'access_token') {
            $check_token = $this->checkToken();
        } else if ($grant_type == 'refresh_token') {
            $refresh_token = $this->refreshToken();
            return $this->respond($refresh_token, 200);
            die;
        }

        if ($check_token) {
            // this is main function to do
            $delete = $this->siswa->deleteMaster($no_induk);

            if ($delete) {
                $output = [
                    'status' => 200,
                    'message' => 'Sukses menghapus siswa'
                ];

                return $this->respond($output, 200);
            } else {
                $output = [
                    'status' => 400,
                    'message' => 'Data tidak ditemukan'
                ];

                return $this->respond($output, 400);
            }
        } else {
            $output = [
                'status' => 400,
                'message' => 'Token tidak valid',
            ];
            return $this->respond($output, 400);
        }
    }
}
