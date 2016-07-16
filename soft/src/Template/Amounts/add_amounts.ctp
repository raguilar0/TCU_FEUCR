<div class="row text-center">
    <div class="col-xs-12">
        <h1 id="association_name"></h1>

        <h3><?php
                echo "<h1>Agregar un nuevo monto</h1>";
         ?>
         </h3>
    </div>
</div>

<br>
<br>

 <div class="row text-center">
     <?php


        echo $this->Form->create(null, ['id'=>'submit6']);

     echo "<div class = 'col-xs-12'>";

         echo "<label'><h4><strong>Monto</strong></h4></label>";
         echo "<div class='input-group'>";
             echo "<span class='input-group-addon' >₡</span>";
                echo $this->Form->input('amount', ['class' => 'form-control','label'=>false, 'placeholder'=>'Ejemplo: 500000']);
             echo "<span class='input-group-addon'>.00</span>";
         echo "</div >";
     echo "</div >";

     ?>
 </div>


<br>
<br>
<br>
<br>

<?php

    echo "<div class='form-group'>";
        echo "<div class='row text-center'>";
            echo "<div class='col-xs-12'>";
                echo "<label><h4><strong>Detalle</strong></h4></label>";
                echo "<h4>".$this->Form->textarea('detail', ['class' => 'form-control', 'required'])."</h4>";
            echo "</div>";
        echo "</div>";
?>

<br>
<br>
<br>

<?php
         echo "<div class='row text-center'>";
            echo "<div class = 'col-xs-12'>";
                echo "<h4>".$this->Form->submit('Guardar Monto', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>";
            echo "</div>";
        echo "</div>";


    echo "</div>";

    echo $this->Form->end();


?>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"><?= $this->Flash->render('success') ?></h4>
    </div>

</div>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"><?= $this->Flash->render('error') ?></h4>
    </div>

</div>
