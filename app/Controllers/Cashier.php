<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Myth\Auth\Password;
use CodeIgniter\HTTP\ResponseInterface;

class Cashier extends BaseController
{
    protected $userModel;
    protected $auth;
    protected $authorize;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->auth = service('authentication');
        $this->authorize = service('authorization');
    }

    public function tablecashier(): string
    {
        $id = $this->auth->id();
        $cashiers = $this->userModel->getCashierUsers($id);

        $data = [
            'title' => 'Table Cashier',
            'cashier' => $cashiers
        ];

        return view('pages/tablecashier', $data);
    }

    public function tambahcashier(): ResponseInterface
    {
        // Validasi input
        if (!$this->validate([
            'username' => 'required|min_length[3]|max_length[30]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password_hash' => Password::hash($this->request->getPost('password')),
            'active' => 1
        ];

        $cashierId = $this->userModel->insert($data, true);

        if ($cashierId) {
            $this->authorize->addUserToGroup($cashierId, config('Auth')->defaultUserGroup);
        }

        return redirect()->to('/tablecashier')->with('message', 'User successfully added.');
    }

    public function editcashier($id): ResponseInterface
    {
        // Validasi input
        if (!$this->validate([
            'username' => 'required|min_length[3]|max_length[30]',
            'email' => 'required|valid_email',
            'active' => 'required|in_list[0,1]',
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'active' => $this->request->getPost('active')
        ];

        $this->userModel->update($id, $data);

        return redirect()->to('/tablecashier')->with('message', 'User successfully updated.');
    }

    public function deletecashier(): ResponseInterface
    {
        $id = $this->request->getPost('id');

        $this->userModel->delete($id);

        return redirect()->to('/tablecashier')->with('message', 'User successfully deleted.');
    }
}
