<?php

namespace App\Controllers\Api;

use App\Entities\Purchases as EntitiesPurchases;
use App\Models\DetailsPurchases;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Suppliers;
use App\Models\TempPurchases;
use CodeIgniter\RESTful\ResourceController;

class Purchases extends ResourceController
{

    protected $modelName    = 'App\Models\Purchases';
    protected $entity, $settings, $product, $details, $supplier;


    public function __construct()
    {
        $this->entity   = new EntitiesPurchases();
        $this->temp     = new TempPurchases();
        $this->details  = new DetailsPurchases();
        $this->product  = new Products();
        $this->settings = new Settings();
        $this->supplier = new Suppliers();
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
            'folio'   =>  'required|is_unique[purchases.folio]',
            'supplier'   =>  'required',
        ];

        if (!$this->validate($rules))
            return $this->failValidationErrors($this->validator->listErrors());
        $folio = $this->request->getPost('folio');
        $supplier = $this->request->getPost('supplier');
        if (!$supplier = $this->supplier->find($supplier))
            return $this->failNotFound('Supplier doesn\'t exist!.');
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
            'supplier_id'   => $this->request->getPost('supplier'),
            'user_id'       => session()->user_id
        ]);
        if (!$this->model->insert($this->entity))
            return $this->failValidationErrors($this->validator->listErrors());
        $this->temp->where('hash', $folio)->delete();
        $this->temp->purgeDeleted();
        foreach ($items as $item) {
            $product = $this->product->find($item->product_id);
            $product->stock += $item->quantity;
            $this->product->save($product);
            $data = [
                'folio' => $item->hash,
                'details' => $item->details,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
                'iva' => $item->iva,
                'total' => $item->iva + $item->subtotal,
                'purchase_id' => $this->model->insertID,
                'product_id' => $product->id,
            ];
            $this->details->insert($data);
        }
        return $this->respond([
            'data'  => [
                'folio'         => $folio,
                'supplier'      => $supplier->name,
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
