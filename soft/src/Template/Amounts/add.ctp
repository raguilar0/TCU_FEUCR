<div class="row text-center">
    <div class="col-xs-12">
        <h1><?php echo $amount['association']['name']. " (".$amount['association']['acronym'].")";?></h1>  


        <h3><?php

                if(!empty($amount['date']))
                {
                    $message = "Tracto: ".$amount['date'][0]['date']." - ".$amount['date'][0]['deadline'];
                }
                else
                {
                    $message = "Debe crear un tracto primero antes de poder asignar montos.";
                }

         echo $message;
         ?>
         </h3>  
    </div>
</div>


<br>
<br>


<div class="row text-center">
    <?php
        echo "<div class = 'col-xs-12 col-md-5'>";
    
        echo "<label><h4><strong>Sedes</strong></h4></label>";
           echo "<select class='form-control' name = 'type' onchange='prueba();'>";
    
    
    
                foreach ($head as $key => $value) {
                    echo "<option>".$value['name']."</option>"."<br>";
                }
                
            echo "</select>";
        echo "</div>";
        
        
        
        echo "<div class = 'col-xs-12 col-md-7'>";
    
        echo "<label><h4><strong>Asociaciones</strong></h4></label>";
           echo "<select class='form-control' name = 'type'>";
    
    
    
                foreach ($associations as $key => $value) {
                    echo "<option>".$value['name']."</option>"."<br>";
                }
                
            echo "</select>";
        echo "</div>";        
        
        
    ?>
    
    
    
</div>


<br>
<br>
<br>
<br>


<script>
    function getAssociations()
    {
        var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function()
        {
    
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
    
                document.getElementById("callback").innerHTML = "¡Los datos se guardaron con éxito!";
                document.getElementById("callback").style.color = "#01DF01";
    
                setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 3000);
             
            }
            else
            {
                if( xhttp.status == 404)
                {
    
                   document.getElementById("callback").innerHTML = "Ocurrió un error al guardar los datos. Puede deberse a lo siguiente: <br> <ul><li>Introdujo un valor en el campo de Número de Tracto fuera de [1,4]</li><li>Introdujo una fecha de inicio y de final que ya existe en la base de datos</li></ul>";
                   document.getElementById("callback").style.color = "red";
                   setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 9000);
               
                } 
    
                
            }          
               
        };
    
        xhttp.open("POST", document.getElementById("submit_add_tract").action,true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send($("#submit_add_tract").serialize());
       
    }
    
    
</script>





<?php

if(!empty($amount['date']))
{


	echo $this->Form->create($amount,['id'=>'submit5']);
	    echo "<div class='form-group'>";

            echo "<div class='row text-center'>";

                echo "<div class = 'col-xs-12 col-md-4'>"; 
                echo "<h4>".$this->Form->input('amount', ['class' => 'form-control', 'label'=>'Monto', 'min'=>'0', 'placeholder'=>'Monto a asignar'])."</h4>";
                echo "</div>";

                echo "<div class = 'col-xs-12 col-md-4'>";

                echo "<label for='sel1' id = 'tipos_label'><h4>Tipo</h4></label>";
                   echo "<select class='form-control' name = 'type'>";


                        $kind = $amount['amounts_type'];

                        foreach ($kind as $key => $value) {
                            echo "<option>".$key."</option>"."<br>";
                        }
                        
                    echo "</select>";
                echo "</div>";

                echo "<div class = 'col-xs-12 col-md-4'>"; 
                //echo "<h4>".$this->Form->input('date', ['class' => 'form-control date', 'label'=>'Fecha', 'id'=>'date'])."</h4>";
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
}
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

