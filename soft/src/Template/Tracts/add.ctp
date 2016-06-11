
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá una nueva fecha de tracto!</h1>
    </div>

</div>
<br>
<br>


    <?= $this->Form->create($tract) ?>

<div class="form-group">
    <?php
    echo $this->Form->input('number', ['class'=>'form-control', 'placeholder'=>'Valores válidos: 1, 2, 3, 4']);

    echo "<div class='row'>";
    echo "<div class = 'col-xs-12'>";
    //echo "<h4>".$this->Form->input('date', ['label'=>'Fecha de Inicio', 'type'=>'date', 'value'=>$tract['dates']['date']])."</h4>";
    echo "<h4><label for='#date'>Fecha de Inicio</label>"."<br><input name='date' type='date' id = 'date' class='form-control date' required value=".$tract['dates']['date'].">"."</h4>";
    echo "</div >";

    echo "<div class = 'col-xs-12'>";
    //echo "<h4>".$this->Form->input('deadline', ['class' => 'form-control','label'=>'Fecha Final', 'type'=>'date', 'value'=>$tract['dates']['deadline']])."</h4>";
    echo "<h4><label for='#date'>Fecha de Finalización</label>"."<br><input name='deadline' type='date' id = 'deadline' class='form-control date' required value=".$tract['dates']['deadline'].">"."</h4>";
    echo "</div >";
    echo "</div>";

    ?>
</div>



    <?= $this->Form->button(__('Agregar'),['id'=>'asso_id', 'class'=>'form-control']) ?>
    <?= $this->Form->end() ?>

