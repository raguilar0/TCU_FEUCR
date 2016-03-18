<div class="row text-center">
	<div class="col-xs-12">
		<h1>Opciones de administración</h1>
	</div>

</div>

<br>
<br>

<div class="row">

<?php
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Consultar Asociación','/associations/show_associations/1',['class'=>'btn btn-info','id'=>'asso_admin_btn'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Crear Asociación','/associations/add',['class'=>'btn btn-success','id'=>'asso_admin_btn'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Modificar Asociación','/associations/show_associations/3',['class'=>'btn btn-warning','id'=>'asso_admin_btn'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Eliminar Asociación','/associations/show_associations/4',['class'=>'btn btn-danger','id'=>'asso_admin_btn'])."</div>";
?>
</div>
