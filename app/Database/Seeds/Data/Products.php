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
                "cost"   => 11,
                "stock"   => 100,
                "total"   => 11 * 100,
                "price"   => 16,
                "user_id"   => 1
            ],
            [
                "description" => "Pepsi 500 ml",
                "cost"   => 12,
                "stock"   => 100,
                "total"   => 12 * 100,
                "price"   => 16,
                "user_id"   => 1
            ],
            [
                "description" => "7up 500 ml",
                "cost"   => 13,
                "stock"   => 100,
                "total"   => 13 * 100,
                "price"   => 16,
                "user_id"   => 1
            ],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Products($result);
            $model->insert($entity);
        }
    }
}
