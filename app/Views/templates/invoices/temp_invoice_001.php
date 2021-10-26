<?php
$subtotal 	= 0;
$iva 	 	= 0;
$impuesto 	= 0;
$tl_sniva   = 0;
$total 		= 0;
//print_r($setting); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Factura</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
	<?php  if($anulada) echo '<img class="anulada" src="' . base_url('assets/img/docs/anulado.png') . '" alt="Anulada">'; ?>
	<div id="page_pdf">
		<table id="factura_head">
			<tr>
				<td class="logo_factura">
					<div>
						<img src="<?= base_url('assets/img/logo.jpeg') ?>" style="width: 100px;">
					</div>
				</td>
				<td class="info_empresa">
					<?php
					if ($setting > 0) {
						$iva = $setting['iva'];
					?>
						<div>
							<span class="h2"><?= strtoupper($setting['name']); ?></span>
							<p><?= 'Personeria Juridica'; ?></p>
							<p><?= $setting['address']; ?></p>
							<p>RUC: <?= $setting['ruc']; ?></p>
							<p>Teléfono: <?= $setting['phone-office']; ?></p>
							<p>Email: <?= $setting['email']; ?></p>
						</div>
					<?php
					}
					?>
				</td>
				<td class="info_factura">
					<div class="round">
						<span class="h3">Factura</span>
						<p>No. Factura: <strong><?= "#15"; ?></strong></p>
						<p>Fecha: <?= "2021/10/21"; ?></p>
						<p>Hora: <?= "11:03 pm"; ?></p>
						<p>Vendedor: <?= "Cesar A. Tapia"; ?></p>
					</div>
				</td>
			</tr>
		</table>
		<table id="factura_cliente">
			<tr>
				<td class="info_cliente">
					<div class="round">
						<span class="h3">Cliente</span>
						<table class="datos_cliente">
							<tr>
								<td><label>RUC:</label>
									<p><?= "RUC--45784"; ?></p>
								</td>
								<td><label>Teléfono:</label>
									<p><?= "------"; ?></p>
								</td>
							</tr>
							<tr>
								<td><label>Nombre:</label>
									<p><?= "Fulanito Perez"; ?></p>
								</td>
								<td><label>Dirección:</label>
									<p><?= "Managua"; ?></p>
								</td>
							</tr>
						</table>
					</div>
				</td>

			</tr>
		</table>

		<table id="factura_detalle">
			<thead>
				<tr>
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

				<?php


				foreach ($data as $key => $row) {
				?>
					<tr>
						<td class="textcenter"><?= $row->quantity; ?></td>
						<td><?= $row->description; ?></td>
						<td class="textright"><?= $row->price; ?></td>
						<td class="textright"><?= $row->price * $row->quantity; ?></td>
					</tr>
				<?php
					$precio_total = $row->price * $row->quantity;
					$subtotal = round($subtotal + $precio_total, 2);
				}


				$impuesto 	= round($subtotal * ($iva), 2);
				$tl_sniva 	= round($subtotal - $impuesto, 2);
				$total 		= round($tl_sniva + $impuesto, 2);
				?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>SUBTOTAL C$.</span></td>
					<td class="textright"><span><?= $tl_sniva; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>IVA (<?= $iva*100; ?> %)</span></td>
					<td class="textright"><span><?= $impuesto; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>TOTAL C$.</span></td>
					<td class="textright"><span><?= $total; ?></span></td>
				</tr>
			</tfoot>
		</table>
		<div>
			<p class="nota">
				Si usted tiene preguntas sobre esta factura
				<br>pongase en contacto con :
				<br>Cesar A. Tapia || (+505) 7810-9544  
				<br>cesart050892@gmail.com</p>
			<h4 class="label_gracias">¡Gracias por su compra!</h4>
		</div>

	</div>

</body>

</html>