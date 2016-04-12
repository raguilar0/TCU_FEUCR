<!-- src/Template/Users/index.ctp -->

<div class="row text-center">
	<div class="col-xs-12">
		<h1>Administración de Usuarios</h1>
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
          foreach ($users as $key) {
             echo "<tr>";
              echo "<td>".$key['id']."</td>";
              echo "<td>".$key['username']."</td>";
              echo "<td>".$key['name']."</td>";
              echo "<td>".$key['last_name_1']."</td>";
              echo "<td>".$key['last_name_2']."</td>";
             echo "</tr>";
          }
      ?>
  </tbody>
</table>
</div>


<?php
echo "<div class = 'col-xs-6 col-md-4'>";
  echo $this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#add_users', 'class'=>'glyphicon glyphicon-plus btn btn-success', 'id'=>'addHeadquartersBtn']);
echo "</div >";

echo "<div class='collapse' id='add_users'>";
   echo "<br><br>";
   echo "<br><br>";
   echo "<h4>Agregar Usuario</h4>";
   echo "<div class='form-group'>";
     echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de Usuario','type'=>'text'])."</h4>";
     echo "<h4>".$this->Form->input('password', ['class' => 'form-control', 'label'=>'Contraseña', 'type'=> 'password'])."</h4>";
     echo "<h4>".$this->Form->input('name', ['class' => 'form-control', 'label'=>'Nombre', 'type'=> 'text'])."</h4>";
     echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control', 'label'=>'Primer Apellido', 'type'=> 'text'])."</h4>";
     echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control', 'label'=>'Segundo Apellido', 'type'=> 'text'])."</h4>";
   echo "</div>";
   echo "<div class = 'row'>";
       echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Agregar Usuario', ['class' => 'form-control', 'data-target'=>'add_users'])."</h4>";
       echo "</div>";
   echo "</div>";
   echo $this->Form->end();
echo "</div>";

?>
