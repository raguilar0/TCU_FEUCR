<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá un nuevo superávit!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($surplus) ?>

    <div class="form-group">

        <label>Monto a asignar</label>
        <div class="input-group">
            <span class="input-group-addon" >₡</span>
            <?= $this->Form->input('amount', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Ejemplo: 50000']); ?>
            <span class="input-group-addon">.00</span>
        </div>
        
        <?php
        echo $this->Form->input('detail', ['type'=>'textarea','class'=>'form-control', 'label'=>'Detalles']);
        echo "<br>";
        echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control', 'label'=>'Asociación correspondiente']);
        ?>
    </div>
    <br>

    <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

