<!-- File: src/Template/Users/login.ctp -->

<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Por favor digite su usuario y contraseña') ?></legend>
        <?= $this->Form->input('username', ['label'=>'Nombre de Usuario']) ?>
        <?= $this->Form->input('password',['label'=>'Contraseña']) ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>

<?php
echo "<div class='form-group' id=form_login>";
  echo "<div class = 'row'>";
    echo "<div class = 'col-xs-12 col-md-4'>";
      echo "<h4> Por favor digite su usuario y contraseña </h4>";
      echo "<hr />";
      echo "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario'])."</h4>";
      echo "<h4>".$this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña'])."</h4>";
    echo "</div>";
  echo "</div>";

  echo "<div class = 'row'>";
      echo "<div class = 'col-xs-12'>";
         echo "<h4>".$this->Form->submit('Ingresar', ['class' => 'form-control', 'id' => 'login'])."</h4>";
      echo "</div>";
  echo "</div>";

echo "</div >";


echo $this->Form->end();

?>
