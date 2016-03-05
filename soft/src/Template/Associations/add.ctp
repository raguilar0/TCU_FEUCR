<h1>Agregue una nueva Asociación</h1>

<?php

	echo $this->Form->create($association);
	echo "<div class='form-group'>";
    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla'])."</h4>";
    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación'])."</h4>";
    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización'])."</h4>";
    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario'])."</h4>";
    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";
    echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";
    echo "<h4>".$this->Form->submit('Guardar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
    echo "</div>";

    echo $this->Form->end();
?>