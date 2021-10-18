<?php

namespace App\Controllers\Api;

use App\Entities\Products as EntitiesProducts;
use CodeIgniter\RESTful\ResourceController;

class Products extends ResourceController
{

    protected $modelName = 'App\Models\Products';

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
            'description'       => 'min_length[2]|max_length[50]',
            'price'             => 'required',
            'supplier'          => 'required',
        ];
        $messages =     [
            'description' => [
                'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                'max_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.'
            ]
        ];
        if (!$this->validate($rules, $messages))
            return $this->failValidationErrors($this->validator->listErrors());
        $product = new EntitiesProducts();
        $product->fill($this->request->getPost(['description', 'price'], FILTER_SANITIZE_STRING));
        $product->supplier_id = $this->request->getPost('supplier');
        if ($data = $this->request->getPost('stock')) {
            $product->stock = $data;
            unset($data);
        }else{
            $product->stock = 1;
        }
        $product->user_id = session()->user_id;
        if (!$this->model->save($product))
            return $this->failValidationErrors($this->model->listErrors());
        $product = $this->model->find($this->model->insertID());
        return $this->respondCreated([
            'message'   => 'created',
            'data'      => $product
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
            'description'       => 'min_length[2]|max_length[50]',
            'price'             => 'required',
            'supplier'          => 'required',
        ];
        $messages =     [
            'description' => [
                'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                'max_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.'
            ]
        ];
        if (!$this->validate($rules, $messages))
            return $this->failValidationErrors($this->validator->listErrors());
        $product = $this->model->find($id);
        $product->fill($this->request->getPost(['description', 'price'], FILTER_SANITIZE_STRING));
        $product->supplier_id = $this->request->getPost('supplier');
        $product->user_id = session()->user_id;
        if (!$this->model->save($product))
            return $this->failValidationErrors($this->model->listErrors());
        return $this->respondUpdated([
            'message'   => 'updated',
            'data'      => $product
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
