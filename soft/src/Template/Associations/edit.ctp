
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Editá la asociación!</h1>
    </div>


</div>
<br>
<br>


<?= $this->Form->create($association) ?>
<div class="form-group">

    <?php
    echo $this->Form->input('acronym', ['label'=>'Sigla', 'class'=>'form-control']);
    echo $this->Form->input('name', ['label'=>'Nombre de la asociación', 'class'=>'form-control']);
    echo $this->Form->input('location', ['label'=>'Dirección', 'class'=>'form-control']);
    echo $this->Form->input('schedule', ['label'=>'Horario', 'class'=>'form-control']);
    echo $this->Form->input('authorized_card', ['options' => $association->authorized_card, 'class'=> 'form-control','label'=>'Tarjeta autorizada']);
    echo $this->Form->input('enable', ['options' => $association->enable, 'class'=> 'form-control','label'=>'Estado']);
    echo $this->Form->input('headquarter_id', ['options' => $headquarters, 'label'=>'Sede', 'class'=>'form-control']);
    ?>

</div>
<br>
<br>
<?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
<?= $this->Form->end() ?>