<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\UserModel;

class Absensi extends BaseController
{
    protected $userModel;
    protected $auth;
    protected $absenModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->auth = service('authentication');
        $this->absenModel = new AbsenModel();
    }

    public function index()
    {
        if (!$this->auth->check()) {
            return redirect()->to('/login');
        }

        $userId = $this->auth->id();
        $absensi = $this->absenModel->getAbsenWithUser($userId);

        $data = [
            'title' => 'Absensi Kasir',
            'absensi' => $absensi
        ];

        return view('pages/absensi', $data);
    }
}
