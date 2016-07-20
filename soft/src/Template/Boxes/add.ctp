<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá las cajas!</h1>
    </div>
</div>


    <?= $this->Form->create($box) ?>

    <div class="form-group">
        <?php
        echo $this->Form->input('little_amount',['label'=>'Caja chica', 'class'=>'form-control']);
        echo $this->Form->input('big_amount',['label'=>'Caja fuerte','class'=>'form-control']);
        echo $this->Form->input('type',['options'=>$type,'label'=>'Tipo de caja', 'class'=>'form-control']);
        echo $this->Form->input('association_id', ['options' => $associations,'class'=>'form-control', 'label'=>'Elegí la asociación correspondiente']);
        echo $this->Form->input('tract_id',['label'=>'Tracto', 'class'=>'form-control']);
        ?>
    </div>
<div class="row text-center">
    <div class="col-xs-12">
        <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-primary']) ?>
    </div>
</div>

    <?= $this->Form->end() ?>

