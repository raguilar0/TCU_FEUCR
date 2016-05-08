<!-- src/Template/Users/add.ctp -->


<?php

$this->layout('admin_views');
echo $this->Form->create();

echo "<div class='form-group' id=form_login>";
  echo "<div class = 'row'>";
    echo "<div class = 'col-xs-12 col-md-4'>";
      echo "<h4> Agregar Usuario </h4>";
      echo "<hr />";
      echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario'])."</h4>";
      echo "<h4>".$this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña'])."</h4>";
      echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre'])."</h4>";
      echo "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control','label'=>'Primer Apellido'])."</h4>";
      echo "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido'])."</h4>";

      echo "<div class = 'col-xs-6 col-md-4'>";
      echo "<div class='form-group'>";
      echo "<label for='sel1' id = 'asociaciones_label'>Asociación:</label>";
         echo "<select class='form-control' name = 'association_id' >";
              foreach ($association as $key => $value) {
                  echo "<option>".$value['name']."</option>"."<br>";
              }
          echo "</select>";
      echo "</div>";
    echo "</div>";


    echo "<div class = 'col-xs-6 col-md-4'>";
    echo "<label for='sel1' id = 'role_label'><h4>Rol:</h4></label>";
       echo "<select class='form-control' name = 'role'>";
            $kind = $role;

            foreach ($kind as $key => $value) {
                echo "<option>".$key."</option>"."<br>";
            }
        echo "</select>";
    echo "</div>";


  echo "</div>";
echo "</div>";

  echo "<div class = 'row'>";
      echo "<div class = 'col-xs-12'>";
         echo "<h4>".$this->Form->submit('Agregar', ['class' => 'form-control', 'id' => 'addUsr'])."</h4>";
      echo "</div>";
  echo "</div>";


echo $this->Form->end();
?>
<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/users/', ['class'=>'btn btn-primary']);?>
  </div>
</div>
