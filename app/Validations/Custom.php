<?php

namespace App\Validations;

use App\Models\Users;
use Config\Database;

class Custom
{
    protected $model;

    public function __construct()
    {
        $this->model = new Users();
    }
    public function to_update(string $str, string $field, array $data): bool
    {
        [$field, $ignoreValue] = array_pad(explode(',', $field), 2, null);

        if (!$user = $this->model->find($ignoreValue))
            return false;
        $ignoreValue = $user->auth_id;
        $ignoreField = 'id';

        $db = Database::connect($data['DBGroup'] ?? null);

        $row = $db->table('auth')
            ->select('1')
            ->where($field, $str)
            ->limit(1);

        if (!empty($ignoreField) && !empty($ignoreValue) && !preg_match('/^\{(\w+)\}$/', $ignoreValue)) {
            $row = $row->where("{$ignoreField} !=", $ignoreValue);
        }

        return $row->get()->getRow() === null;
    }
}
