<div class = "row text-center">
    <div class="col-xs-12">
         <h1>Información general</h1>   
    </div>
</div>


<?php

	echo $this->Form->create($data, ['id'=>'submit6']);
	echo "<div class='form-group'>";

    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la asociación', 'disabled' => 'disabled','value'=>$data['name'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'disabled' => 'disabled', 'value'=>$data['acronym'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('headquarter', ['class' => 'form-control','label'=>'Sede', 'disabled' => 'disabled', 'maxlength'=> '100', 'value'=>$data['headquarter']])."</h4>";

    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización', 'disabled' => 'disabled', 'value'=>$data['location'], 'maxlength'=> '1024'])."</h4>";

    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario','value'=>$data['schedule'], 'maxlength'=>'512'])."</h4>";

    
    echo "  ";

    if($data['authorized_card'] == 0) {
    	 echo "<h4>"."<font color = red>".$this->Form->label('Associations.authorized_card','Tarjeta autorizada ')."</font>";
    }
    else {
    	 echo "<h4>"."<font color = green>".$this->Form->label('Associations.authorized_card','Tarjeta autorizada ')."</font>";
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

