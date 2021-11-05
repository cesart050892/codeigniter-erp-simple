<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Companies extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Companies');

        $data = [
            [
                'name'          => 'Abarrotes',
                'unique_hash'   => uniqid(),
                'logo'          => null
            ]
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Companies($result);
            $model->insert($entity);
        }
    }
}
