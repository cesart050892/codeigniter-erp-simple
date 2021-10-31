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
        'quantity',
        'subtotal',
        'iva',
        'total',
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

    public function alreadyExist($product = null, $hash)
    {
        return $this->select()
            ->where('hash', $hash)
            ->where('product_id', $product)
            ->first();
    }

    public function updateQuantity($entity)
    {
        $this->set('quantity', $entity->quantity);
        $this->set('subtotal', $entity->subtotal);
        $this->where('producto_id', $entity->product_id);
        $this->where('hash', $entity->hash);
        $this->update();
    }
}
