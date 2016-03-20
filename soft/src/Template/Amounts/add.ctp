<h1>Detalles del monto</h1>

<?php

	echo $this->Form->create($amount);
	
	/*
	echo "<div class='form-group'>";
	    echo "<div class = 'col-xs-6 col-md-4'>";
        echo "<div class='form-group'>";
        echo "<label for='sel1' id = 'sedes_label'>Sede:</label>";
        echo "<select class='form-control' name = 'headquarter_id' >";
            $headquarter = $association['headquarter'];
                foreach ($headquarter as $key => $value) {
                    echo "<option>".$value['name']."</option>"."<br>";
                }
            
        echo "</select>";
        echo "</div>";
    echo "</div >";    
    */
    echo "<h4>".$this->Form->input('amount', ['class' => 'form-control', 'label'=>'Monto Máximo'])."</h4>";
    echo "<h4>".$this->Form->input('date', ['class' => 'form-control','label'=>'fecha del tracto'])."</h4>";
    echo "<h4>".$this->Form->input('deadline', ['class' => 'form-control','label'=>'Fecha de cierre'])."</h4>";
    echo "<h4>".$this->Form->submit('Guardar Monto', ['class' => 'form-control', 'id' => 'amount_id'])."</h4>";
    echo "</div>";

    echo $this->Form->end();
?>