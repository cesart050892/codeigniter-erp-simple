<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailsPurchases extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'details_purchases';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = \App\Entities\DetailsPurchases::class;
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'folio',
        'details',
        'price',
        'quantity',
        'subtotal',
        'iva',
        'total',
        'new_price',
        'new_stock',
        'purchase_id',
        'product_id',
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

    public function byFolio($folio)
    {
        return $this->select("
            products.`code`, 
            products.description, 
            details_purchases.quantity, 
            details_purchases.subtotal, 
            details_purchases.iva, 
            details_purchases.total
        ")
            ->join('products', 'details_purchases.product_id = products.id')
            ->where('folio', $folio)
            ->findAll();
    }
}
