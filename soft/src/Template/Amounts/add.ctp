<div class="row text-center">
    <div class="col-xs-12">
        <h1><?php echo $amount['association']['name']. " (".$amount['association']['acronym'].")";?></h1>    
    </div>
</div>


<?php



	echo $this->Form->create($amount,['id'=>'submit5']);
	    echo "<div class='form-group'>";

            echo "<h4>".$this->Form->input('amount', ['class' => 'form-control', 'label'=>'Monto', 'min'=>'0', 'placeholder'=>'Monto a asignar'])."</h4>";

            echo "<h4>".$this->Form->input('amount_saving', ['class' => 'form-control', 'label'=>'Monto de Ahorro', 'min'=>'0', 'placeholder'=>'Monto a Asignar'])."</h4>";


            echo "<h4>".$this->Form->input('date', ['class' => 'form-control','label'=>'Fecha de Inicio del Tracto', 'value'=>$amount['date']['date']])."</h4>";
            echo "<h4>".$this->Form->input('deadline', ['class' => 'form-control','label'=>'Fecha de Cierre del Tracto', 'value'=>$amount['date']['deadline']])."</h4>";


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
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>




<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/amounts/show_associations', ['class'=>'btn btn-primary']);?>
  </div>
</div>