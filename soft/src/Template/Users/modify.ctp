<!-- src/Template/Users/read.ctp -->

<div class="row text-center">
	<div class="col-xs-12">
		<h1>Edición de Usuarios</h1>
	</div>
</div>
<br>
<br>


<div class="table-responsive">
  <table class="table read_association">
  <thead>
    <tr>
			<th>ID</th>
      <th>Nombre de Usuario</th>
      <th>Nombre</th>
      <th>Primer Apellido</th>
      <th>Segundo Apellido</th>
			<th>Rol</th>
    </tr>
  </thead>
  <tbody>

      <?php
          foreach ($user as $key) {
             echo "<tr>";
						 echo "<td>".$key['id']."</td>";
              echo "<td>".$key['username']."</td>";
              echo "<td>".$key['name']."</td>";
              echo "<td>".$key['last_name_1']."</td>";
              echo "<td>".$key['last_name_2']."</td>";
							echo "<td>".$key['role']."</td>";
							echo "<td>".$this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#modify_users', 'class'=>'glyphicon glyphicon-pencil btn btn-primary collapsed', 'id'=>'modifyUsersBtn'])."</td>";
							echo "<td>".$this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#modify_users', 'class'=>'btn btn-danger collapsed', 'id'=>'BlockUsersBtn'])."</td>";
             echo "</tr>";
          }
      ?>
  </tbody>
</table>
</div>

<div class="collapse" id="modify_users">

  <br><br>

  <?php
  echo $this->Form->create($user,['url'=>[ 'controller'=>'users','action'=>'verify']]);
  echo "<div class='form-group'>";
    echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario', 'maxlength'=> '50', 'id'=>'users_username'])."</h4>";
    echo "<h4>".$this->Form->input('name', ['class' => 'form-control', 'label'=>'Nombre', 'maxlength'=> '30', 'id'=>'users_name'])."</h4>";
		echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control', 'label'=>'Primer Apellido', 'maxlength'=> '30', 'id'=>'users_last_name_1'])."</h4>";
		echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control', 'label'=>'Segundo Apellido', 'maxlength'=> '30', 'id'=>'users_last_name_2'])."</h4>";
    echo "<h4>".$this->Form->submit('Actualizar', ['class' => 'form-control btn btn-primary', 'id' => 'users_update_id_btn', 'onclick'=>'modifyUser()'])."</h4>";
  echo "</div>";
  echo $this->Form->end();
  ?>


</div>


<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/users/', ['class'=>'btn btn-primary']);?>
  </div>
</div>
