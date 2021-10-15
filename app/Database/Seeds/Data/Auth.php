<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Auth extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Auth', false);

        $data = [
            [
                'email'         => 'admin@email.com',
                'username'      => 'admin',
                'password'      => 'admin'
            ]
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Auth($result);
            $model->insert($entity);
        }
    }
}
