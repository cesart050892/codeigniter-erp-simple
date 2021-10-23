<?php

namespace App\Models;

use CodeIgniter\Model;

class Tempdetailsinvoice extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'temp_details_invoice';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = \App\Entities\Tempdetailsinvoice::class;
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'token',
        'price',
        'quantity',
        'product_id'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    // Functions

    public function generate($token)
    {
        return $this->select('
            temp_details_invoice.token,
            products.description,
            temp_details_invoice.price,
            temp_details_invoice.quantity,
            users.`name`,
            users.surname,
            rols.rol 
        ')
        ->join('products','temp_details_invoice.product_id = products.id')
        ->join('users','products.user_id = users.id')
        ->join('rols','users.rol_id = rols.id')
        ->where('token',$token)
        ->findAll();
    }
}
