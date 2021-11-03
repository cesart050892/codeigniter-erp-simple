<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Users');

        $data = [
            [
                'name'              => 'Cesar A.',
                'surname'           => 'Tapia',
                'fullname'          => 'Cesar A. Tapia',
                'address'           => 'Managua, Nicaragua',
                'rol_id'            => 2,
                'auth_id'           => 1
            ]
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Users($result);
            $model->insert($entity);
        }
    }
}
