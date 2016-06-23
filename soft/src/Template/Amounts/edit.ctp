
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá el monto!</h1>
    </div>

</div>
<br>
<br>

<?= $this->Form->create($amount) ?>

<div class="form-group">
    <?php
    echo $this->Form->input('amount', ['class'=>'form-control', 'label'=>'Monto']);
    echo $this->Form->input('detail', ['type'=>'textarea', 'label'=>'Detalle', 'class'=>'form-control']);
    echo $this->Form->input('type', ['class'=>'form-control', 'label'=> 'Tipo']);
    echo $this->Form->input('association_id', ['options' => $associations, 'class'=> 'form-control', 'label'=>'Asociación']);
    echo $this->Form->input('tract_id', ['options' => $tracts, 'class'=>'form-control', 'label'=>'Id del tracto']);
    ?>


</div>

<br>
<?= $this->Form->button(__('Guardar'), ['id'=> 'asso_id', 'class'=> 'form-control']) ?>
<?= $this->Form->end() ?>

