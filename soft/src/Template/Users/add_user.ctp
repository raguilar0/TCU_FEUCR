<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>¡<b>Agregá</b> un usuario!</h1>
    </div>
</div>

<br>    
<br>

<?php

	//echo $this->Form->create($user, ['id'=>'submit1']);
	echo "<div class='form-group'>";




    echo "<div class = 'row'>";

    echo "<div class = 'col-xs-12 col-md-4'>";
    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre', 'maxlength'=> '256'])."</h4>";
    
  

    echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control', 'label'=>'Primer Apellido', 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control', 'label'=>'Segundo Apellido', 'maxlength'=> '256'])."</h4>";

    echo "<h4>".$this->Form->input('username', ['class' => 'form-control', 'label'=>'Username', 'maxlength'=> '256'])."</h4>";
    echo "<h4>".$this->Form->input('password', ['class' => 'form-control', 'label'=>'Contraseña', 'maxlength'=> '256'])."</h4>";
    

    //echo "<h4>".$this->Form->input('headquarters', ['class' => 'form-control','label'=>'Sede', 'maxlength'=> '100'])."</

    echo "<div class = 'row'>";
        echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Agregar usuario', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
        echo "</div>";
    echo "</div>";


    echo "</div>";

    echo $this->Form->end();

?>




<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>

<br>


