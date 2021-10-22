<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Products extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Products', false);

        $data = [
            [
                "description" => "Coca Cola 500 ml",
                "price"   => 12,
                "stock"   => 100,
                "supplier_id"    => 1,
                "user_id"   => 1
            ],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Products($result);
            $model->insert($entity);
        }
    }
}
