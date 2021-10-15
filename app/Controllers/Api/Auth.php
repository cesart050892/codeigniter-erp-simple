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
            'username'          => 'required|min_length[2]|max_length[50]',
            'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[auth.email]',
            'password'          => 'required|min_length[4]|max_length[50]',
            'confirm_password'  => 'required|matches[password]'
        ];
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $userModel  = new UsersModel();
        $userEntity = new UsersEntity();
        $authEntity = new EntitiesAuth();
        $authEntity->fill($this->request->getPost(['username', 'email', 'password']));
        if (!$this->model->save($authEntity)) {
            return $this->failValidationErrors($this->model->getErrors());
        }
        $userEntity->fill($this->request->getPost(['name']));
        $userEntity->fill(['auth_id' => $this->model->insertID()]);
        if (!$userModel->save($userEntity)) {
            return $this->failValidationErrors($userModel->getErrors());
        }
        $user = $userModel->find($userModel->insertID());
        return $this->respondCreated([
            'message'   => 'created',
            'data'      => $user
        ]);
    }

    public function login()
    {
        $session = session();
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
        $session_data = [
            'id' => $user->id,
            'name' => "{$user->name} {$user->surname}",
            'email' => $auth->email,
            'isLoggedIn' => TRUE
        ];
        $session->set($session_data);
        unset($session_data['id']);
        unset($session_data['isLoggedIn']);
        return $this->respond([
            'message'   => 'logged in',
            'data'      => $session_data
        ]);
    }
}
