<?php

namespace App\Controllers\Api;

use App\Entities\TempPurchases as EntitiesTempPurchases;
use App\Models\Products;
use App\Models\Settings;
use CodeIgniter\RESTful\ResourceController;

class TempPurchases extends ResourceController
{

    protected $modelName    = 'App\Models\TempPurchases';
    protected $entity, $settings, $product;

    public function __construct()
    {
        $this->entity = new EntitiesTempPurchases();
        $this->product = new Products();
        $this->settings = new Settings();
    }

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
        $rules = [
            'product'   =>  'required',
            'quantity'  =>  'required'
        ];

        if (!$this->validate($rules))
            return $this->failValidationErrors($this->validator->listErrors());
        if ($this->request->getPost('folio') != null) :
            $this->entity->hash = $this->request->getPost('folio');
        else :
            $this->entity->hash = uniqid();
        endif;
        $quantity = $this->request->getPost('quantity');
        $iva = $this->settings->option('iva')->value;
        $this->entity->product_id = $this->request->getPost('product');
        $product = $this->product->find($this->entity->product_id);
        if ($this->model->alreadyExist($this->entity->product_id, $this->entity->hash)) :
            $this->entity->quantity = $product->quantity + $quantity;
            $this->entity->subtotal = $this->entity->quantity * $product->price;
            $this->entity->$iva = $this->entity->subtotal * $iva;
            $this->model->updateQuantity($this->entity);
        else :
            $this->entity->quantity = $quantity;
            $this->entity->subtotal = $this->entity->quantity * $product->price;
            $this->entity->fill([
                'iva' =>  $this->entity->subtotal * $iva
            ]);
            $this->model->save($this->entity);
        endif;
        return $this->respond([
            'message'   => 'save purchase folio',
            'data'      => [
                'folio'  => $this->entity->hash,
                'subtotal'  => $this->entity->subtotal
            ]
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
