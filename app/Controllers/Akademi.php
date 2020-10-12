<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;

use App\Models\AkademiModel;
use CodeIgniter\I18n\Time;

class Akademi extends ResourceController
{
    protected $modelName = 'App\Models\AkademiModel';
    protected $format    = 'json';

    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->time = new Time();
        $this->akademi = new AkademiModel();
    }

    public function index()
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
            return $this->respond($this->akademi->getMaster(), 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Token tidak valid',
            ];
            return $this->respond($output, 400);
        }
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

    public function show($akademiid = null)
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
            $show = $this->akademi->show($akademiid);
            if ($show) {
                return $this->respond($show, 200);
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
                'kelasid' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka dan tidak boleh angka 0'
                    ],
                ],
                'guruid' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka dan tidak boleh angka 0'
                    ],
                ],
                'mapelid' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka dan tidak boleh angka 0'
                    ],
                ],
            ])) {
                return $this->fail($this->validator->getErrors());
            } else {
                // this is main function to do
                $data = $this->request->getRawInput();
                $post = $this->akademi->insertMaster($data);

                if ($post) {
                    $output = [
                        'status' => 200,
                        'message' => 'Sukses menambahkan akademi',
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

    public function delete($akademiid = null)
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
            $delete = $this->akademi->deleteMaster($akademiid);

            if ($delete) {
                $output = [
                    'status' => 200,
                    'message' => 'Sukses menghapus akademi'
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

    public function update($akademiid = null)
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
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka dan tidak boleh angka 0'
                    ],
                ],
                'guruid' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka dan tidak boleh angka 0'
                    ],
                ],
                'mapelid' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'is_natural_no_zero' => 'Hanya diperbolehkan angka dan tidak boleh angka 0'
                    ],
                ],
            ])) {
                return $this->fail($this->validator->getErrors());
            } else {
                // this is main function to do
                $data = $this->request->getRawInput();
                $data['akademiid'] = $akademiid; // primary key table
                $update = $this->akademi->updateMaster($data);

                if ($update) {
                    $output = [
                        'status' => 200,
                        'message' => 'Sukses mengubah akademi'
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
}
