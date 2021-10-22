<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Suppliers extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Suppliers', false);

        $data = [
            [
                "name"    => "Distribuidora Valle Verde",
                "contact" => "Carlos Perez",
                "email"   => "discarlos@email.com",
                "user_id"   => 1
            ],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Suppliers($result);
            $model->insert($entity);
        }
    }
}
