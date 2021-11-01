<?php

namespace App\Controllers\Api;

use App\Entities\Sales as EntitiesSales;
use App\Models\Clients;
use App\Models\DetailsSales;
use App\Models\Products;
use App\Models\Settings;
use App\Models\TempSales;
use CodeIgniter\RESTful\ResourceController;

class Sales extends ResourceController
{
    protected $modelName    = 'App\Models\Sales';
    protected $entity, $settings, $product, $details, $supplier;


    public function __construct()
    {
        $this->entity   = new EntitiesSales();
        $this->temp     = new TempSales();
        $this->details  = new DetailsSales();
        $this->product  = new Products();
        $this->settings = new Settings();
        $this->client = new Clients();
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
        //
        $rules = [
            'folio'   =>  'required|is_unique[sales.folio]',
            'client'   =>  'required',
        ];

        if (!$this->validate($rules))
            return $this->failValidationErrors($this->validator->listErrors());
        $folio = $this->request->getPost('folio');
        $client = $this->request->getPost('client');
        if (!$client = $this->client->find($client))
            return $this->failNotFound('Client doesn\'t exist!.');
        if (!$items = $this->temp->where('hash', $folio)->findAll())
            return $this->failNotFound('Need to add items!.');
        $subtotal = 0;
        $iva = 0;
        foreach ($items as $item) {
            $iva +=  $item->iva;
            $subtotal += $item->subtotal;
        }
        $this->entity->fill([
            'folio'           => $folio,
            'iva'           => $iva,
            'subtotal'      => $subtotal,
            'total'         => $iva + $subtotal,
            'client_id'   => $this->request->getPost('client'),
            'user_id'       => session()->user_id
        ]);
        if (!$this->model->insert($this->entity))
            return $this->failValidationErrors($this->validator->listErrors());
        $this->temp->where('hash', $folio)->delete();
        $this->temp->purgeDeleted();
        foreach ($items as $item) {
            $product = $this->product->find($item->product_id);
            $product->stock -= $item->quantity;
            $product->total -= ($item->quantity * $product->cost);
            $this->product->save($product);
            $data = [
                'folio' => $item->hash,
                'details' => $item->details,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
                'iva' => $item->iva,
                'total' => $item->total,
                'new_stock' => $product->stock,
                'sale_id' => $this->model->insertID,
                'product_id' => $product->id,
            ];
            if(!$this->details->insert($data))
                return $this->failValidationErrors($this->details->validator->listErrors());
        }
        return $this->respond([
            'message'   => 'Now you must be add new sales price',
            'data'      => [
                'folio'         => $folio,
                'client'      => $client->name,
                'subtotal'      => number_format($subtotal, 2, '.', ','),
                'iva'           => number_format($iva, 2, '.', ','),
                'total'         => number_format($iva + $subtotal, 2, '.', ','),
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
