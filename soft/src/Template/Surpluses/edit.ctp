<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá el monto del superávit!</h1>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($surplus) ?>
        <div class="form-group">
            <label>Monto asignado</label>
            <div class="input-group">
                <span class="input-group-addon" >₡</span>
                <?= $this->Form->input('amount', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Ejemplo: 50000']); ?>
                <span class="input-group-addon">.00</span>
            </div>

            <?php
            echo $this->Form->input('detail', ['label'=>'Detalles', 'class'=>'form-control', 'type'=>'textarea']);
            echo $this->Form->input('association_id', ['options' => $associations, 'label'=>'Asociación', 'class'=>'form-control']);
            ?>
        </div>

<br>
     <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

