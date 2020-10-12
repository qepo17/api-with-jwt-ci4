<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;
use CodeIgniter\I18n\Time;

class Auth extends ResourceController
{
    protected $modelName = 'App\Models\AuthModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->time = new Time();
        $this->auth = new AuthModel();
        $this->encrypter = \Config\Services::encrypter();
    }
    // ini tes postman
    public function index()
    {
        return $this->respond('aa', 200);
    }

    public function checkToken()
    {
        $encrypter = \Config\Services::encrypter();
        $secret_key = $encrypter->key;

        // ambil bearer token
        $post = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $post); // agar kata 'bearer' dalam token hilang
        $token = $arr[1]; // mengambil nilai token saja

        if ($token != null) {
            try {
                $decoded = JWT::decode($token, $secret_key, array('HS256'));
                if ($decoded) {
                    return true;
                }
            } catch (\Exception $e) {
                $verifyToken = $this->token->verifyToken($token);
                $no_induk = $verifyToken['no_induk'];
                $secret_key = $encrypter->key;
                $issuedat_claim = $this->time->getTimeStamp(); // dibuat pada
                $notbefore_claim = $issuedat_claim + 10; // waktu sebelum claim
                $expire_claim = $issuedat_claim + 3600; // waktu token habis

                $payload = [
                    'iat' => $issuedat_claim,
                    'nbf' => $notbefore_claim,
                    'exp' => $expire_claim,
                    'data' => [
                        'no_induk' => $no_induk
                    ]
                ];

                // access token
                $expire_at = $this->time->createFromTimeStamp($expire_claim, 'Asia/Jakarta', 'id_ID')->toDateTimeString();
                $access_token = JWT::encode($payload, $secret_key);
                $dataToken = [
                    'no_induk' => $no_induk,
                    'access_token' => $access_token,
                    'expire_at' => $expire_at,
                ];

                return $dataToken;
            }
        } else {
            return false;
        }
    }

    public function login()
    {
        $data = $this->request->getRawInput();
        $check_user = $this->auth->checkUser($data['no_induk']);

        if ($check_user != null) {
            if (password_verify($data['password'], $check_user['password'])) {
                $secret_key = $this->encrypter->key;

                $issuedat_claim = $this->time->getTimeStamp(); // dibuat pada
                $notbefore_claim = $issuedat_claim + 10; // waktu sebelum claim
                $expire_claim = $issuedat_claim + 3600; // waktu token habis

                $payload = [
                    'iat' => $issuedat_claim,
                    'nbf' => $notbefore_claim,
                    'exp' => $expire_claim,
                    'data' => [
                        'no_induk' => $check_user['no_induk']
                    ]
                ];

                // access token
                $expire_at = $this->time->createFromTimeStamp($expire_claim, 'Asia/Jakarta', 'id_ID')->toDateTimeString();
                $access_token = JWT::encode($payload, $secret_key);
                $dataToken = [
                    'no_induk' => $check_user['no_induk'],
                    'access_token' => $access_token,
                    'expire_at' => $expire_at,
                ];
                $post_token = $this->auth->insertAccessToken($dataToken);

                // refresh token
                $payload['exp'] = $expire_claim + (7 * (3600 * 24)); //7 hari waktu expired
                $expire_at_refresh = $this->time->createFromTimeStamp($payload['exp'], 'Asia/Jakarta', 'id_ID')->toDateTimeString();
                $refresh_token = JWT::encode($payload, $secret_key);
                $dataRefresh = [
                    'no_induk' => $check_user['no_induk'],
                    'refresh_token' => $refresh_token,
                    'expire_at' => $expire_at_refresh,
                ];
                $post_refresh = $this->auth->insertRefreshToken($dataRefresh);

                if ($post_token && $post_refresh) {
                    $output = [
                        'status' => 200,
                        'message' => 'Berhasil login',
                        'access_token' => $access_token,
                        'expire_at' => $expire_at,
                        'refresh_token' => $refresh_token,
                    ];

                    return $this->respond($output, 200);
                }
            } else {
                $output = [
                    'status' => 400,
                    'message' => 'Gagal login',
                ];
                return $this->respond($output, 200);
            }
        }
    }
}
