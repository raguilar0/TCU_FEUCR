
<?php if(!empty($tracts)){ ?>
    <div class="row text-center">
        <div class="col-xs-12">
            <h1>¡Agregá un nuevo monto de ahorro!</h1>
        </div>


    </div>
    <br>
    <br>

        <?= $this->Form->create($saving,['enctype'=>'multipart/form-data']) ?>
            <div class="form-group">

                <label>Monto a asignar</label>
                <div class="input-group">
                    <span class="input-group-addon" >₡</span>
                    <?= $this->Form->input('amount', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Ejemplo: 50000']); ?>
                    <span class="input-group-addon">.00</span>
                </div>
                <?php
                    if(($this->request->session()->read('Auth.User.role')) == 'admin'){
                        echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control', 'label'=>'Asociación']);
                    }
                ?>

               <?= $this->Form->input('tract_id', ['options' => $tracts, 'label'=>'Tracto Asociado', 'class'=>'form-control']); ?>


               <?= $this->Form->input('letter', ['type'=>'file', 'label'=>'Subir carta (PDF)']); ?>

            </div>

    <br>
        <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
        <?= $this->Form->end() ?>

<?php
}
else
{
    echo "<h2>Aún no existen fechas de tracto asignadas para este año o para el siguiente, comuníquese con la contraloría para más detalle.</h2>";
}
?>

<br>
<div class="row text-center">
    <div class="col-xs-12">
        <?php
        echo $this->Html->link(
            'Atrás',
            ['action' => 'index'], ['class'=>'btn btn-primary']
        );
        ?>
    </div>
</div>
