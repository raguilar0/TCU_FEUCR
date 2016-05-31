
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá el superávit!</h1>
    </div>
</div>



<?php



echo $this->Form->create($surplus);
    echo "<div class='form-group'>";

        echo "<div class='row text-center'>";

            echo "<div class = 'col-xs-12 col-md-6'>"; 
            echo "<h4>".$this->Form->input('amount', ['class' => 'form-control', 'label'=>'Monto', 'min'=>'0', 'placeholder'=>'Monto a asignar'])."</h4>";

            echo "</div>";



            echo "<div class = 'col-xs-12 col-md-6'>"; 

            echo "<h4><label for='date'> Fecha</label>"."<br><input name='date' type='date' id= 'date' class='form-control date' required>"."</h4>";

            echo "</div>";                                

        echo "</div>";

        echo "<div class='row text-center'>";
            echo "<div class='col-xs-12'>";
                echo "<h4>Detalle</h4>";
                echo "<h4>".$this->Form->textarea('detail', ['class' => 'form-control'])."</h4>";
            echo "</div>";
        echo "</div>";


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
        <h4 id="callback" style="color:#01DF01"><?= $this->Flash->render('addSurplus') ?></h4>   
    </div>

</div>




<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/surpluses/show_associations/1', ['class'=>'btn btn-primary']);?>
  </div>
</div>

