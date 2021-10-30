<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class PivotRols extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\PivotRols', false);

        $data = [
            [
                'rol_id'            => 2,
                'section_id'        => 1,
                'permission_id'     => 1
            ],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\PivotRols($result);
            $model->insert($entity);
        }
    }
}
