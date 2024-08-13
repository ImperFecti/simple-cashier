<?php

namespace App\Controllers;

use App\Models\UserModel;
use Myth\Auth\Password;

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

    public function tablecashier()
    {
        $auth = service('authentication');
        $id = $auth->id();

        $cashier = $this->UserModel->getCashierUsers($id);

        $data = [
            'title' => 'Table Cashier',
            'cashier' => $cashier
        ];
        // dd($data);
        return view('pages/tablecashier', $data);
    }

    public function tambahcashier()
    {
        $authorize = service('authorization');

        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password_hash' => Password::hash($this->request->getPost('password')),
            'active' => 1
        ];

        $cashierModel = new UserModel();
        $cashierId = $cashierModel->insert($data, true);

        if ($cashierId) {
            $authorize->addUserToGroup($cashierId, config('Auth')->defaultUserGroup);
        }

        return redirect()->to('/tablecashier')->with('message', 'User successfully added.');
    }

    public function editcashier($id)
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'active' => $this->request->getPost('active')
        ];

        $this->UserModel->update($id, $data);
        return redirect()->to('/tablecashier')->with('message', 'User successfully updated.');
    }

    public function deletecashier()
    {
        $id = $this->request->getPost('id');

        $this->UserModel->delete($id);

        return redirect()->to('/tablecashier')->with('message', 'User successfully deleted.');
    }
}
