<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Clients extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Clients', false);

        $data = [
            [
                "name"    => "Construct",
                "contact" => "Jose Perez",
                "email"   => "jperes@email.com",
                "user_id"   => 1
            ],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Clients($result);
            $model->insert($entity);
        }
    }
}
