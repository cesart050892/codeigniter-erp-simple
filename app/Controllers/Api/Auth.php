<?php

namespace App\Controllers\Api;

use App\Entities\Auth as EntitiesAuth;
use App\Entities\Users as UsersEntity;
use App\Models\Users as UsersModel;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $modelName = 'App\Models\Auth';

    public function store()
    {
        $rules = [
            'name'              => 'required|min_length[2]|max_length[50]',
            'surname'           => 'required|min_length[2]|max_length[50]',
            'username'          => 'required|min_length[2]|max_length[50]',
            'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[auth.email]',
            'password'          => 'required|min_length[4]|max_length[50]',
            'confirm_password'  => 'required|matches[password]'
        ];
        $messages =     [
            'username' => [
                'required' => 'All accounts must have {field} provided',
            ],
            'password' => [
                'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.'
            ],
            'surname' => [
                'required' => 'All accounts must have {field} provided'
            ]
        ];
        if (!$this->validate($rules, $messages)) {
            return $this->failValidationErrors($this->validator->listErrors());
        }
        $userModel  = new UsersModel();
        $userEntity = new UsersEntity();
        $authEntity = new EntitiesAuth();
        $authEntity->fill($this->request->getPost(['username', 'email', 'password']));
        if (!$this->model->save($authEntity)) {
            return $this->failValidationErrors($this->model->listErrors());
        }
        $userEntity->fill($this->request->getPost(['name', 'surname']));
        $userEntity->fill(['auth_id' => $this->model->insertID()]);
        if (!$userModel->save($userEntity)) {
            return $this->failValidationErrors($userModel->listErrors());
        }
        $user = $userModel->find($userModel->insertID());
        return $this->respondCreated([
            'message'   => 'created',
            'data'      => $user
        ]);
    }

    public function login()
    {
        $userModel = new UsersModel();
        $username = $this->request->getPost('username', FILTER_SANITIZE_STRING);
        $password = $this->request->getPost('password', FILTER_SANITIZE_STRING);
        $auth = $this->model->where('username', $username)->first();
        if (!$auth) {
            return $this->failNotFound('Username does not exist.');
        }
        if (!password_verify($password, $auth->password)) {
            return $this->failNotFound('Password is incorrect.');
        }
        $user = $userModel->where('auth_id', $auth->id)->first();
        $data = [
            'name' => "{$user->name} {$user->surname}",
            'email' => $auth->email,
        ];
        if (!$this->setSession($user, $auth)) {
            return $this->failServerError();
        };
        return $this->respond([
            'message'   => 'logged in',
            'data'      => $data
        ]);
    }

    private function setSession($user, $auth)
    {
        if ($user && $auth) {
            $data = [
                'id' => $user->id,
                'name' => "{$user->name} {$user->surname}",
                'email' => $auth->email,
                'isLoggedIn' => TRUE
            ];
            session()->set($data);
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session()->destroy();
        return $this->respond([
            'message'   => 'logout'
        ]);
    }
}
