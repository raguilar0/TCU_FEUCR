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
      <th>Nombre de Usuario</th>
      <th>Nombre</th>
      <th>Primer Apellido</th>
      <th>Segundo Apellido</th>
			<th>Rol</th>
			<th>Estado</th>
    </tr>
  </thead>
  <tbody>

      <?php
			//debug($user);
          foreach ($user as $key) {
              echo "<tr>";
              echo "<td>".$key['username']."</td>";
              echo "<td>".$key['name']."</td>";
              echo "<td>".$key['last_name_1']."</td>";
              echo "<td>".$key['last_name_2']."</td>";
							//echo "<td>".$key['mail']."</td>";
							if($key['role'] == 'admin') {
								echo "<td> Administrador </td>";
							}
							if($key['role'] == 'rep'){
									echo "<td> Representante </td>";
							}
							if($key['state'] == 0) {
								echo "<td> Activo </td>";
							}
							if($key['state'] == 1){
									echo "<td> Bloqueado </td>";
							}

							echo "<td>".$this->Html->link('','/users/modify_user/'.$key['id'], ['class'=>'glyphicon glyphicon-pencil btn btn-primary'])."</td>";

          }
      ?>
  </tbody>
</table>
</div>

<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/users/', ['class'=>'btn btn-primary']);?>
  </div>
</div>
