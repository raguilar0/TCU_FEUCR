<!-- File: src/Template/Users/login.ctp -->

<div class="container body">

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <?= $this->Flash->render('auth') ?>
  <?= $this->Form->create() ?>

  <div class='row'>
    <div class='col-xs-12 col-md-6 col-md-offset-3' id=form_login>
      <fieldset>
      <legend><?= __('Por favor digite su usuario y contraseña') ?></legend>
      <h4><?= $this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario']) ?></h4>
      <h4><?= $this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña']) ?></h4>
      </fieldset>
      <?= $this->Form->submit(__('Login')); ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>


<?php
/*
echo $this->Form->create();

echo "<div class='form-group' id=form_login>";
  echo "<div class = 'row'>";
    echo "<div class = 'col-xs-12 col-md-4'>";
      echo "<h4> Por favor digite su usuario y contraseña </h4>";
      echo "<hr />";
      echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario'])."</h4>";
      echo "<h4>".$this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña'])."</h4>";
    echo "</div>";
  echo "</div>";
echo "</div>";

  echo "<div class = 'row'>";
      echo "<div class = 'col-xs-12'>";
         echo "<h4>".$this->Form->submit('Ingresar', ['class' => 'form-control', 'id' => 'login'])."</h4>";
      echo "</div>";
  echo "</div>";


echo $this->Form->end();
*/
?>
