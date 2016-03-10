<h1>Detalles del monto</h1>

<?php

	echo $this->Form->create($amount);
	echo "<div class='form-group'>";
    echo "<h4>".$this->Form->input('amount', ['class' => 'form-control', 'label'=>'Monto'])."</h4>";
    echo "<h4>".$this->Form->input('date', ['class' => 'form-control','label'=>'fecha del tracto'])."</h4>";
    echo "<h4>".$this->Form->input('deadline', ['class' => 'form-control','label'=>'Fecha de cierre'])."</h4>";
    echo "<h4>".$this->Form->submit('Guardar Monto', ['class' => 'form-control', 'id' => 'amount_id'])."</h4>";
    echo "</div>";

    echo $this->Form->end();
?>