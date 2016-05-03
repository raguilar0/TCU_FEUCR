<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#tract">Montos de Tracto</a></li>
  <li><a data-toggle="tab" href="#generated">Ingresos Generados</a></li>
  <li><a data-toggle="tab" href="#surplus">Superávit</a></li>
</ul>






<div class="tab-content">
  <div id="tract" class="tab-pane fade in active">

<div class="row text-center">
	<div class="col-xs-12 col-md-6">
	  <?php
		echo "<label><h4><strong>Año</strong></h4></label>";
   		echo "<select class='form-control' id= 'tracts_id' name = 'type' onchange='getAmounts(0,0);'>";



        foreach ($dates as $key => $value) {
        	echo $key;
            echo "<option>".$value['tract']['date']."</option>"."<br>";
        }
        
    	echo "</select>";
    	?>
	</div>	

</div>


<?php //variables de uso común
	 

	 $monto_ahorro = $monto_tracto = $caja_fuerte = $caja_chica = $total_gastos = 0;

	$periodo_tracto =  "";
	$association_name = $association[0]['name'];
	
	if(!empty($data['box']))
	{
		$caja_fuerte =  $data['box'][0]['big_amount'];
		$caja_chica =  $data['box'][0]['little_amount'];
	}

	if(!empty($data['amounts']))
	{
		$periodo_tracto = "Período de Tracto:<br><br> ".$data['amounts'][0]['tract']['date']." - ".$data['amounts'][0]['tract']['deadline'];
		$monto_ahorro = 0; //TODO: agregar el monto de ahorro
		$monto_tracto =  $data['amounts'][0]['amount'];
	}



	$total_gastos = 0;

?>

<div class="row text-center">
	<div class="col-xs-12">
		<h1><?php echo $association_name;?> </h1>
		<h2><?php echo $periodo_tracto;?> </h2>
		<?php echo "<br>"; ?>
		<h3><strong>Facturas</strong></h3>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Fecha</th>
				<th>Número de Factura</th>
				<th>Detalle</th>
				<th>Proveedor</th>
				<th>Monto</th>
				<th>Encargado</th>
				<th>Aclaraciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
				
				$invoices = $data['invoices'];

				$counter = 0;

				foreach ($invoices as $key) {
					echo "<tr>";
						echo "<td>".$counter."</td>";
						echo "<td>".$key['date']."</td>";
						echo "<td>".$key['number']."</td>";
						echo "<td>".$key['detail']."</td>";
						echo "<td>".$key['provider']."</td>";
						echo "<td>".$key['amount']."</td>";
						echo "<td>".$key['attendant']."</td>";
						echo "<td>".$key['clarifications']."</td>";
					echo "</tr>";

					++$counter;
					$total_gastos = $total_gastos + $key['amount'];
				}

			?>
		</tbody>
	</table>	
</div>

<div class="row">
	<div class="col-xs-12">
		<?php echo "<strong style='font-size:20px;'>Total: ".$total_gastos."</strong>";?>
	</div>
</div>

<br>
<hr>

<br>
<br>



<div class="row">

	<div class="col-xs-12 col-md-6 text-center">
		<h3>Cuadro de Ingresos</h3>

		<table class="table table-striped">
			<tr>
				<th>Monto de Tracto</th>
				<td><?php echo $monto_tracto?></td>
			</tr>

			<tr>
				<th>Monto de Ahorro</th>
				<td><?php echo $monto_ahorro?></td>
			</tr>

			<tr>
				<th>Total</th>
				<td><?php echo ($monto_ahorro+$monto_tracto)?></td>
			</tr>
									
		</table>
	</div>

	<div class="col-xs-12 col-md-6 text-center">
		<h3>Cajas</h3>

		<table class="table table-striped">
			<tr>
				<th>Caja Fuerte</th>
				<td><?php echo $caja_fuerte?></td>
			</tr>

			<tr>
				<th>Caja Chica</th>
				<td><?php echo $caja_chica?></td>
			</tr>

			<tr>
				<th>Total</th>
				<td><?php echo ($caja_chica+$caja_fuerte)?></td>
			</tr>
									
		</table>		
	</div>

</div>

<br>

<div class="row">
	<div class="col-xs-12 text-center">
		<h3>Estado General del Tracto</h3>

		<table class="table table-striped">
			<tr>
				<th>Saldo inicial de cajas</th>
				<td><?php echo ($caja_fuerte+$caja_chica) ?></td>
			</tr>

			<tr>
				<th>Ahorro del período anterior</th>
				<td><?php echo $monto_ahorro ?></td>
			</tr>

			<tr>
				<th>Ingresos del período</th>
				<td><?php echo $monto_tracto ?></td>
			</tr>
				
			<tr>
				<th><u>Total de ingresos</u></th>
				<td><?php echo ($caja_fuerte+$caja_chica+$monto_ahorro+$monto_tracto) ?></td>
			</tr>

			<tr>
				<th>Total de gastos</th>
				<td><?php echo $total_gastos ?></td>
			</tr>

			<tr>
				<th><u>Saldo final</u></th>
				<td><?php echo ($caja_fuerte+$caja_chica+$monto_ahorro+$monto_tracto)-$total_gastos?></td>
			</tr>

			<tr>
				<th>Total de cajas</th>
				<td><?php echo ($caja_chica+$caja_fuerte)?></td>
			</tr>

			<tr>
				<th><u>Cuenta</u></th>
				<td><?php echo (($caja_fuerte+$caja_chica+$monto_ahorro+$monto_tracto)-$total_gastos)-($caja_chica+$caja_fuerte)?></td>
			</tr>												
		</table>			
	</div>	
</div>






  </div>








  <div id="surplus" class="tab-pane fade">
    <h3>Menu 1</h3>
    <p>Some content in menu 1.</p>
  </div>
  <div id="generated" class="tab-pane fade">
    <h3>Menu 2</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>




<script>
$(document).ready( function ()
    {
        getAmounts(0,0);
    });

    function getAmounts(amount_type, box_type)
    {
        var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function()
        {
    
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
            	alert(xhttp.responseText);
    			/**
                var html = "";
                var obj = JSON.parse(xhttp.responseText);

                for(var key in obj)
                {
                    html += "<option>"+obj[key].name+"</option>";
                }
                
                
                document.getElementById("associations").innerHTML = html;
                
                changeAssociation();
                **/
            }
            else
            {
                if( xhttp.status == 404)
                {
    /**
                   document.getElementById("callback").innerHTML = "Error: Se envió un nombre de sede que no coincide con nuestros registros.";
                   document.getElementById("callback").style.color = "red";
                   setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 9000);
               **/
                } 
    
                
            }          
               
        };
    
    	var path = location.pathname;

    	path = path.replace('detailed_information','getAmounts');

    	path = path+"/"+amount_type+"/"+box_type+"/"+document.getElementById("tracts_id").value;

        xhttp.open("GET",path,false);
        //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
       
    }
</script>







<br>

<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/show_associations/5', ['class'=>'btn btn-primary']);?>
  </div>
</div>