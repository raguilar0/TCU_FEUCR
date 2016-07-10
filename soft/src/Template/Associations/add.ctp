
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá una nueva asociación!</h1>
    </div>


</div>
<br>
<br>


    <?= $this->Form->create($association) ?>
        <div class="form-group">

        <?php
            echo $this->Form->input('acronym', ['label'=>'Sigla', 'class'=>'form-control', 'placeholder'=>'Ejemplo: AECCI']);
            echo $this->Form->input('name', ['label'=>'Nombre de la asociación', 'class'=>'form-control', 'placeholder'=>'Ejemplo: Asociación de Estudiantes de Ciencias de la Computación e Informática']);
            echo $this->Form->input('location', ['label'=>'Dirección', 'class'=>'form-control', 'placeholder'=>'Ejemplo: San Pedro']);
            echo $this->Form->input('schedule', ['label'=>'Horario', 'class'=>'form-control', 'placeholder'=>'Ejemplo: 7:00 am - 8:00 pm']);
        echo $this->Form->input('authorized_card', ['options' => $association->authorized_card, 'class'=> 'form-control','label'=>'Tarjeta autorizada']);
            echo $this->Form->input('headquarter_id', ['options' => $headquarters, 'label'=>'Sede', 'class'=>'form-control']);
        ?>

        </div>
<br>
<br>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>

