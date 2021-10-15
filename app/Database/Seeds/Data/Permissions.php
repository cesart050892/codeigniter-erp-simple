<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Permissions extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Permissions', false);

        $data = [
            ['permission' => 'total'],
            ['permission' => 'create'],
            ['permission' => 'read'],
            ['permission' => 'update'],
            ['permission' => 'delete'],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Permissions($result);
            $model->insert($entity);
        }
    }
}
