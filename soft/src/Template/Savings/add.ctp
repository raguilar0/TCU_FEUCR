
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá un nuevo monto de ahorro!</h1>
    </div>


</div>
<br>
<br>

    <?= $this->Form->create($saving) ?>
        <div class="form-group">
            <?php
            echo $this->Form->input('amount', ['label'=>'Monto a asignar', 'class'=>'form-control']);
            echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control', 'label'=>'Asociación']);
            echo $this->Form->input('tract_id', ['options' => $tracts, 'label'=>'Tracto Asociado', 'class'=>'form-control']);
            echo $this->Form->input('letter', ['type'=>'textarea', 'class'=>'form-control', 'label'=>'Carta', 'rows'=>'20']);
            ?>
        </div>

<br>
    <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

