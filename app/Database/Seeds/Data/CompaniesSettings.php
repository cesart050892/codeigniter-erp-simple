<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class CompaniesSettings extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\CompaniesSettings');

        $data = [
            [
                'option'        => 'languague',
                'value'         => 'es',
                'state'         => 1,
                'company_id'    => 1
            ]
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\CompaniesSettings($result);
            $model->insert($entity);
        }
    }
}
