<div class = "row text-center">
    <div class = "col-xs-12">
        <h1>Agrega montos iniciales</h1>
    </div>
</div>

<div class="row text-center">
    <div class="col-xs-12">
        <h2 id="association_name"></h2>  


        <h3><?php
                if(empty($data))
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
        if(!empty($data))
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


    if(!empty($data))
    {
        echo $this->Form->create(null, ['id'=>'submit_add_initial_amount']);
            echo "<div class='form-group'>";

            echo "<div class='row text-center'>";
            
                
                echo "<div class = 'col-xs-12 col-md-6 col-md-offset-3'>";
                 echo "<h4><label for='#date'>Fecha de Asignación</label>"."<br><input name='date' type='date' id = 'date' class='form-control date' required >"."</h4>";
                echo "</div >";
                
            echo "</div>";

            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";

            echo "<div class='row'>";

                echo "<div class='col-xs-12 col-md-4'>";
                        echo "<label><h4><strong>Trasferir de: </strong></h4></label>";
                           echo "<select class='form-control'  name = 'first_tract'>";
                    
                                /**
                                 *  Imprime las fechas del tracto anterior y las actuales 
                                 **/
                    
                                foreach ($data[0] as $key => $value) {
                                    echo "<option>".$value['date']->format('Y-m-d')."</option>"."<br>";
                                }
                                
                                foreach ($data[1] as $key => $value) {
                                    echo "<option>".$value['date']->format('Y-m-d')."</option>"."<br>";
                                }
                                
                            echo "</select>";                    
                echo "</div>";
                
                echo "<div class='col-xs-12 col-md-4'>";
                    
                echo "</div>";
                
                echo "<div class='col-xs-12 col-md-4'>";
                        echo "<label><h4><strong>Hacia : </strong></h4></label>";
                           echo "<select class='form-control' name = 'second_tract'>";
                    
                                /**
                                 *  Imprime solo las fechas de los tractos acutales
                                 **/ 
                                foreach ($data[1] as $key => $value) {
                                    echo "<option>".$value['date']->format('Y-m-d')."</option>"."<br>";
                                }
                                
                            echo "</select>";                      
                echo "</div>";           
            echo "</div>"; 



            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";


            echo "<div class='row text-center'>";
                echo "<div class = 'col-xs-12'>";               
                    echo "<h4>".$this->Form->submit('Transferir', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])."</h4>";
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

