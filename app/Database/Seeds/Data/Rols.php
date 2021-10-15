<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Rols extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Rols', false);

        $data = [
            ['rol' => 'guest'],
            ['rol' => 'admin'],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Rols($result);
            $model->insert($entity);
        }
    }
}
