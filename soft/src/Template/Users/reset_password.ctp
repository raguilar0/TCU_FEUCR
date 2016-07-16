<!-- src/Template/Users/reset_password.ctp -->
<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>Cambio de contraseña</h1>
    </div>
</div>



    <?= $this->Form->create($user,['onsubmit'=>'return compare()']); ?>
  <div class="form-group">
      <h4> <?= $this->Form->input('password', ['class' => 'form-control','label'=>'Nueva contraseña', 'maxlength'=> '16','type'=>'password', 'id'=>'pass']); ?> </h4>
      <h4> <?= $this->Form->input('repass', ['class' => 'form-control','label'=>'Repetir contraseña', 'maxlength'=> '16','type'=>'password', 'id'=>'repa']); ?></h4>
      <span id='message'></span>
  </div>






<br>
<br>
<div class="row">
    <div class="text-center">
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
    $(document).ready(function () {
        document.getElementById("pass").value = "";
        document.getElementById("repa").value = "";
    });


</script>


<br>
<br>
<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/users/', ['class'=>'btn btn-primary']);?>
  </div>
</div>
