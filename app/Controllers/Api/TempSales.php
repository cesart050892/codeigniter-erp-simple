<?php

namespace App\Controllers\Api;

use App\Entities\TempSales as Entity;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Users;
use CodeIgniter\RESTful\ResourceController;
use Dompdf\Dompdf;
use Dompdf\Options;
use FPDF;

require_once APPPATH . 'ThirdParty' . DIRECTORY_SEPARATOR . 'dompdf' . DIRECTORY_SEPARATOR . 'autoload.inc.php';

class TempSales extends ResourceController
{

    protected $modelName = 'App\Models\TempSales';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
        $rules = [
            'product'           => 'required',
            'quantity'          => 'required',
        ];
        if (!$this->validate($rules))
            return $this->failValidationErrors($this->validator->listErrors());
        $model = new Products();
        $temp = new Entity();
        $mSetting = new Settings();
        $product = $model->find($this->request->getPost('product'));
        $quantity = $this->request->getPost('quantity', FILTER_SANITIZE_STRING);
        if ($quantity > $product->stock)
            return $this->failValidationErrors("No stock, only {$product->stock}");
        $temp->fill(['quantity' => $quantity]);
        $factor = $mSetting->option('factor_overpicing');
        $temp->price = $product->price * $factor->value;
        $temp->price = $this->roundup($temp->price, 1);
        $temp->product_id = $product->id;
        if ($data = $this->request->getPost('token')) {
            $temp->token = $data;
            unset($data);
        } else {
            $temp->token = uniqid();
        }
        if (!$this->model->save($temp))
            return $this->failValidationErrors($this->model->listErrors());
        $data = $this->model->where('token', $temp->token)->get()->getResult();
        $subtotal = 0;
        foreach ($data as $key) {
            $subtotal += ($key->price * $key->quantity);
        }
        $iva = $mSetting->option('iva');
        $iva = $subtotal * $iva->value;
        return $this->respondCreated([
            'status'    => 201,
            'message'   => 'created',
            'data'      => [
                'token'      => $temp->token,
                'subtotal'     => $subtotal,
                'iva'       => $iva,
                'total'     => $subtotal + $iva
            ]
        ]);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }


    function generate()
    {
        //$datosVenta = $this->ventas->where('id', $id_venta)->first();
        //$detalle_venta = $this->detalle_venta->select('*')->where('id_venta', $id_venta)->findAll();
        //$nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        //$direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;
        //$leyendaTicket = $this->configuracion->select('valor')->where('nombre', 'ticket_leyenda')->get()->getRow()->valor;
        $token = $this->request->getGet('token');
        $data = $this->model->generate($token);
        $settings = new Settings();
        $setting = [];
        $result = $settings->findAll();
        foreach ($result as $key => $value) {
            $setting += [$value->option => $value->value];
        }
        if (empty($data))
            return $this->failValidationErrors('Token does not exist!');
        //$this->fnfpdf($data, $setting);
        $this->fnDom('temp_invoice_001', $data, $setting);
    }

    private function fnDom($html, $data, $setting)
    {
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $data = [
            'data'      => $data,
            'setting'   => $setting,
            'anulada'   => true
        ];
        $dompdf->loadHtml(view('templates/invoices/' . $html, $data));
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('letter', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $this->response->setHeader('Content-Type', 'application/pdf');
        $dompdf->stream('factura_#pdf', array('Attachment' => 0));
    }

    private function fnfpdf($data, $setting)
    {
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("Venta");
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, $setting['name'], 0, 1, 'C');

        //$pdf->Image(base_url('assets/img/logo.jpeg'), 5, 10, 10, 10, 'JPEG');

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(60, 5, $setting['address'], 0, 1, 'C');

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(60, 5, date('D, d M Y H:i:s'), 0, 1, 'C');
        $user = new Users();
        $user = $user->find(session()->user_id);
        $pdf->Cell(60, 5, "Vendedor: {$user->name} {$user->surname}", 0, 1, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(15, 5, utf8_decode('# REF:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, $data[0]->token, 0, 1, 'C');

        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 7);

        $pdf->Cell(7, 5, '#', 0, 0, 'L');
        $pdf->Cell(5);
        $pdf->Cell(25, 5, 'NOMBRE', 0, 0, 'L');
        $pdf->Cell(15, 5, 'PRECIO', 0, 0, 'L');
        $pdf->Cell(1);
        $pdf->Cell(15, 5, 'TOTAL', 0, 1, 'L');

        $pdf->SetFont('Arial', '', 7);

        $contador = 1;

        $subtotal = 0;
        foreach ($data as $row) {
            $pdf->Cell(7, 5, $row->quantity, 0, 0, 'L');
            $pdf->Cell(5);
            $pdf->Cell(25, 5, $row->description, 0, 0, 'L');
            $pdf->Cell(15, 5, $row->price, 0, 0, 'L');
            $importe = number_format($row->price * $row->quantity, 2, '.', ',');
            $subtotal += $row->price * $row->quantity;
            $pdf->Cell(15, 5, 'C$' . $importe, 0, 1, 'R');
            $contador++;
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $iva = $subtotal * $setting['iva'];
        $total = $subtotal + $iva;
        $pdf->Cell(70, 5, 'SUBTOTAL: C$ ' . number_format($subtotal, 2, '.', ','), 0, 1, 'R');
        $pdf->Cell(70, 5, 'IVA: C$ ' . number_format($iva, 2, '.', ','), 0, 1, 'R');
        $pdf->Cell(70, 5, 'TOTAL: C$ ' . number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Ln();
        $pdf->MultiCell(70, 5, $setting['ticket_slogan'], 0, 'C', 0);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("ticket.pdf", "I");
    }
}
