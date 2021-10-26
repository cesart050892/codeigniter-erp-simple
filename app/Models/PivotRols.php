<?php

namespace App\Models;

use CodeIgniter\Model;

class PivotRols extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'pivot_rols_sections_permissions';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = \App\Entities\PivotRols::class;
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['rol_id', 'section_id', 'permission_id'];

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

    public function getOne($id)
    {
        return $this->select('
            pivot_rols_sections_permissions.id,
            users.id AS `user`,
            rols.rol,
            permissions.permission,
            sections.section
        ')
            ->join('rols', 'pivot_rols_sections_permissions.rol_id = rols.id')
            ->join('permissions', 'pivot_rols_sections_permissions.permission_id = permissions.id')
            ->join('sections', 'pivot_rols_sections_permissions.section_id = sections.id')
            ->join('users', 'rols.id = users.rol_id')
            ->where('users.id', $id)
            ->findAll();
    }
}
