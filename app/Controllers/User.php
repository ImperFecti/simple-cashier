<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function profile()
    {
        $auth = service('authentication');
        if (!$auth->check()) {
            return redirect()->to('/login');
        }

        $id = $auth->id();
        $user = $this->UserModel->getUserProfile($id);

        $data = [
            'title' => 'Profile',
            'user' => $user
        ];

        // dd($data);

        return view('pages/profile', $data);
    }
}
