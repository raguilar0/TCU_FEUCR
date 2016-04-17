<?php
	echo $this->Form->create($tract, ['id'=>'submit_add_tract']);
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
	        echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Guardar Tracto', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
	        echo "</div>";
	    echo "</div>";

	    echo "</div >";

	echo $this->Form->end();


?>