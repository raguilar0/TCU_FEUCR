<!-- src/Template/Users/read.ctp -->

<?php
echo "<div class = 'row text-center'>";
    echo "<div class='col-xs-12'>";
    echo"<h1>".'Edición de usuarios'."</h1>";
		echo"<h1>".$association[0]['name']."</h1>";
    echo"</div>";
echo "</div>";

echo "<br>";
echo "<br>";
echo "<br>";



echo "<div class='table-responsive'>";
	echo  "<table class='table read_association'>";
	echo  "<thead>";
  	echo  "<tr>";
	  echo  "<th>Nombre de Usuario</th>";
		echo  "<th>Nombre</th>";
		echo  "<th>Primer Apellido</th>";
		echo  "<th>Segundo Apellido</th>";
		echo  "<th>Rol</th>";
		echo  "<th>Estado</th>";
  	echo  "</tr>";
  echo "</thead>";
  echo "<tbody>";

          foreach ($data as $key) {
             echo "<tr>";
              echo "<td>".$key['username']."</td>";
              echo "<td>".$key['name']."</td>";
              echo "<td>".$key['last_name_1']."</td>";
              echo "<td>".$key['last_name_2']."</td>";
							if($key['role']=='admin'){
								echo"<td>".'Administrador'."</td>";
							}
							if($key['role']=='rep'){
								echo"<td>".'Representante'."</td>";
							}
							if($key['state']==0){
								echo"<td>".'Activo'."</td>";
							}
							if($key['state']==1){
								echo"<td>".'Bloqueado'."</td>";
							}
							echo "<td>".$this->Html->link('','/users/modify_user/'.$key['id'], ['class'=>'glyphicon glyphicon-pencil btn btn-primary'])."</td>";


             echo "</tr>";
          }

echo  "</tbody>";
echo "</table>";
echo "</div>";

/*
echo "<div class='row text-center'>";
echo  "<div class='col-xs-12'>";
echo $this->Html->link('Atrás', '/users/', ['class'=>'btn btn-primary']);
echo  "</div>";
echo  "</div>";

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
*/
