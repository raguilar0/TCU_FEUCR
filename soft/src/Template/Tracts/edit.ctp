<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá las fechas tractos!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($tract) ?>
        <div class="form-group">
            <?php

            echo $this->Form->input('number', ['class'=>'form-control', 'label'=>'Número de tracto']);
            echo $this->Form->input('date', ['class'=>'form-control', 'label'=>'Fecha de inicio', 'type'=>'text']);
            echo $this->Form->input('deadline', ['class'=>'form-control', 'label'=>'Fecha de finalización', 'type'=>'text']);
            ?>
        </div>



    <?= $this->Form->button(__('Guardar'), ['id'=>'asso_id', 'class'=>'form-control']) ?>
    <?= $this->Form->end() ?>

