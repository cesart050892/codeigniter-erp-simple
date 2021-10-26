<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Settings;
use App\Models\TempSales;

class Home extends BaseController
{
    public function index()
    {
        //
        $model = new TempSales();
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
            'anulada'   => true
        ];
        echo view('templates/invoices/temp_invoice_001',$data);
    }
}
