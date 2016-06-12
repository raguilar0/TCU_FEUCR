
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá una nueva fecha de tracto!</h1>
    </div>

</div>
<br>
<br>


    <?= $this->Form->create($tract) ?>

<div class="form-group">
    <?php
    echo $this->Form->input('number', ['class'=>'form-control', 'placeholder'=>'Valores válidos: 1, 2, 3, 4']);

    echo $this->Form->input('date', ['type'=>'text', 'class'=>'form-control', 'label'=>'Fecha de inicio de tracto']);

    echo $this->Form->input('deadline', ['type'=>'text', 'class'=>'form-control', 'label'=>'Fecha de finalización del tracto']);

    ?>
</div>



    <?= $this->Form->button(__('Agregar'),['id'=>'asso_id', 'class'=>'form-control']) ?>
    <?= $this->Form->end() ?>

