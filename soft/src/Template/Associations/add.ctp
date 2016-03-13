<h1>¡Acá podés <b>agregar</b> una nueva Asociación!</h1>

<?php

	echo $this->Form->create($association);
	echo "<div class='form-group'>";

    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación', 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('headquarters', ['class' => 'form-control','label'=>'Sede', 'maxlength'=> '100'])."</h4>";

    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización', 'maxlength'=> '1024'])."</h4>";
    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario', 'maxlength'=> '512'])."</h4>";
    

    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";
    echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";

    echo "<h4>".$this->Form->submit('Guardar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";

    echo "</div>";

    echo $this->Form->end();
?>


<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>

