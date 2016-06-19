<?php
echo "<div class = 'row text-center'>";
    echo "<div class='col-xs-12'>";
        echo"<h1>".'Modificar la información de '.$data['name']."</h1>";
    echo"</div>";
echo "</div>";

echo "<br>";
echo "<br>";
echo "<br>";

	echo $this->Form->create($data);
	echo "<div class='form-group'>";
    echo "<div class = 'row'>";
    	echo "<div class = 'col-xs-12 col-md-6'>";
      //debug($data);
    		echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de Usuario', 'value'=>$data['username'], 'maxlength'=> '10'])."</h4>";
				echo "<h4>".$this->Form->input('name', ['class' => 'form-control', 'label'=>'Nombre', 'value'=>$data['name'], 'maxlength'=> '20'])."</h4>";
		    echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control','label'=>'Primer Apellido','value'=>$data['last_name_1'], 'maxlength'=> '20'])."</h4>";
				echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido','value'=>$data['last_name_2'], 'maxlength'=> '20'])."</h4>";
		    echo "<label for='sel1' id = 'role_label'><h4>Rol</h4></label>";
        //debug($role);
        if($role == 'admin'){
          echo "<select class='form-control' name = 'role'>";
             echo "<option>Administrador</option>";
             echo "<option>Representante</option>";
           echo "</select>";
        }

        if($role == 'rep'){
          echo "<select class='form-control' name = 'role'>";
             echo "<option>Representante</option>";
             echo "<option>Administrador</option>";
           echo "</select>";
        }

		    echo "<h4>".$this->Form->label('Users.blocked','Usuario Bloqueado ');
    	echo "</div>";
    echo "</div>";



    if($data['state'] == false) {
    	echo $this->Form->checkbox('state', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";
    }
    else {
    	echo $this->Form->checkbox('state', ['hiddenField' => false, 'class'=>'checkbox-inline', 'checked'])."</h4>";
    }

  echo "</div>";


	echo "<div class = 'row'>";
	    echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Guardar Usuario', ['class' => 'form-control', 'id' => 'user_id'])."</h4>";
	    echo "</div>";
	echo "</div>";

  echo $this->Form->end();
?>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01">
          <?= $this->Flash->render('success') ?></h4>
    </div>
</div>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#FF0000">
          <?= $this->Flash->render('error') ?></h4>
    </div>
</div>

<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>
	</div>

</div>


<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/users/show_associations/3', ['class'=>'btn btn-primary']);?>
  </div>
</div>
