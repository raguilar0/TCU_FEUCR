<?php

echo "<div class = 'row text-center'>";
    echo "<div class='col-xs-12'>";
        echo"<h1>".'Modificar la información de '.$user['name']."</h1>";
    echo"</div>";
echo "</div>";

echo "<br>";
echo "<br>";
echo "<br>";

	echo $this->Form->create($user);
	echo "<div class='form-group'>";
    echo "<div class = 'row'>";
    	echo "<div class = 'col-xs-12 col-md-6'>";
      //debug($user);
    		echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de Usuario', 'value'=>$user['username'], 'maxlength'=> '0'])."</h4>";
				echo "<h4>".$this->Form->input('name', ['class' => 'form-control', 'label'=>'Nombre', 'value'=>$user['name'], 'maxlength'=> '20'])."</h4>";
		    echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control','label'=>'Primer Apellido','value'=>$user['last_name_1'], 'maxlength'=> '20'])."</h4>";
				echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido','value'=>$user['last_name_2'], 'maxlength'=> '20'])."</h4>";

        //debug($this->request->session()->read('Auth.User.role'));
        if($this->request->session()->read('Auth.User.role') == 'admin') {
          echo "<label for='sel1' id = 'role_label'><h4>Rol</h4></label>";
          //debug($user);
          if($user->role == 'admin'){
            echo "<select class='form-control' name = 'role'>";
               echo "<option>Administrador</option>";
               echo "<option>Representante</option>";
             echo "</select>";
          }

          if($user->role == 'rep'){
            echo "<select class='form-control' name = 'role'>";
               echo "<option>Representante</option>";
               echo "<option>Administrador</option>";
             echo "</select>";
          }

          echo "<td>".$this->Html->link('reestablecer contraseña','/users/reset_password/'.$user['id'], ['class'=>'glyphicon glyphicon-success btn btn-primary', 'label'=>'reestablecer contraseña'])."</td>";
        }
		    echo "<h4>".$this->Form->label('Users.blocked','Usuario Bloqueado ');

    	echo "</div>";
    echo "</div>";



    if($user['state'] == false) {
    	echo $this->Form->checkbox('state', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";
    }
    else {
    	echo $this->Form->checkbox('state', ['hiddenField' => false, 'class'=>'checkbox-inline', 'checked'])."</h4>";
    }

  echo "</div>";


	echo "<div class = 'row'>";
	    echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Guardar Usuario', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
	    echo "</div>";
	echo "</div>";

  echo $this->Form->end();

if(($this->request->session()->read('Auth.User.role')) == 'admin'){
echo "<br>";
echo "<div class='row text-center'>";
  echo "<div class='col-xs-12'>";

        echo $this->Html->link(
        'Atrás',
        ['controller' => 'Users', 'action' => 'modify', $user->association_id], ['class'=>'btn btn-primary']
        );

  echo "</div>";
echo "</div>";
}

if(($this->request->session()->read('Auth.User.role')) == 'rep'){
echo "<br>";
echo "<div class='row text-center'>";
  echo "<div class='col-xs-12'>";

        echo $this->Html->link(
        'Atrás',
        ['controller' => 'Users', 'action' => 'modify'], ['class'=>'btn btn-primary']
        );

  echo "</div>";
echo "</div>";
}?>


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
