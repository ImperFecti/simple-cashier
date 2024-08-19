<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index(): string
    {
        $auth = service('authentication');
        if (!$auth->isLoggedIn()) {
            return redirect()->to('/login');
        }

        $userId = $auth->id();
        $user = $this->UserModel->find($userId);

        $data = [
            'title' => 'Home',
            'user' => $user
        ];

        return view('pages/index', $data);
    }
}
