<h1>¡Acá podés <b>Ver</b> la Asociación!</h1>

<?php

	echo "<div class='form-group'>";

    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación', 'value'=>$data['name'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'value'=>$data['acronym'], 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('headquarter', ['class' => 'form-control','label'=>'Sede', 'maxlength'=> '100', 'value'=>$data['headquarter_id']])."</h4>";

    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización','value'=>$data['location'], 'maxlength'=> '1024'])."</h4>";

    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario','value'=>$data['schedule'], 'maxlength'=>'512'])."</h4>";



    echo "</div>";
	
?>



<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>	
	</div>

</div>