<?php

namespace App\Controllers\Api;

use App\Entities\Users as EntitiesUsers;
use App\Models\Auth;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    protected $modelName = 'App\Models\Users';
    protected $auth;

    public function __construct()
    {
        $this->auth = new Auth();
        $this->auth = new EntitiesUsers();
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
            return $this->failNotFound();
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
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function profile()
    {
        //
        if (!$user = $this->model->getOne(session()->user_id))
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
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
    }
}
