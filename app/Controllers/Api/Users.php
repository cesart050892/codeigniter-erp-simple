<?php

namespace App\Controllers\Api;

use App\Models\Auth;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    protected $modelName = 'App\Models\Users';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        if (!$response = $this->model->findAll()) {
            $this->failNotFound();
        }
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
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        try {
            if (!$user = $this->model->find($id)) {
                return $this->failNotFound();
            }
            $authModel = new Auth();
            if (!$authModel->delete($user->auth_id)) {
                return $this->failValidationErrors($authModel->ListErrors());
            }

            $authModel->purgeDeleted();
            return $this->respond(array(
                'message'    => 'Deleted'
            ));
        } catch (\Throwable $th) {
            //throw $th;
            return $this->failServerError();
        }
    }
}
