<!-- src/Template/Users/add.ctp -->
<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>¡<b>Agregá</b> un usuario !</h1>
    </div>
</div>

<br>
<br>



<?= $this->Form->create($user); ?>

<div class="form-group">
    <?= "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control','label'=>'Primer Apellido'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido'])."</h4>"; ?>

    <?php if(($this->request->session()->read('Auth.User.role')) == 'admin'){

        echo $this->Form->input('association_id', ['options' => $association, 'class'=>'form-control', 'label'=>'Asociación correspondiente']);

        echo "<label for='sel1' id = 'role_label'><h4>Rol:</h4></label>";
        echo "<select class='form-control' name = 'role'>";
        $kind = $role;
        //debug($role);
        foreach ($kind as $key => $value) {
            echo "<option>".$key."</option>"."<br>";
        }
        echo "</select>";


     }

    ?>

    <br>
    <br>
    <div class="row">
        <div class="text-center">
            <?= "<h4>".$this->Form->submit('Agregar', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>"; ?>
        </div>
    </div>

    <?= $this->Form->end(); ?>



</div>









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

<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/users/', ['class'=>'btn btn-primary']);?>
  </div>
</div>
