<!-- src/Template/Users/read.ctp -->

<div class="row text-center">
	<div class="col-xs-12">
		<h1>Consulta de Usuarios</h1>
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
    </tr>
  </thead>
  <tbody>

      <?php
          foreach ($data as $key) {
             echo "<tr>";
              echo "<td>".$key['id']."</td>";
              echo "<td>".$key['username']."</td>";
              echo "<td>".$key['name']."</td>";
              echo "<td>".$key['last_name_1']."</td>";
              echo "<td>".$key['last_name_2']."</td>";
							echo "<td>".$this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#modify_users', 'class'=>'glyphicon glyphicon-pencil btn btn-primary collapsed', 'id'=>'modifyUsersBtn'])."</td>";
             echo "</tr>";
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
