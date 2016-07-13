<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá una nueva cuenta de ahorro!</h1>
          <h2>Ingresos Generados</h2>
    </div>

</div>
<br>
<br>

    <?= $this->Form->create($savingAccount) ?>
        <div class="form-group">
            <label>Monto a asignar</label>
            <div class="input-group">
                <span class="input-group-addon" >₡</span>
                <?= $this->Form->input('amount', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Ejemplo: 50000']); ?>
                <span class="input-group-addon">.00</span>
            </div>

            <?php
            echo $this->Form->input('bank', ['class'=>'form-control', 'label'=>'Nombre del banco', 'placeholder'=>'Ejemplo: BCR']);
            echo $this->Form->input('account_owner', ['class'=>'form-control', 'label'=>'Nombre del dueño de la tarjeta', 'placeholder'=>'Ejemplo: Andrey Pérez']);
            echo $this->Form->input('card_number', ['class'=>'form-control', 'label'=>'Número de tarjeta', 'placeholder'=>'Ejemplo: 4388-4568-1020-7714']);
            echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control', 'label'=>'Asociación']);
            echo $this->Form->input('tract_id', ['options' => $tracts, 'label'=>'Tracto', 'class'=>'form-control']);
            ?>
        </div>


<br>
<br>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>
