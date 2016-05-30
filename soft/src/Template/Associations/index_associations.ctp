<div class="row text-center">
	<div class="col-xs-12">
		<h1>Opciones de Administración</h1>
	</div>
</div>

<br>
<br>


<div class="row text-center">
	<div class="col-md-6 col-xs-12">
	<br>	
		<?php echo $this->Html->image('layouts/invoice.png',['alt'=>'Factura', 'id'=>'img_invoice', 'url'=>['controller'=>'Invoices', 'action'=>'add']]);
		?>

		<h4>Agregar Nueva Factura</h4>		
	</div>

	<br>

	<div class="col-md-6 col-xs-12">
		
		<?php echo $this->Html->image('layouts/boxes.png',['alt'=>'Factura', 'id'=>'img_boxes', 'url'=>['controller'=>'Boxes', 'action'=>'modify']]);
		?>

		<h4>Actualizar Cajas</h4>
	</div>
</div>

<br>
<br>