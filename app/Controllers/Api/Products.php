<?php

namespace App\Controllers\Api;

use App\Entities\Products as EntitiesProducts;
use App\Models\Purchases;
use CodeIgniter\RESTful\ResourceController;

class Products extends ResourceController
{

    protected $modelName = 'App\Models\Products';
    protected $entity, $purchase;

    public function __construct()
    {
        $this->entity = new EntitiesProducts();
        $this->purchases = new Purchases();
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
            'description'   => 'min_length[2]|max_length[100]',
            'code'   => 'min_length[2]|max_length[100]',
        ];
        $messages =     [
            'description' => [
                'min_length' => 'Supplied value ({value}) for /{field}/ must have at least {param} characters.',
                'max_length' => 'Supplied value ({value}) for /{field}/ must have max. {param} characters.'
            ],
            'code' => [
                'min_length' => 'Supplied value ({value}) for {field} must have at least {param} characters.',
                'max_length' => 'Supplied value ({value}) for {field} must have max. {param} characters.'
            ]
        ];
        if (!$this->validate($rules, $messages))
            return $this->failValidationErrors($this->validator->listErrors());
        $this->entity->fill($this->request->getPost(['description', 'code'], FILTER_SANITIZE_STRING));
        $this->entity->user_id = session()->user_id;
        if ($file = $this->request->getFile('image')) {
            if ($this->validate([
                "image" => 'is_image[image]|max_size[image,1024]|permit_empty'
            ])) {
                if ($file->isValid()) {
                    if (!$name = $this->entity->saveImage($file))
                        return $this->failValidationErrors('Image is no valid!');
                    $this->entity->photo = $name;
                }
            }
        }
        if (!$this->model->save($this->entity))
            return $this->failValidationErrors($this->model->listErrors());
        return $this->respondCreated([
            'message'   => 'created',
            'data'      => [
                'name' => $this->entity->description,
                'photo' => $this->entity->photo
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
