<?php

namespace App\Controllers\Api;

use App\Entities\Suppliers as EntitiesSuppliers;
use CodeIgniter\RESTful\ResourceController;

class Suppliers extends ResourceController
{

    protected $modelName = 'App\Models\Suppliers';
    protected $entity;

    public function __construct()
    {
        $this->entity = new EntitiesSuppliers();
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
        return $this->respond([
            'data' => $response
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
        if (!$entity = $this->model->find($id))
            return $this->failNotFound('it does not exist');
        return $this->respond([
            'data'  => $entity
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
        $rules = [
            'name'              => 'min_length[2]|max_length[50]',
            'contact'          => 'required|min_length[2]|max_length[50]',
            'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[clients.email]',
        ];
        $messages =     [
            'contact' => [
                'required' => 'All accounts must have {field} provided',
                'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.'
            ],
            'email' => [
                'required' => 'All accounts must have {field} provided',
                'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.'
            ]
        ];
        if (!$this->validate($rules, $messages))
            return $this->failValidationErrors($this->validator->listErrors());
        $supplier = new EntitiesSuppliers();
        $supplier->fill($this->request->getPost(['name', 'email', 'contact'], FILTER_SANITIZE_STRING));
        $supplier->user_id = session()->user_id;
        if (!$this->model->save($supplier))
            return $this->failValidationErrors($this->model->listErrors());
        $supplier = $this->model->find($this->model->insertID());
        return $this->respondCreated([
            'message'   => 'created',
            'data'      => $supplier
        ]);
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
            "name"              => "min_length[2]|max_length[50]",
            "contact"          => "required|min_length[2]|max_length[50]",
            "email"             => "required|min_length[4]|max_length[100]|valid_email|is_unique[clients.email,id,{$id}]",
        ];
        $messages =     [
            "contact" => [
                "required" => "All accounts must have {field} provided",
                "min_length" => "Supplied value ({value}) for {field} must have at least {param} characters."
            ],
            "email" => [
                "required" => "All accounts must have {field} provided",
                "min_length" => "Supplied value ({value}) for {field} must have at least {param} characters."
            ]
        ];
        if (!$this->validate($rules, $messages))
            return $this->failValidationErrors($this->validator->listErrors());
        $supplier = $this->model->find($id);
        $supplier->fill($this->request->getPost(['name', 'email', 'contact'], FILTER_SANITIZE_STRING));
        $supplier->user_id = session()->user_id;
        if (!$this->model->save($supplier))
            return $this->failValidationErrors($this->model->listErrors());
        return $this->respondUpdated([
            'message'   => 'updated',
            'data'      => $supplier
        ]);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        if (!$this->model->find($id))
            return $this->failNotFound();
        if (!$this->model->delete($id))
            return $this->failValidationErrors($this->model->ListErrors());
        $this->model->purgeDeleted();
        return $this->respond(array(
            'message'    => 'deleted'
        ));
    }
}
