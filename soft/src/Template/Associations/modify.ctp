


<h1>¡Acá podés <b>Modificar</b> la Asociación!</h1>

<?php

	echo $this->Form->create($data);
	echo "<div class='form-group'>";

    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación', 'value'=>$data['name'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'value'=>$data['acronym'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('headquarters', ['class' => 'form-control','label'=>'Sede', 'maxlength'=> '100', 'value'=>$data['headquarters']])."</h4>";

    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización','value'=>$data['location'], 'maxlength'=> '1024'])."</h4>";

    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario','value'=>$data['schedule'], 'maxlength'=>'512'])."</h4>";

    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";

    if($data['authorized_card'] == 0)
    {
    	echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";
    }
    else
    {
    	echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline', 'checked'])."</h4>";
    }


    echo "</div>";

 	echo "<h4>".$this->Form->submit('Actualizar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";

    echo $this->Form->end();
?>



<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>	
	</div>

</div>

