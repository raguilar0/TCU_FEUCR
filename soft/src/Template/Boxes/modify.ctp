<div class="row text-center">
	<div class="col-xs-12">
		<h1>¡Actualizá las Cajas!</h1>
	</div>
</div>

<br>

<?php

	$big = 0;
	$little = 0;

	if($data['big'] != [])
	{	
		$big = $data['big'];
	}
	if($data['little'] != [])
	{
		$little = $data['little'];
	}

	echo $this->Form->create(null, ['id'=>'submit3']);
	echo "<div class='form-group'>";




    echo "<div class = 'row'>";

	    echo "<div class = 'col-xs-12 col-md-6'>";
	     echo "<h4>".$this->Form->input('big', ['class' => 'form-control','label'=>'Caja Fuerte', 'min'=> '0','value'=>$big])."</h4>";
	    echo "</div >";


	    echo "<div class = 'col-xs-12 col-md-6'>";
	     echo "<h4>".$this->Form->input('little', ['class' => 'form-control','label'=>'Caja Chica', 'min'=>'0', 'value'=>$little])."</h4>";
	    echo "</div >";

    echo "</div>";
  
	echo "</div >";    



   

    echo "<div class = 'row'>";
        echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Actualizar Cajas', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
        echo "</div>";
    echo  "</div>";

    echo $this->Form->end();

?>