
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá una nueva Sede!</h1>
    </div>


</div>
<br>
<br>


    <?= $this->Form->create($headquarters) ?>
    <div class="form-group">
        <?php
            echo $this->Form->input('name', ['label'=>'Nombre', 'class'=>'form-control']);
            echo $this->Form->input('image_name', ['label'=>'Nombre de la imagen', 'class'=>'form-control']);
        ?>
    </div>
<br>
<br>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
<?= $this->Form->end() ?>

