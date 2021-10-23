<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Settings extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Settings', false);

        $data = [
            [
                'option'	=> 'ruc',
                'value'		=> 'RUC-0000'
            ],
			[
                'option'	=> 'name',
                'value'		=> 'ERP SIMPLE'
            ],
            [
                'option'	=> 'ticket_slogan',
                'value'		=> 'Gracias por su compra!'
            ],
            [
                'option'	=> 'address',
                'value'		=> 'CC Zumen. Managua, Nicaragua'
            ],
			[
                'option'	=> 'phone-office',
                'value'		=> null
            ],
			[
                'option'	=> 'phone-mobile',
                'value'		=> null
            ],
			[
                'option'	=> 'email',
                'value'		=> null
            ],
			[
                'option'	=> 'website',
                'value'		=> null
            ],
			[
                'option'	=> 'facebook',
                'value'		=> null
            ],
			[
                'option'	=> 'instagram',
                'value'		=> null
            ],
			[
                'option'	=> 'iva',
                'value'		=> '0.15'
            ],
			[
                'option'	=> 'currency',
                'value'		=> 'C$'
            ],
            [
                'option'	=> 'factor_overpicing',
                'value'		=> '1.5'
            ],
            [
                'option'	=> 'porcent_overpricing',
                'value'		=> '0.3333'
            ],
        ];

        foreach ($data as $result) {
            $entity = new \App\Entities\Settings($result);
            $model->insert($entity);
        }
    }
}
