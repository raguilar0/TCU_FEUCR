<!-- src/Template/Users/reset_password.ctp -->
<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>Cambio de contraseña</h1>
    </div>
</div>

<?= $this->Form->create($user); ?>

<?php if(($this->request->session()->read('Auth.User.role')) == 'admin'){ ?>
  <div class="form-group">
      <?= "<h4>".$this->Form->input('new_password', ['class' => 'form-control','label'=>'Nueva contraseña', 'maxlength'=> '16','type'=>'password'])."</h4>"; ?>
      <?= "<h4>".$this->Form->input('repass', ['class' => 'form-control','label'=>'Repetir contraseña', 'maxlength'=> '16','type'=>'password'])."</h4>"; ?>
  </div>

<?php }?>

<?php if(($this->request->session()->read('Auth.User.role')) == 'rep'){ ?>
  <div class="form-group">
      <?= "<h4>".$this->Form->input('old_password', ['class' => 'form-control','label'=>'Inserte su contraseña actual','maxlength'=> '16','type'=>'password'])."</h4>"; ?>
      <?= "<h4>".$this->Form->input('new_password', ['class' => 'form-control','label'=>'Nueva contraseña', 'maxlength'=> '16','type'=>'password'])."</h4>"; ?>
      <?= "<h4>".$this->Form->input('repass', ['class' => 'form-control','label'=>'Repetir contraseña', 'maxlength'=> '16','type'=>'password'])."</h4>"; ?>
  </div>

<?php }?>


<?= debug($user); ?>
<br>
<br>
<div class="row">
    <div class="text-center">
        <?= "<h4>".$this->Form->submit('Cambiar', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>"; ?>
    </div>
</div>
<?= $this->Form->end(); ?>

<br>
<br>

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
