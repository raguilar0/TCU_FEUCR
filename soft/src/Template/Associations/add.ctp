<h1>Agregue una nueva Asociación</h1>

<?php

	echo $this->Form->create($association);
	echo "<div class='form-group'>";
    echo $this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla']);
    echo $this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación']);
    echo $this->Form->input('location', ['class' => 'form-control','label'=>'Localización']);
    echo $this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario']);
    echo $this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";
    echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline']);

    echo $this->Form->submit('Guardar Asociación', ['class' => 'form-control']);

    echo "</div>";
    echo $this->Form->end();
?>