<?php //variables de uso común
	 

	 $monto_ahorro = $monto_tracto = $caja_fuerte = $caja_chica = $total_gastos = 0;

	$periodo_tracto = "";
	
	if(!empty($data['box']))
	{
		$caja_fuerte =  $data['box'][0]['big_amount'];
		$caja_chica =  $data['box'][0]['little_amount'];
	}

	if(!empty($data['amounts']))
	{
		$periodo_tracto = "Período de Tracto:<br><br> ".$data['amounts'][0]['tract']['date']." - ".$data['amounts'][0]['tract']['deadline'];
		$monto_ahorro = 0; //TODO: agregar el monto de ahorro
		$monto_tracto =  $data['amounts'][0]['amount'];
	}



	$total_gastos = 0;

?>

<div class="row text-center">
	<div class="col-xs-12">
		<h1><?php echo $periodo_tracto;?> </h1>
		<h2>Facturas</h2>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Fecha</th>
				<th>Número de Factura</th>
				<th>Detalle</th>
				<th>Proveedor</th>
				<th>Monto</th>
				<th>Encargado</th>
				<th>Aclaraciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
				
				$invoices = $data['invoices'];

				$counter = 0;

				foreach ($invoices as $key) {
					echo "<tr>";
						echo "<td>".$counter."</td>";
						echo "<td>".$key['date']."</td>";
						echo "<td>".$key['number']."</td>";
						echo "<td>".$key['detail']."</td>";
						echo "<td>".$key['provider']."</td>";
						echo "<td>".$key['amount']."</td>";
						echo "<td>".$key['attendant']."</td>";
						echo "<td>".$key['clarifications']."</td>";
					echo "</tr>";

					++$counter;
					$total_gastos = $total_gastos + $key['amount'];
				}

			?>
		</tbody>
	</table>	
</div>

<div class="row">
	<div class="col-xs-12">
		<?php echo "<strong style='font-size:20px;'>Total: ".$total_gastos."</strong>";?>
	</div>
</div>

<br>
<hr>

<br>
<br>



<div class="row">

	<div class="col-xs-12 col-md-6 text-center">
		<h3>Cuadro de Ingresos</h3>

		<table class="table table-striped">
			<tr>
				<th>Monto de Tracto</th>
				<td><?php echo $monto_tracto?></td>
			</tr>

			<tr>
				<th>Monto de Ahorro</th>
				<td><?php echo $monto_ahorro?></td>
			</tr>

			<tr>
				<th>Total</th>
				<td><?php echo ($monto_ahorro+$monto_tracto)?></td>
			</tr>
									
		</table>
	</div>

	<div class="col-xs-12 col-md-6 text-center">
		<h3>Cajas</h3>

		<table class="table table-striped">
			<tr>
				<th>Caja Fuerte</th>
				<td><?php echo $caja_fuerte?></td>
			</tr>

			<tr>
				<th>Caja Chica</th>
				<td><?php echo $caja_chica?></td>
			</tr>

			<tr>
				<th>Total</th>
				<td><?php echo ($caja_chica+$caja_fuerte)?></td>
			</tr>
									
		</table>		
	</div>

</div>

<br>

<div class="row">
	<div class="col-xs-12 text-center">
		<h3>Estado General del Tracto</h3>

		<table class="table table-striped">
			<tr>
				<th>Saldo inicial de cajas</th>
				<td><?php echo ($caja_fuerte+$caja_chica) ?></td>
			</tr>

			<tr>
				<th>Ahorro del período anterior</th>
				<td><?php echo $monto_ahorro ?></td>
			</tr>

			<tr>
				<th>Ingresos del período</th>
				<td><?php echo $monto_tracto ?></td>
			</tr>
				
			<tr>
				<th><u>Total de ingresos</u></th>
				<td><?php echo ($caja_fuerte+$caja_chica+$monto_ahorro+$monto_tracto) ?></td>
			</tr>

			<tr>
				<th>Total de gastos</th>
				<td><?php echo $total_gastos ?></td>
			</tr>

			<tr>
				<th><u>Saldo final</u></th>
				<td><?php echo ($caja_fuerte+$caja_chica+$monto_ahorro+$monto_tracto)-$total_gastos?></td>
			</tr>

			<tr>
				<th>Total de cajas</th>
				<td><?php echo ($caja_chica+$caja_fuerte)?></td>
			</tr>

			<tr>
				<th><u>Cuenta</u></th>
				<td><?php echo (($caja_fuerte+$caja_chica+$monto_ahorro+$monto_tracto)-$total_gastos)-($caja_chica+$caja_fuerte)?></td>
			</tr>												
		</table>			
	</div>	
</div>

