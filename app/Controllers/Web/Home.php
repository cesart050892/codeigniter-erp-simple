<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Settings;
use App\Models\Tempdetailsinvoice;

class Home extends BaseController
{
    public function index()
    {
        //
        $model = new Tempdetailsinvoice();
        $data = $model->generate('616fb07c27f82');
        $settings = new Settings();
        $setting = [];
        $result = $settings->findAll();
        foreach ($result as $key => $value) {
            $setting += [$value->option => $value->value];
        }
        $data = [
            'data'      => $data,
            'setting'   => $setting,
            'anulada'   => '<img class="anulada" src="assets/img/docs/anulado.png" alt="Anulada">'
        ];
        echo view('templates/invoices/inv_1',$data);
    }
}
