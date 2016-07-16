<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá el monto!</h1>
    </div>

</div>
<br>
<br>

<?= $this->Form->create($amount) ?>
<div class="form-group">

    <label>Monto a asignar</label>
    <div class="input-group">
        <span class="input-group-addon" >₡</span>
        <?= $this->Form->input('amount', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Ejemplo: 50000']); ?>
        <span class="input-group-addon">.00</span>
    </div>
    <?php

    echo $this->Form->input('detail', ['class'=> 'form-control','label'=>'Detalle']);



    ?>
<br>
</div>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
<?= $this->Form->end() ?>

<br>
<div class="row text-center">
  <div class="col-xs-12">
     <?php
        echo $this->Html->link(
        'Atrás',
        ['controller' => 'Amounts', 'action' => 'index'], ['class'=>'btn btn-primary']
        );
      ?>
  </div>
</div>
