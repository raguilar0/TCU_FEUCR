<!-- src/Template/Users/reset_password.ctp -->
<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>Cambio de contraseña</h1>
    </div>
</div>


<?php if(($this->request->session()->read('Auth.User.role')) == 'admin'){ ?>
    <?= $this->Form->create(null,['onsubmit'=>'return compare()']); ?>
  <div class="form-group">
      <h4> <?= $this->Form->input('password', ['class' => 'form-control','label'=>'Nueva contraseña', 'maxlength'=> '16','type'=>'password', 'id'=>'pass']); ?> </h4>
      <h4> <?= $this->Form->input('repass', ['class' => 'form-control','label'=>'Repetir contraseña', 'maxlength'=> '16','type'=>'password', 'id'=>'repa']); ?></h4>
      <span id='message'></span>
  </div>

<?php }?>

<?php if(($this->request->session()->read('Auth.User.role')) == 'rep'){ ?>
    <?= $this->Form->create(null,['url' => ['action' => 'reset-pass']],['onsubmit'=>'return compare()']); ?>
  <div class="form-group">
      <?= "<h4>".$this->Form->input('old_password', ['class' => 'form-control','label'=>'Inserte su contraseña actual','maxlength'=> '16','type'=>'password'])."</h4>"; ?>
      <?= "<h4>".$this->Form->input('password', ['class' => 'form-control','label'=>'Nueva contraseña', 'maxlength'=> '16','type'=>'password','id'=>'pass'])."</h4>"; ?>
      <?= "<h4>".$this->Form->input('repass', ['class' => 'form-control','label'=>'Repetir contraseña', 'maxlength'=> '16','type'=>'password','id'=>'repa'])."</h4>"; ?>
  </div>

<?php }?>



<br>
<br>
<div class="row text-center">
    <div class="col-xs-12">
        <?= "<h4>".$this->Form->submit('Cambiar', ['class' => 'btn btn-primary'])."</h4>"; ?>
    </div>
</div>
<?= $this->Form->end(); ?>


<div class="row text-center">
  <div class="col-xs-12">
     <?php
        echo $this->Html->link(
        'Atrás',
        ['controller' => 'Users', 'action' => 'modify_user', $id], ['class'=>'btn btn-primary']
        );
      ?>
  </div>
</div>



<script>

    function compare()
    {
        var pass = document.getElementById('pass');
        var repa = document.getElementById('repa');
        var success = true;

        if(pass.value !== repa.value)
        {
            document.getElementById('message').style = "color:red";
            document.getElementById('message').innerHTML = "Las contraseñas deben ser iguales";
            success = false;
        }

        return success;
    }

</script>


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
