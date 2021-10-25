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
<style>
	@import url('<?= base_url('assets/fonts/BrixSansRegular.css') ?>');
	@import url('<?= base_url('../fonts/BrixSansBlack.css') ?>');

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	p,
	label,
	span,
	table {
		font-family: 'BrixSansRegular';
		font-size: 9pt;
	}

	.h2 {
		font-family: 'BrixSansBlack';
		font-size: 16pt;
	}

	.h3 {
		font-family: 'BrixSansBlack';
		font-size: 12pt;
		display: block;
		background: #0a4661;
		color: #FFF;
		text-align: center;
		padding: 3px;
		margin-bottom: 5px;
	}

	#page_pdf {
		width: 95%;
		margin: 15px auto 10px auto;
	}

	#factura_head,
	#factura_cliente,
	#factura_detalle {
		width: 100%;
		margin-bottom: 10px;
	}

	.logo_factura {
		width: 25%;
	}

	.info_empresa {
		width: 50%;
		text-align: center;
	}

	.info_factura {
		width: 25%;
	}

	.info_cliente {
		width: 100%;
	}

	.datos_cliente {
		width: 100%;
	}

	.datos_cliente tr td {
		width: 50%;
	}

	.datos_cliente {
		padding: 10px 10px 0 10px;
	}

	.datos_cliente label {
		width: 75px;
		display: inline-block;
	}

	.datos_cliente p {
		display: inline-block;
	}

	.textright {
		text-align: right;
	}

	.textleft {
		text-align: left;
	}

	.textcenter {
		text-align: center;
	}

	.round {
		border-radius: 10px;
		border: 1px solid #0a4661;
		overflow: hidden;
		padding-bottom: 15px;
	}

	.round p {
		padding: 0 15px;
	}

	#factura_detalle {
		border-collapse: collapse;
	}

	#factura_detalle thead th {
		background: #058167;
		color: #FFF;
		padding: 5px;
	}

	#detalle_productos tr:nth-child(even) {
		background: #ededed;
	}

	#detalle_totales span {
		font-family: 'BrixSansBlack';
	}

	.nota {
		font-size: 8pt;
	}

	.label_gracias {
		font-family: verdana;
		font-weight: bold;
		font-style: italic;
		text-align: center;
		margin-top: 20px;
	}

	.anulada {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translateX(-50%) translateY(-50%);
	}
</style>

<body>
	<?php echo $anulada; ?>
	<div id="page_pdf">
		<table id="factura_head">
			<tr>
				<td class="logo_factura">
					<div>
						<img src="<?= base_url('assets/img/docs/logo.png') ?>" alt="<?= base_url('assets/img/docs/logo.png') ?>">
					</div>
				</td>
				<td class="info_empresa">
					<?php
					if ($setting > 0) {
						$iva = $setting['iva'];
					?>
						<div>
							<span class="h2"><?php echo strtoupper($setting['name']); ?></span>
							<p><?php echo 'Personeria Juridica'; ?></p>
							<p><?php echo $setting['address']; ?></p>
							<p>NIT: <?php echo $setting['ruc']; ?></p>
							<p>Teléfono: <?php echo $setting['phone-office']; ?></p>
							<p>Email: <?php echo $setting['email']; ?></p>
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
								<td><label>Nit:</label>
									<p><?= "RUC--45784"; ?></p>
								</td>
								<td><label>Teléfono:</label>
									<p><?= "+505 0012-0015"; ?></p>
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
						<td class="textcenter"><?php echo $row->quantity; ?></td>
						<td><?php echo $row->description; ?></td>
						<td class="textright"><?php echo $row->price; ?></td>
						<td class="textright"><?php echo $row->price * $row->quantity; ?></td>
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
					<td colspan="3" class="textright"><span>SUBTOTAL Q.</span></td>
					<td class="textright"><span><?php echo $tl_sniva; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>IVA (<?php echo $iva; ?> %)</span></td>
					<td class="textright"><span><?php echo $impuesto; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>TOTAL Q.</span></td>
					<td class="textright"><span><?php echo $total; ?></span></td>
				</tr>
			</tfoot>
		</table>
		<div>
			<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
			<h4 class="label_gracias">¡Gracias por su compra!</h4>
		</div>

	</div>

</body>

</html>