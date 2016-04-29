<div class="row text-center">
	<div class="col-xs-12">
		<h1>Administración de Usuarios</h1>
	</div>
</div>

<br>
<br>

<div class="row text-center">

<?php
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Consultar Usuarios','/users/show_associations/1',['class'=>'btn btn-info','id'=>'user_admin_btn'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Agregar Usuarios','/users/add/',['class'=>'btn btn-success','id'=>'user_admin_btn'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Modificar Usuarios','/users/show_associations/3',['class'=>'btn btn-warning','id'=>'user_admin_btn'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Bloquear Usuarios','/users/show_associations/4',['class'=>'btn btn-danger','id'=>'user_admin_btn'])."</div>";

?>
</div>
