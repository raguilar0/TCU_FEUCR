<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá el monto del superávit!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($surplus) ?>
        <div class="form-group">
            <?php
            echo $this->Form->input('amount', ['label'=>'Monto asignado', 'class'=>'form-control']);
            echo $this->Form->input('date', ['label'=>'Fecha de asignación', 'type'=>'text', 'class'=>'form-control']);
            echo $this->Form->input('detail', ['label'=>'Detalles', 'class'=>'form-control']);
            echo $this->Form->input('association_id', ['options' => $associations, 'label'=>'Asociación', 'class'=>'form-control']);
            ?>
        </div>


    <?= $this->Form->button(__('Guardar'), ['class'=>'form-control']) ?>
    <?= $this->Form->end() ?>

