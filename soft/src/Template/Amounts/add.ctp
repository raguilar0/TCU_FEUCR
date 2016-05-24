<div class="row text-center">
    <div class="col-xs-12">
        <h1 id="association_name"></h1>  


        <h3><?php

                if(empty($data[0]))
                {
                    echo "Debe crear un tracto primero antes de poder asignar montos.";
                }
         ?>
         </h3>  
    </div>
</div>


<br>
<br>


<div class="row text-center">
    <?php
        if(!empty($data[0]))
        {
            echo "<div class = 'col-xs-12 col-md-5'>";
        
            echo "<label><h4><strong>Sedes</strong></h4></label>";
               echo "<select class='form-control' id= 'headquarter_id' name = 'type' onchange='getAssociations();'>";
        
        
        
                    foreach ($head as $key => $value) {
                        echo "<option>".$value['name']."</option>"."<br>";
                    }
                    
                echo "</select>";
            echo "</div>";
            
            
            
            echo "<div class = 'col-xs-12 col-md-7'>";
        
            echo "<label><h4><strong>Asociaciones</strong></h4></label>";
               echo "<select class='form-control' name = 'type' id = 'associations' onchange = 'changeAssociation();'>";

                    
                echo "</select>";
            echo "</div>"; 
        }
            
        
    ?>
    
    
    
</div>


<br>
<br>
<br>
<br>



<?php


    if(!empty($data[0]))
    {
        echo $this->Form->create(null, ['id'=>'submit5']);

            echo "<div class='form-group'>";

            echo "<div class='row text-center'>";
                echo "<div class = 'col-xs-12 col-md-6 col-md-offset-3'>";
                 echo "<h4><label for='#date'>Fecha de Asignación</label>"."<br><input name='date' type='date' id = 'date' class='form-control date' required >"."</h4>";
                echo "</div >";
            echo "</div>";

            echo "<br>";
            echo "<br>";


                echo "<div class='table-responsive'>";
                    echo "<table class='table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Montos</th>";
                    echo "<th>Fecha del Tracto</th>";
                    echo "</tr>";
                    echo "</thead>";
                
                    echo "<tbody>";

                        if(!empty($data[0]))
                        {
                          echo "<tr>";
                            echo "<td>".$this->Form->input('amountTract1', ['class' => 'form-control', 'label'=>'Tracto 1', 'min'=>'0', 'placeholder'=>'Monto a asignar', 'required'])."</td>";
                            echo "<td>".$this->Form->input('tract0', ['class' => 'form-control', 'label'=>'Tracto 1','type'=>'text','disabled','value'=>$data[0]['date']])."</td>";
                          echo "</tr>";
                        }
                      
                        if(!empty($data[1]))
                        {
                          echo "<tr>";
                            echo "<td>".$this->Form->input('amountTract2', ['class' => 'form-control', 'label'=>'Tracto 2', 'min'=>'0', 'placeholder'=>'Monto a asignar', 'required'])."</td>";
                            echo "<td>".$this->Form->input('tract1', ['class' => 'form-control', 'label'=>'Tracto 2','type'=>'text','disabled','value'=>$data[1]['date']])."</td>";
                          echo "</tr>";
                        }


                        if(!empty($data[2]))
                        {
                          echo "<tr>";
                            echo "<td>".$this->Form->input('amountTract3', ['class' => 'form-control', 'label'=>'Tracto 3', 'min'=>'0', 'placeholder'=>'Monto a asignar', 'required'])."</td>";
                            echo "<td>".$this->Form->input('tract2', ['class' => 'form-control', 'label'=>'Tracto 2','type'=>'text','disabled','value'=>$data[2]['date']])."</td>";
                          echo "</tr>";
                        }


                      if(!empty($data[3]))
                      {
                          echo "<tr>";
                            echo "<td>".$this->Form->input('amountTract4', ['class' => 'form-control', 'label'=>'Tracto 4', 'min'=>'0', 'placeholder'=>'Monto a asignar', 'required'])."</td>";
                            
                            echo "<td>".$this->Form->input('tract3', ['class' => 'form-control', 'label'=>'Tracto 3','type'=>'text','disabled','value'=>$data[3]['date']])."</td>";
                          echo "</tr>";
                      }


                    echo "</tbody>";
                  echo "</table>";
              echo "</div>";



            echo "<div class='row text-center'>";
                echo "<div class='col-xs-12'>";
                    echo "<h4>Detalle</h4>";
                    echo "<h4>".$this->Form->textarea('detail', ['class' => 'form-control', 'required'])."</h4>";
                echo "</div>";
            echo "</div>";


            echo "<div class='row text-center'>";
                echo "<div class = 'col-xs-12'>";               
                    echo "<h4>".$this->Form->submit('Guardar Montos', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>";
                echo "</div>";
            echo "</div>";

            echo "</div>";




        echo $this->Form->end();        
    }



?>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"><?= $this->Flash->render('addAmounts') ?></h4>   
    </div>

</div>


<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>




<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations', ['class'=>'btn btn-primary']);?>
  </div>
</div>

