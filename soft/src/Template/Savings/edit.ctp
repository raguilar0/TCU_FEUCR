
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá el monto de ahorro!</h1>
    </div>

</div>
<br>
<br>
    <?= $this->Form->create($saving) ?>

        <?php
            echo $this->Form->input('amount', ['label'=>'Monto a asignado', 'class'=>'form-control']);
            echo $this->Form->input('state', ['label'=>'Estado', 'class'=>'form-control']);
            echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control']);
            echo $this->Form->input('tract_id', ['options' => $tracts, 'class'=> 'form-control','label'=>'Id del tracto']);
            echo $this->Form->input('letter', ['type'=>'textarea', 'class'=>'form-control', 'label'=>'Carta', 'rows'=>'20']);
        ?>

<br>
    <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

