<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá el monto inicial!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($initialAmount) ?>
        <div class="form-group">

        <label>Monto a asignar</label>
        <div class="input-group">
            <span class="input-group-addon" >₡</span>
            <?= $this->Form->input('amount', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Ejemplo: 50000']); ?>
            <span class="input-group-addon">.00</span>
        </div>
        <?php
            echo $this->Form->input('type', ['options' => $initialAmount->type, 'class'=> 'form-control','label'=>'Tipo']);
            echo $this->Form->input('association_id', ['options' => $associations, 'label'=>'Asociación', 'class' =>'form-control']);
            echo $this->Form->input('tract_id', ['options' => $tracts, 'class'=> 'form-control','label'=>'Tracto']);


        ?>

        </div>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

    <br>
    <div class="row text-center">
      <div class="col-xs-12">
         <?php
            echo $this->Html->link(
            'Atrás',
            ['controller' => 'InitialAmounts', 'action' => 'index'], ['class'=>'btn btn-primary']
            );
          ?>
      </div>
    </div>
