<?php

namespace App\Controllers\Api;

use App\Entities\Tempdetailsinvoice as EntitiesTempdetailsinvoice;
use App\Models\Products;
use CodeIgniter\RESTful\ResourceController;

class Tempdetailsinvoice extends ResourceController
{

    protected $modelName = 'App\Models\Tempdetailsinvoice';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
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
        $rules = [
            'product'           => 'required',
            'quantity'          => 'required',
        ];
        if (!$this->validate($rules))
            return $this->failValidationErrors($this->validator->listErrors());
        $model = new Products();
        $temp = new EntitiesTempdetailsinvoice();
        $product = $model->find($this->request->getPost('product'));
        $quantity = $this->request->getPost('quantity', FILTER_SANITIZE_STRING);
        if ($quantity > $product->stock)
            return $this->failValidationErrors("No stock, only {$product->stock}");
        $temp->fill(['quantity' => $quantity]);
        $temp->price = $product->price / (1 - 0.35);
        $temp->price = $this->roundup($temp->price,1);
        $temp->product_id = $product->id;
        if ($data = $this->request->getPost('token')) {
            $temp->token = $data;
            unset($data);
        } else {
            $temp->token = uniqid();
        }
        if (!$this->model->save($temp))
            return $this->failValidationErrors($this->model->listErrors());
        return $this->respondCreated([
            'message'   => 'created',
            'token'      => $temp->token
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
}
