<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Myth\Auth\Password;
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

    public function editprofile()
    {
        $auth = service('authentication');
        if (!$auth->check()) {
            return redirect()->to('/login');
        }

        $id = $auth->id();
        $user = $this->UserModel->getUserProfile($id);

        $data = [
            'title' => 'Edit Profile',
            'user' => $user
        ];

        // dd($data);

        return view('pages/profile', $data);
    }

    public function updateprofile($id)
    {
        $rules = [
            'email' => 'required|valid_email',
            'namalengkap' => 'required',
            'username' => 'required',
            'alamat' => 'required',
            'nomorhp' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/profile')->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->UserModel->update($id, [
            'email' => $this->request->getVar('email'),
            'namalengkap' => $this->request->getVar('namalengkap'),
            'username' => $this->request->getVar('username'),
            'alamat' => $this->request->getVar('alamat'),
            'nomorhp' => $this->request->getVar('nomorhp')
        ]);

        session()->setFlashdata('success', 'Profile successfully updated');
        return redirect()->to('/profile');
    }

    public function ubahpassword()
    {
        $auth = service('authentication');
        if (!$auth->check()) {
            return redirect()->to('/login');
        }

        $id = $auth->id();
        $user = $this->UserModel->getUserProfile($id);

        $data = [
            'title' => 'Ubah Password',
            'user' => $user
        ];

        // dd($data);

        return view('pages/ubahpassword', $data);
    }

    public function updatepassword($id)
    {
        $rules = [
            'password' => 'required',
            'new_password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/ubahpassword')->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);
        $currentPassword = $this->request->getVar('password');

        if (!password::verify($currentPassword, $user['password_hash'])) {
            return redirect()->to('/ubahpassword')->with('error', 'Password lama tidak sesuai');
        }

        // Update password
        $newPassword = Password::hash($this->request->getVar('new_password')); // Hash new password
        $userModel->update($id, ['password_hash' => $newPassword]); // Update password in database

        session()->setFlashdata('success', 'Password successfully changed'); // Set success message
        return redirect()->to('/ubahpassword'); // Redirect to change password page
    }
}
