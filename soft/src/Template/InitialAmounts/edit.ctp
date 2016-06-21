<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá el monto inicial!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($initialAmount) ?>
        <div class="form-group">

        <?php
            echo $this->Form->input('amount', ['class'=>'form-control', 'label'=>'Monto']);
            echo $this->Form->input('type', ['options' => $initialAmount->type, 'class'=> 'form-control','label'=>'Tipo']);
            echo $this->Form->input('date', ['class'=>'form-control', 'label'=>'Fecha de asignación', 'type'=>'text']);
            echo $this->Form->input('association_id', ['options' => $associations, 'label'=>'Asociación', 'class' =>'form-control']);
            echo $this->Form->input('tract_id', ['options' => $tracts, 'class'=> 'form-control','label'=>'Tracto']);


        ?>

        </div>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

