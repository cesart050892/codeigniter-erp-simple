<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'users';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = \App\Entities\Users::class;
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'name',
        'surname',
        'photo',
        'address',
        'phone',
        'state',
        'last_login',
        'auth_id',
        'rol_id',
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

    public function getOne($id)
    {
        return $this->select('
            users.id,
            users.`name`,
            users.surname,
            users.photo,
            users.address,
            users.phone,
            users.state,
            users.last_login,
            users.auth_id,
            auth.email,
            auth.username,
            auth.token,
            users.rol_id,
            rols.rol 
        ')
            ->join('rols', 'users.rol_id = rols.id')
            ->join('auth', 'users.auth_id = auth.id')
            ->where('users.id', $id)
            ->first();
    }
}
