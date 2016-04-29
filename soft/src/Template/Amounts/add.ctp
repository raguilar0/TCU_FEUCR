<div class="row text-center">
    <div class="col-xs-12">
        <h1 id="association_name"></h1>  


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
        
        
    ?>
    
    
    
</div>


<br>
<br>
<br>
<br>


<script>

$(document).ready( function ()
    {
        getAssociations();
    });

    function getAssociations()
    {
        var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function()
        {
    
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
    
                var html = "";
                var obj = JSON.parse(xhttp.responseText);

                for(var key in obj)
                {
                    html += "<option>"+obj[key].name+"</option>";
                }
                
                
                document.getElementById("associations").innerHTML = html;
                
                changeAssociation();
                
            }
            else
            {
                if( xhttp.status == 404)
                {
    
                   document.getElementById("callback").innerHTML = "Error: Se envió un nombre de sede que no coincide con nuestros registros.";
                   document.getElementById("callback").style.color = "red";
                   setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 9000);
               
                } 
    
                
            }          
               
        };
    
        xhttp.open("GET", "/FEUCR/soft/amounts/getAssociations/"+document.getElementById("headquarter_id").value,true);
        //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
       
    }
    

    function changeAssociation()
    {
        document.getElementById("association_name").innerHTML = document.getElementById("associations").value;
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

