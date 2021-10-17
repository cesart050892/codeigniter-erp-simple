<?php

namespace App\Controllers\Api;

use App\Models\Auth;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    protected $modelName = 'App\Models\Users';

    public function __construct()
    {
        helper(['rol']);
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        if (!$response = $this->model->findAll())
            $this->failNotFound();
        return $this->respond(['data' => $response]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        if (!$user = $this->model->getOne($id))
            return $this->failNotFound('Username does not exist');
        return $this->respond([
            'data'  => $user
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
        $rules = [
            "name"      => "required|min_length[2]|max_length[50]",
            "surname"   => "required|min_length[2]|max_length[50]",
            "email"     => "required|min_length[4]|max_length[100]|valid_email|user_update[email,{$id}]",
            "username"  => "required|min_length[4]|max_length[100]|user_update[username,{$id}]",
        ];
        $messages = [
            "username" => [
                "min_length"    => "Supplied value ({value}) for {field} must have at least {param} characters."
            ]
        ];
        if (!$this->validate($rules, $messages))
            return $this->failValidationErrors($this->validator->listErrors());
        if (!$user = $this->model->find($id))
            return $this->failNotFound();
        $user->fill($this->request->getPost(['name', 'surname'], FILTER_SANITIZE_STRING));
        $authModel = new Auth();
        $auth = $authModel->find($user->auth_id);
        $auth->fill($this->request->getPost(['email', 'username'], FILTER_SANITIZE_STRING));
        if ($auth->hasChanged()) {
            if (!$authModel->save($auth)) {
                return $this->failValidationErrors($authModel->errors());
            }
        }
        if ($user->hasChanged()) {
            if (!$this->model->save($user)) {
                return $this->failValidationErrors($this->model->errors());
            }
        }
        return $this->respondUpdated([
            'message'   => 'update'
        ]);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        if (!$user = $this->model->find($id))
            return $this->failNotFound();
        if (session()->user_id == $id) {
            $this->actionDelete($user);
            session()->destroy();
        } else {
            if (!validate_access(['admin'], session()->user_id))
                return $this->failForbidden();
            $this->actionDelete($user);
        }
        return $this->respond(array(
            'message'    => 'deleted'
        ));
    }

    protected function actionDelete($user)
    {
        $model = new Auth();
        if (!$model->delete($user->auth_id))
            return $this->failValidationErrors($model->ListErrors());
        $model->purgeDeleted();
    }
}
