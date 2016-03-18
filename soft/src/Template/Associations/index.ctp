<h1> Sección de Asociaciones</h1>


<div class="row">

<?php
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Consultar Asociación','/associations/show_associations/1',['class'=>'btn btn-info'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Crear Asociación','/associations/add',['class'=>'btn btn-success'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Modificar Asociación','/associations/show_associations/3',['class'=>'btn btn-warning'])."</div>";
		echo "<div class='col-xs-12 col-md-3'>".$this->Html->link('Eliminar Asociación','/associations/show_associations/4',['class'=>'btn btn-danger'])."</div>";
?>
</div>
