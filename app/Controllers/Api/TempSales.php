<?php

namespace App\Controllers\Api;

use App\Entities\TempSales as EntitiesTempSales;
use App\Models\Products;
use App\Models\Settings;
use CodeIgniter\RESTful\ResourceController;

class TempSales extends ResourceController
{

    protected $modelName    = 'App\Models\TempSales';
    protected $entity, $settings, $product;

    public function __construct()
    {
        $this->entity = new EntitiesTempSales();
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
            'quantity'  =>  'required|integer',
            'price'     =>  'required|decimal',
            'iva'       =>  'required'
        ];
        if (!$this->validate($rules))
            return $this->failValidationErrors($this->validator->listErrors());
        if ($this->request->getPost('folio') != null) :
            $this->entity->hash = $this->request->getPost('folio');
        else :
            $this->entity->hash = uniqid();
        endif;
        $quantity = $this->request->getPost('quantity');
        $iva = $this->request->getPost('iva');
        $iva === 'true' ? $iva = $this->settings->option('iva')->value : $iva = 0;
        if (!$this->request->getPost('code')) {
            $this->entity->product_id = $this->request->getPost('product');
            if (!$product = $this->product->find($this->entity->product_id))
                return $this->failNotFound('Product doesn\'t exist!');
        } else {
            $code = $this->request->getPost('code');
            if (!$product = $this->product->where('code', $code)->first())
                return $this->failNotFound('Product doesn\'t exist!');
            $this->entity->product_id = $product->id;
        }
        $this->entity->price = $this->request->getPost('price');
        if ($result = $this->model->alreadyExist($this->entity->product_id, $this->entity->hash)) :
            $this->entity = $result;
            $this->entity->quantity += $quantity;
            $this->entity->subtotal = $this->entity->quantity * $this->entity->price;
            $this->entity->fill([
                'iva' =>  $this->entity->subtotal * $iva
            ]);
            $this->entity->total = $this->entity->subtotal * (1 + $iva);
        else :
            $this->entity->quantity = $quantity;
            $this->entity->subtotal = $this->entity->quantity * $this->entity->price;
            $this->entity->fill([
                'iva' =>  $this->entity->subtotal * $iva
            ]);
            $this->entity->total = $this->entity->subtotal * (1 + $iva);
        endif;
        if ($this->entity->quantity <= 0) {
            if ($this->entity->id)
                $this->model->delete($this->entity->id);
            $this->model->purgeDeleted();
            return $this->failValidationErrors('This quantity is lower than zero!');
        }

        if (!$this->model->save($this->entity))
            return $this->failValidationErrors($this->model->validator->ListErrors());
        return $this->respond([
            'message'   => 'save purchase folio',
            'data'      => [
                'folio'     => $this->entity->hash,
                'product'   => $product->description,
                'subtotal'  => $this->entity->subtotal,
                'iva'       => $this->entity->iva,
                'total'     => $this->entity->total
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
