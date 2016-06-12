<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá un nuevo superávit!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($surplus) ?>

    <div class="form-group">
        <?php
        echo $this->Form->input('amount', ['class'=>'form-control', 'label'=>'Monto a asignar']);
        echo $this->Form->input('date', ['type'=>'text', 'class'=>'form-control', 'label'=>'Fecha de asignación del monto']);
        echo $this->Form->input('detail', ['type'=>'textarea','class'=>'form-control', 'label'=>'Detalles']);
        echo "<br>";
        echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control', 'label'=>'Asociación correspondiente']);
        ?>
    </div>
    <br>

    <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

