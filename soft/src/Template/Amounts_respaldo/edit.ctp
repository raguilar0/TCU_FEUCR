
<?php if(!empty($data)){?>

<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Modificá los montos de este año!</h1>
    </div>
</div>



<div class="table-responsive">
    <table class="table">
        <thead>
        <th>Montos</th>
        <th>Fechas</th>
        <th>Número de Tracto</th>
        </thead>

        <tbody>
        <?php

            echo $this->Form->create();
            echo "<div class='form-group'>";

            foreach ($data as $key => $value)
            {
                echo "<tr>";
                echo "<td> <input type='text' class='form-control' value = ".$value['amount']." name = 'tract_".$value['tract']['number']."'></td>";
                echo "<td>".$value['tract']['date']." - ".$value['tract']['deadline']."</td>";
                echo "<td>".$value['tract']['number']."</td>";
                echo "</tr>";
            }

            echo "</div>";



            echo "</tbody>";
            echo "</table>";

            echo "<br>";
            echo "<div class='row text-center'>";
            echo "<div class = 'col-xs-12'>";
            echo "<h4>".$this->Form->submit('Actualizar Montos', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>";
            echo "</div>";
            echo "</div>";

            echo $this->Form->end();
        }
        else
        {
            echo "<h1>No hay montos asignados para el año ". date('Y')."</h1>";
        }

    ?>

</div>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"><?= $this->Flash->render('message') ?></h4>
    </div>

</div>