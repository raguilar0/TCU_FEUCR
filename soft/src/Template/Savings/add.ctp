
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá un monto de ahorro!</h1>
    </div>
</div>



<?php



echo $this->Form->create($saving);
    echo "<div class='form-group'>";

        echo "<div class='row text-center'>";

            echo "<div class = 'col-xs-12 '>"; 
            echo "<h4>".$this->Form->input('amount', ['class' => 'form-control', 'label'=>'Monto', 'min'=>'0', 'placeholder'=>'Monto a asignar'])."</h4>";

            echo "</div>";



        echo "</div>";

        echo "<div class='row text-center'>";
            echo "<div class='col-xs-12'>";
                echo "<h4>Carta</h4>";
                echo "<h4>".$this->Form->textarea('letter', ['class' => 'form-control', 'placeholder'=>'Espacio para la carta'])."</h4>";
            echo "</div>";
        echo "</div>";




        echo "<div class='row text-center'>";
            echo "<div class = 'col-xs-12'>";               
                echo "<h4>".$this->Form->submit('Guardar', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>";
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

