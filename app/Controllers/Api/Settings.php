<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Settings extends ResourceController
{

    protected $modelName = 'App\Models\Settings';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $data = [];
        $result = $this->model->findAll();
        foreach ($result as $key => $value) {
            $data += [$value->option => $value->value];
        }
        return $this->respond([
            'data'  => $data
        ]);
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
        //
    }

    /**
     * Find a resource object from the model by key
     *
     * @return mixed
     */
    public function option($option = null)
    {
        //
        if (!$result = $this->model->where('option', $option)->first())
            return $this->failNotFound('This options not found!');
        return $this->respond([
            'data'  => [
                $result->option => $result->value
            ]
        ]);
    }
}
