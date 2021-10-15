<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Sections extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Sections', false);

        $data = [
            ['section' => 'all'],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Sections($result);
            $model->insert($entity);
        }
    }
}
