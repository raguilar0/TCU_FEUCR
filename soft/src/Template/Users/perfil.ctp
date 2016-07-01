<div class = "row text-center">
    <div class="col-xs-12">
         <h1>Perfil</h1>   
    </div>
</div>


<?php

	echo $this->Form->create($data);
	echo "<div class='form-group'>";

    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre ','value'=>$data['name'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control', 'label'=>'Primer Apellido', 'value'=>$data['last_name_1'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido', 'maxlength'=> '100', 'value'=>$data['last_name_2']])."</h4>";

    echo "<h4>".$this->Form->input('association', ['class' => 'form-control','label'=>'Asociación', 'disabled' => 'disabled', 'value'=>$data['association'], 'maxlength'=> '1024'])."</h4>";


    echo "  ";

    echo "</div>";

    echo "<br>";
 	echo "<h4>".$this->Form->submit('Actualizar', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";

    echo $this->Form->end();
?>



<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>	
	</div>

</div>

