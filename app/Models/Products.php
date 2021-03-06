<?php

namespace App\Models;

use App\Models\Purchases as ModelPurchase;
use App\Entities\Purchases as EntityPurchase;
use CodeIgniter\Model;

class Products extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'products';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = \App\Entities\Products::class;
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'code',
        'description',
        'cost',
        'price',
        'stock',
        'total',
        'non_inventoriable',
        'minimum',
        'photo',
        'state',
        'user_id'
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
}
