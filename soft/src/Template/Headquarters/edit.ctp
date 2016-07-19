
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá la Sede!</h1>
    </div>


</div>
<br>
<br>


<?= $this->Form->create($headquarters,['enctype'=>'multipart/form-data']) ?>
<div class="form-group">
    <?php
    echo $this->Form->input('name', ['label'=>'Nombre', 'class'=>'form-control']);
    echo $this->Form->input('file', ['type'=>'file', 'label'=>'Imagen de la sede (.png, .jpg, .jpeg)']);
    ?>
</div>
<br>
<br>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
<br>
<?= $this->Form->end() ?>

<div class="row text-center">
  <div class="col-xs-12">
     <?php
        echo $this->Html->link(
        'Atrás',
        ['controller' => 'Headquarters', 'action' => 'index'], ['class'=>'btn btn-primary']
        );
      ?>
  </div>
</div>
