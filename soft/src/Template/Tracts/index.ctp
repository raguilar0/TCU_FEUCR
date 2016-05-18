<div class="row text-center">
	<div class="col-xs-12"><h1>Opciones de Administración</h1></div>
</div>

<br>

<div class="row text-center">
	<div class="col-xs-12 col-md-4">
		<?php echo $this->Form->Button('Agregar Nuevo Tracto',['class'=>'btn btn-primary', 'data-toggle'=>'collapse', 'data-target'=>'#add_tract'])?>

			<div id="add_tract" class="collapse">
				<?php
					echo $this->Form->create(null, ['id'=>'submit_add_tract']);
						echo "<div class='form-group'>";




					    echo "<div class = 'row'>";

					    echo "<div class = 'col-xs-12'>";
					     echo "<h4>".$this->Form->input('number', ['class' => 'form-control','label'=>'Número de Tracto', 'placeholder'=>'Posibles valores: 1,2,3,4', 'type'=>'number'])."</h4>";
					    echo "</div >";


					    echo "<div class = 'col-xs-12'>";
					     echo "<h4>".$this->Form->input('date', ['label'=>'Fecha de Inicio', 'type'=>'date'])."</h4>";
					    echo "</div >";

					    echo "<div class = 'col-xs-12'>";
					     echo "<h4>".$this->Form->input('deadline', ['class' => 'form-control','label'=>'Fecha Final', 'type'=>'date'])."</h4>";
					    echo "</div >";						    					    

					    echo "</div >";


					    echo "<div class = 'row'>";
					        echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Guardar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
					        echo "</div>";
					    echo "</div>";

					    echo "</div >";

					echo $this->Form->end();


				?>
			</div>

	</div>

	<div class="col-xs-12 col-md-4">
		<?php echo $this->Html->link('Agregar Montos','',['class'=>'btn btn-primary'])?>
	</div>

	<div class="col-xs-12 col-md-4">
		<?php echo $this->Html->link('Ver Información Detallada','',['class'=>'btn btn-primary'])?>
	</div>		
</div>