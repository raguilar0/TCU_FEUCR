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

  <?= $this->Form->create() ?>

  <div class='row'>
    <div class='col-xs-12 col-md-6 col-md-offset-3' id=form_login>
      <fieldset>
      <h4><b><?= __('Por favor digite su usuario y contraseña') ?></b></h4>
          <br>
      <h4><?= $this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario']) ?></h4>
      <h4><?= $this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña']) ?></h4>
      </fieldset>

    </div>
  </div>
<br><br>
    <div class="row text-center">
        <div class="col-xs-12">
            <?= $this->Form->submit(__('Login'),['class'=>'btn btn-primary']); ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01">
          <?= $this->Flash->render('success') ?></h4>
    </div>
</div>

<div class="row text-right">
    <div class="col-xs-12 col-md-6">
        <h4 id="callback" style="color:#FF0000">
          <?= $this->Flash->render('error') ?></h4>
    </div>
</div>

<div class="row text-right">
    <div class="col-xs-12 col-md-6">
        <h4 id="callback" style="color:#FF0000">
            <?= $this->Flash->render('auth') ?>
    </div>
</div>
