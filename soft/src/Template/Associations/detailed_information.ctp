<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#tract" onclick="getAmounts(0,0,0, document.getElementById('tracts_id'));">Montos de Tracto</a></li>
  <li><a data-toggle="tab" href="#generated" onclick="getAmounts(1,1,1,document.getElementById('generated_id'));">Ingresos Generados</a></li>
  <li><a data-toggle="tab" href="#surplus" onclick="getAmounts(2,2,2,document.getElementById('surplus_year_id'));">Superávit</a></li>
</ul>


<div class = "row text-center">
	<div class = "col-xs-12">
		<?php 
			echo "<h1 id='association_name'>".$association_name[0]['name']."</h1>";
		?>
		
		<h2 id = "tract_date"></h2>
	</div>
</div>



	<div class="tab-content">
		<div id="tract" class="tab-pane fade in active">

			<div class="row text-center">

				<div class="col-xs-12 col-md-6">
					<?php
					echo "<label><h5><strong>Elegí el año</strong></h5></label>";
					echo "<select class='form-control' id= 'tract_year_id' name = 'year' onchange='reloadPage(this)'>";


					foreach ($years as $key => $value) {
						echo "<option>".$value['year']."</option>"."<br>";
					}

					echo "</select>";
					?>
				</div>

				<div class="col-xs-12 col-md-6" style='margin-top: 15px;'>
					<?= $this->Form->input('tract_id', ['options' => $dates, 'class'=> 'form-control','label'=>'Elegí la fecha', 'id'=>'tracts_id', 'onchange'=>'getAmounts(0,0,0,this);']);?>

				</div>


			</div>



			<br>
			<br>
			<br>





			<h2><strong>Facturas</strong></h2>

			<div class="table-responsive text-center">

				<table class="table table-hover">
					<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th># Factura</th>
						<th>Detalle</th>
						<th>Proveedor</th>
						<th>Monto</th>
						<th>Encargado</th>
						<th>Aclaraciones</th>
					</tr>
					</thead>

					<tbody id="tract_invoices">

					</tbody>
				</table>
			</div>

			<div class="row">
				<div class="col-xs-12" id="tract_invoices_total">

				</div>
			</div>

			<br>
			<hr>

			<br>
			<br>



			<div class="row">

				<div class="col-xs-12 col-md-6 text-center">

					<table class="table table-striped">
						<tr>
							<th><p style="font-size: larger;text-decoration:underline;">Cuadro de ingresos</p></th>
							<td> </td>
						</tr>
						<tr>
							<th>Monto de Tracto</th>
							<td id="tract_amount"></td>
						</tr>

						<tr>
							<th>Monto de Ahorro</th>
							<td class="saving_amount"></td>
						</tr>

						<tr>
							<th>Total</th>
							<td class = "tract_saving_total" ></td>
						</tr>

					</table>
				</div>

				<div class="col-xs-12 col-md-6 text-center">


					<table class="table table-striped">
						<tr>
							<th><p style="font-size: larger;text-decoration:underline;">Cajas</p></th>
							<td> </td>
						</tr>
						<tr>
							<th>Caja Fuerte</th>
							<td id="big_amount_tract"></td>
						</tr>

						<tr>
							<th>Caja Chica</th>
							<td id="little_amount_tract"></td>
						</tr>

						<tr>
							<th>Total</th>
							<td class="boxes_total_tract"></td>
						</tr>

					</table>
				</div>

			</div>

			<br>

			<div class="row">
				<div class="col-xs-12 text-center">


					<table class="table tnble-striped">
						<tr>
							<th><p style="font-size: larger;text-decoration:underline;">Estado general del Tracto</p></th>
							<td> </td>
						</tr>
						<tr>
							<th>Saldo inicial de cajas</th>
							<td id="tract_initial_amount"></td>
						</tr>

						<tr>
							<th>Ahorro del período anterior</th>
							<td class="saving_amount"></td>
						</tr>

						<tr>
							<th>Ingresos del período</th>
							<td class = "tract_saving_total" ></td>
						</tr>

						<tr>
							<th><u>Total de ingresos</u></th>
							<td id = "total_income"></td>
						</tr>

						<tr>
							<th>Total de gastos</th>
							<td id="total_spent"></td>
						</tr>

						<tr>
							<th><u>Saldo final</u></th>
							<td id="tract_final_balance"></td>
						</tr>

						<tr>
							<th>Total de cajas</th>
							<td class="boxes_total_tract"></td>
						</tr>

						<tr>
							<th><u>Cuenta</u></th>
							<td id = "tract_count"></td>
						</tr>
					</table>
				</div>
			</div>




			<br>
			<div class="row text-left">
				<div class="col-xs-12">
					<button onclick="generatePDF('Montos de Tracto', '#tract', document.getElementById('tract_date'));" class="btn btn-success">Informe</button>
				</div>

			</div>
			<br>
			<br>

		</div>





		<!--************************************************ Superavit ********************** -->




		<div id="surplus" class="tab-pane fade">

			<div class="row text-center">

				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<?php
					echo "<label><h4><strong>Elegí el año</strong></h4></label>";
					echo "<select class='form-control' id= 'surplus_year_id' name = 'year' onchange='getAmounts(2,2,2,this);'>";


					foreach ($years as $key => $value) {
						echo "<option>".$value['year']."</option>"."<br>";
					}

					echo "</select>";
					?>
				</div>



			</div>






			<br>
			<br>

			<h2><strong>Facturas</strong></h2>



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

					<tbody id="surplus_invoices">


					</tbody>
				</table>
			</div>

			<div class="row">
				<div class="col-xs-12" id="surplus_total_invoices">

				</div>
			</div>

			<br>
			<hr>

			<br>
			<br>



			<div class="row">

				<div class="col-xs-12 text-center">

					<table class="table table-striped">
						<tr>
							<th><p style="font-size: larger;text-decoration:underline;">Cuadro de ingresos</p></th>
							<td> </td>
						</tr>
						<tr>
							<th>Monto de Superávit</th>
							<td class="surplus_amount"></td>
						</tr>


						<tr>
							<th>Total</th>
							<td class = "surplus_amount" ></td>
						</tr>

					</table>
				</div>


			</div>

			<br>

			<div class="row">
				<div class="col-xs-12 text-center">

					<table class="table table-striped">
						<tr>
							<th><p style="font-size: larger;text-decoration:underline;">Estado General</p></th>
							<td> </td>
						</tr>
						<tr>
							<th>Monto Asignado</th>
							<td class = "surplus_amount" ></td>
						</tr>


						<tr>
							<th>Total de gastos</th>
							<td id="surplus_total_spent"></td>
						</tr>

						<tr>
							<th><u>Saldo final</u></th>
							<td id="surplus_final_balance"></td>
						</tr>

					</table>
				</div>
			</div>

			<br>
			<div class="row text-left">
				<div class="col-xs-12">
					<button onclick="generatePDF('Montos de Superávit', '#surplus', document.getElementById('tract_date'));" class="btn btn-success">Informe</button>
				</div>

			</div>
			<br>
			<br>

		</div>


		<!--************************************************ INGRESOS GENERADOS ********************** -->
		<div id="generated" class="tab-pane fade">


			<div class="row text-center">

				<div class="col-xs-12 col-md-6">
					<?php
					echo "<label><h5><strong>Elegí el año</strong></h5></label>";
					echo "<select class='form-control' id= 'tracts_generated_id' name = 'year' onchange='reloadPage(this)'>";


					foreach ($years as $key => $value) {
						echo "<option>".$value['year']."</option>"."<br>";
					}

					echo "</select>";
					?>
				</div>

				<div class="col-xs-12 col-md-6" style='margin-top: 15px;'>
					<?= $this->Form->input('tract_id', ['options' => $dates, 'class'=> 'form-control','label'=>'Elegí la fecha', 'id'=>'generated_id', 'onchange'=>'getAmounts(1,1,1,this);']);?>

				</div>

			</div>






			<br>
			<br>

			<h2><strong>Facturas</strong></h2>


			<div class="table-responsive">
				<table class="table table-hover">
					<thead>

					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th># Factura</th>
						<th>Detalle</th>
						<th>Proveedor</th>
						<th>Monto</th>
						<th>Encargado</th>
						<th>Aclaraciones</th>
					</tr>
					</thead>

					<tbody id="generated_invoices">

					</tbody>
				</table>
			</div>

			<div class="row">
				<div class="col-xs-12" id="generated_invoices_total">

				</div>
			</div>

			<br>
			<hr>

			<br>
			<br>



			<div class="row">
<h4><strong style="text-decoration: underline;;">Cuadro de ingresos</strong></h4>
				<div class="col-xs-12 col-md-6 text-center">

					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
							<tr>
								<th>#</th>
								<th>Fecha</th>
								<th>Detalle</th>
								<th>Monto</th>
							</tr>
							</thead>

							<tbody id="generated_incomes">

							</tbody>
						</table>

					</div>

					<div class="generated_amount">

					</div>

				</div>


				<div class="col-xs-12 col-md-6 text-center">

					<table class="table table-striped">
						<tr>
							<th><p style="font-size: larger;text-decoration:underline;">Cajas</p></th>
							<td> </td>
						</tr>
						<tr>
							<th>Caja Fuerte</th>
							<td id="generated_big_amount"></td>
						</tr>

						<tr>
							<th>Caja Chica</th>
							<td id="generated_little_amount"></td>
						</tr>

						<tr>
							<th>Total</th>
							<td class="generated_total_boxes"></td>
						</tr>

					</table>
				</div>

			</div>

			<br>

			<div class="row">
				<div class="col-xs-12 text-center">


					<table class="table table-striped">
						<tr>
							<th><p style="font-size: larger;text-decoration:underline;">Estado general del Ingresos Generados</p></th>
							<td> </td>
						</tr>
						<tr>
							<th>Saldo inicial de cajas</th>
							<td id="generated_initial_amount"></td>
						</tr>


						<tr>
							<th>Ingresos del período</th>
							<td class="generated_amount"></td>
						</tr>

						<tr>
							<th><u>Total de ingresos</u></th>
							<td id = "generated_total_income"></td>
						</tr>

						<tr>
							<th>Total de gastos</th>
							<td id="generated_total_spent"></td>
						</tr>

						<tr>
							<th><u>Saldo final</u></th>
							<td id="generated_final_balance"></td>
						</tr>

						<tr>
							<th>Total de cajas</th>
							<td class="generated_total_boxes"></td>
						</tr>

						<tr>
							<th><u>Cuenta de ahorro</u></th>
							<td id="generated_saving_account"></td>
						</tr>
					</table>
				</div>
			</div>




			<br>
			<div class="row text-left">
				<div class="col-xs-12">
					<button onclick="generatePDF('Montos de Ingresos Generados', '#generated', document.getElementById('tract_date'));" class="btn btn-success">Informe</button>
				</div>

			</div>
			<br>
			<br>







		</div>
	</div>






<script>
$(document).ready( function ()
    {
        getAmounts(0,0,0, document.getElementById("tracts_id"));
    });

    function getAmounts(amount_type, box_type, invoice_type, object)
    {
        var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function()
        {
    
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
				var obj = JSON.parse(xhttp.responseText);

            	switch(amount_type)
            	{
            		case 0:
            			setTractValues(obj);
            		break;

            		case 1:
            			setGeneratedValues(obj);
            		break;

            		case 2:
            			setSurplusValues(obj);
            		break;            		            		
            	}
            	
            }
            else
            {
                if( xhttp.status == 404)
                {

                } 
    
                
            }          
               
        };


		var newPath = "<?= $this->Url->build(["controller" => "Associations", "action" => "getAmounts"]); ?>"; //Con esto obtenemos la URL a la que necesitamos hacer el get
		var association_id = <?=  $association_name[0]['id']; ?>; //Se obtiene el id de la asociación


		newPath += "/"+association_id+"/"+amount_type+"/"+box_type+"/"+invoice_type+"/"+object.value;

        xhttp.open("GET",newPath,true);
        xhttp.send();
       
    }
    
    function setTractValues(object)
    {

	var select =  document.getElementById("tracts_id");
	var date = "Periodo del tracto: <br><br>"+select.options[select.selectedIndex].text +"<br><br>";



//*******************************BOXES****************************//

    	var total_boxes = 0;
    	var little_amount_tract = 0;
    	var big_amount_tract = 0;

    	var boxes_classes = document.getElementsByClassName("boxes_total_tract");


    	if(object.boxes.length > 0)
    	{
	    	little_amount_tract = object.boxes[0].little_amount;
	    	big_amount_tract = object.boxes[0].big_amount;
	    	total_boxes = (object.boxes[0].little_amount + object.boxes[0].big_amount);   		
    	}

    	boxes_classes[0].innerHTML = total_boxes; 
    	boxes_classes[1].innerHTML = total_boxes;  
    	document.getElementById("little_amount_tract").innerHTML = little_amount_tract;
    	document.getElementById("big_amount_tract").innerHTML = big_amount_tract;


//*******************************END BOXES****************************//

//*******************************INVOICES****************************//
    	var invoices_length = object.invoices.length;
    	var html = "";
    	var invoices_total = 0;
    	var total_message = "";

    	if(invoices_length > 0)
    	{
    		

    		for(i = 0; i < invoices_length; ++i)
    		{
    			html+="<tr>";

    			html+="<td>"+(i+1)+"</td>";
    			html+="<td>"+(object.invoices[i].date.split("T"))[0]+"</td>";
    			html+="<td>"+object.invoices[i].number+"</td>";
				html+="<td>"+object.invoices[i].detail+"</td>";
				html+="<td>"+object.invoices[i].provider+"</td>";
				html+="<td>"+object.invoices[i].amount+"</td>";
				html+="<td>"+object.invoices[i].attendant+"</td>";
				html+="<td>"+object.invoices[i].clarifications+"</td>";

    			html+="</tr>";

    			invoices_total += object.invoices[i].amount;
    		}


    		total_message = "<h4>Total: "+invoices_total+"</h4>";
    		
    	}

    	document.getElementById("tract_invoices_total").innerHTML = total_message;
		document.getElementById("tract_invoices").innerHTML = html;




//*********************** END INVOICES *************************//

		var tract_amount = 0;
		var tract_saving_total = 0;
		var total_income = 0;
		var final_balance = 0;
		var tract_final_balance = 0;
		var tract_count = 0;
		var saving_classes = 0;
		var tract_initial_amount = ((object.initial_amount.length > 0)? object.initial_amount[0].amount : 0);
		var saving_amount = ((object.savings.length > 0) ? object.savings[0].amount : 0);


		if(object.amount.length > 0)
		{
			 tract_amount = object.amount[0].amount;
			 tract_saving_total = tract_amount + saving_amount;
			 total_income = (tract_initial_amount + tract_saving_total);
			
			 tract_final_balance = (total_income - invoices_total);
			 tract_count = (tract_final_balance - total_boxes);

		}


		amount_classes = document.getElementsByClassName("tract_saving_total");
    	document.getElementById("tract_amount").innerHTML = tract_amount;
		saving_classes = document.getElementsByClassName("saving_amount");
		saving_classes[0].innerHTML = saving_amount;
		saving_classes[1].innerHTML = saving_amount;
    	
    	amount_classes[0].innerHTML =  tract_saving_total;
    	amount_classes[1].innerHTML =  tract_saving_total ;
    	
    	document.getElementById("tract_date").innerHTML = date;
    	document.getElementById("total_income").innerHTML = total_income; //Total de ingresos monto inicial + monto de ahorro
    	document.getElementById("total_spent").innerHTML = invoices_total; //Total de gastos
    	document.getElementById("tract_initial_amount").innerHTML = tract_initial_amount;
		document.getElementById("tract_final_balance").style = ((tract_final_balance < 0)? "color: red" : "color:green");
    	document.getElementById("tract_final_balance").innerHTML =  tract_final_balance; // saldo final = total de ingresos - total de gastos
    	document.getElementById("tract_count").innerHTML = tract_count;
		document.getElementById("tract_count").style = ((tract_count < 0) ? "color: red": "color: green");



    }






  function setGeneratedValues(object)
  {

    var select =  document.getElementById("generated_id");
    var date = "Periodo del tracto: <br><br>"+select.options[select.selectedIndex].text +"<br><br>";

    var total_boxes = 0;
    var little_amount_generated = 0;
    var big_amount_generated = 0;

  //*******************************BOXES****************************//
    var boxes_classes = document.getElementsByClassName("generated_total_boxes");


    if(object.boxes.length > 0)
    {
        little_amount_generated = object.boxes[0].little_amount;
        big_amount_generated = object.boxes[0].big_amount;
        total_boxes = (object.boxes[0].little_amount + object.boxes[0].big_amount);         
    }

    boxes_classes[0].innerHTML = total_boxes; 
    boxes_classes[1].innerHTML = total_boxes;  
    document.getElementById("generated_little_amount").innerHTML = little_amount_generated;
    document.getElementById("generated_big_amount").innerHTML = big_amount_generated;


//*******************************END BOXES****************************//


//*******************************INVOICES****************************//

    var invoices_length = object.invoices.length;
    var html = "";
    var invoices_total = 0;
    var total_message = "<h4>Total: 0 </h4>";

    if(invoices_length > 0)
    {
        

        for(i = 0; i < invoices_length; ++i)
        {
            html+="<tr>";

            html+="<td>"+(i+1)+"</td>";
            html+="<td>"+(object.invoices[i].date.split("T"))[0]+"</td>";
            html+="<td>"+object.invoices[i].number+"</td>";
            html+="<td>"+object.invoices[i].detail+"</td>";
            html+="<td>"+object.invoices[i].provider+"</td>";
            html+="<td>"+object.invoices[i].amount+"</td>";
            html+="<td>"+object.invoices[i].attendant+"</td>";
            html+="<td>"+object.invoices[i].clarifications+"</td>";

            html+="</tr>";

            invoices_total += object.invoices[i].amount;
        }


        total_message = "<h4>Total: "+invoices_total+"</h4>";
        
    }

    document.getElementById("generated_invoices_total").innerHTML = total_message;
    document.getElementById("generated_invoices").innerHTML = html;

//**************************** END INVOICES **********************//

//*******************************INCOMES****************************//

    amount_classes = document.getElementsByClassName("generated_amount");
    
    html = "";
    var incomes_total = 0;
    total_message = "";
    var incomes_length = object.amount.length;

    if(incomes_length > 0)
    {
        for(i = 0; i < incomes_length; ++i)
        {
            html+="<tr>";

            html+="<td>"+(i+1)+"</td>";
            html+="<td>"+(object.amount[i].date.split("T"))[0]+"</td>";
            html+="<td>"+object.amount[i].detail+"</td>";
            html+="<td>"+object.amount[i].amount+"</td>";

            html+="</tr>";

            incomes_total += object.amount[i].amount;
        }


        total_message = "<h4>Total: "+incomes_total+"</h4>";
    }

    amount_classes[0].innerHTML = total_message;
    document.getElementById("generated_incomes").innerHTML = html;

//****************************** END INCOMES **************************//

//*******************************AMOUNTS****************************//

    var generated_initial_amount = ((object.initial_amount.length > 0)? object.initial_amount[0].amount : 0);
    var generated_final_balance = ((incomes_total + generated_initial_amount) - invoices_total);
    var generated_saving_account = ((object.saving_account.length > 0)? object.saving_account[0].amount : 0);


    amount_classes[1].innerHTML =  incomes_total;

    document.getElementById("tract_date").innerHTML = date;
    document.getElementById("generated_total_income").innerHTML = incomes_total;
    document.getElementById("generated_total_spent").innerHTML = invoices_total;
    document.getElementById("generated_initial_amount").innerHTML = generated_initial_amount;
    document.getElementById("generated_final_balance").innerHTML =  generated_final_balance;
    document.getElementById("generated_final_balance").style = ((generated_final_balance < 0) ? "color:red" : "color:green");
    document.getElementById("generated_saving_account").innerHTML = generated_saving_account;




    /************************** END AMOUNTS ********************************************************/


}



function setSurplusValues(object)
{

	var invoices_length = object.invoices.length;
	var html = "";
	var invoices_total = 0;
	var total_message = "";

	if(invoices_length > 0)
	{
		

		for(i = 0; i < invoices_length; ++i)
		{
			html+="<tr>";

			html+="<td>"+(i+1)+"</td>";
			html+="<td>"+(object.invoices[i].date.split("T"))[0]+"</td>";
			html+="<td>"+object.invoices[i].number+"</td>";
			html+="<td>"+object.invoices[i].detail+"</td>";
			html+="<td>"+object.invoices[i].provider+"</td>";
			html+="<td>"+object.invoices[i].amount+"</td>";
			html+="<td>"+object.invoices[i].attendant+"</td>";
			html+="<td>"+object.invoices[i].clarifications+"</td>";

			html+="</tr>";

			invoices_total += object.invoices[i].amount;
		}


		total_message = "<h4>Total: "+invoices_total+"</h4>";
		
	}

	document.getElementById("surplus_total_invoices").innerHTML = total_message;
	document.getElementById("surplus_invoices").innerHTML = html;

//******************* END INVOICES **********************///


	var surplus_amount = 0;
	var surplus_final_balance = 0;
	var date = "No hay montos de superavit para el año "+document.getElementById("surplus_year_id").value+"<br><br>";
	var length = object.amount.length;
	
	if(length > 0)
	{
		
		for(var i = 0; i < length; ++i)
		{
			surplus_amount += object.amount[i].amount;	
		}
		 
		 

		 surplus_final_balance = (surplus_amount - invoices_total);

		date = "Superávit del año: "+document.getElementById("surplus_year_id").value +"<br><br>";			
	}

	amount_classes = document.getElementsByClassName("surplus_amount");

	
	amount_classes[0].innerHTML =  surplus_amount; 
	amount_classes[1].innerHTML =  surplus_amount ; 
	amount_classes[2].innerHTML =  surplus_amount ; 
	
	document.getElementById("tract_date").innerHTML = date;
	document.getElementById("surplus_total_spent").innerHTML = invoices_total;
	document.getElementById("surplus_final_balance").innerHTML =  surplus_final_balance; 





	/************************** END AMOUNTS ********************************************************/


}



function reloadPage(element)
{

	var path = "<?= $this->Url->build(["controller" => "Associations", "action" => "detailedInformation"]); ?>"; //Con esto obtenemos la URL a la que necesitamos hacer el get
	var association_id = <?=  $association_name[0]['id']; ?>; //Se obtiene el id de la asociación


	path += "/"+association_id+"/"+element.value;

	window.location = path;
}




function generatePDF(title, id, date) {



	var pdf = new jsPDF('l', 'pt', 'tabloid');
	pdf.setFontType("bold");

	pdf.setFontSize(16);

	date = date.innerHTML;
	date = date.split(":");
	date = date[1].replace(/<br>/g, "");

	var association = "Asociación: "+document.getElementById("association_name").innerHTML;
	var report_type = "Tipo de informe: "+title;
	var period = "Período: "+date;


	pdf.text(340, 70, association);

	pdf.text(340,100,report_type);

	pdf.text(340,130,period);

	var uri = "data:image/jpeg;base64,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vXv9f8XaldTOMEtO3T865ae8u7lt1xcyyH/aYmpDHbIOTk/So8qeI05rT2L6iuQ0qqzHAFWY4IG+Z32+2M0rFFUxxjg96ao9xORCttIfvcCniCHHMuT6YpdwC/epUiMnArVUYi5mMaOHOA+KjKJ2cn8KmMPluQxpN6KTxUypodyMW8pGdtOW3BPzyBaezuB17VECCfmJojTgF2P8mPODJ+OKDDEOkn6UqhmIUCnSQlRyetW6cVshczIXiH8Dg0wgqcGpvLUfx4PpSpHF/Gf0rB0+w7iWuoX1k4e0u5oWHQo5Fdn4O+N3xQ8C6iup+HPGOpW0ykHidiDXHMtuDhRTcR0lSbHc+zPhX/wVI+PPgm5x4kvxrtqSMpcckD2r7L+FP/BWX4TeK3tNP8Z6ZNo91MQskoOY1NfjUpttpDJk9jzUez+KM4xSlTcQuf0peBvjl8K/iMoPhLxlp165APliYBvyNd2GVgGUgg9CK/mR8LfEPxp4JvFvvDniC8spVxzHKRX2L8F/+Cqnxe8CR2ml+L4k1uwhARjJy5H1rPYZ+1NFfLHwQ/4KI/An4s2MCajrkWhanIQhguWwC3sa+ntO1TTtYtI7/S72G6t5RlJInDKR9RQBZooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooJCgsxAA5JNfPf7Sf7aPwt/Z70WV7zVbfUtYIIis4JAxDf7WKAPd9Y1vSfD9jJqWtahBZ20KlnkmcKAB9a+Mf2g/8Agp58K/hgJ9J8Fbde1NMruQ/u1Nfmz+0V+3F8XPjrrVw761cabpD5WOzgkKrt98V85s9xdyl5HaR2OSWOSTTSb0QH0B8d/wBtz40/HK8mj1XxFcWemMxMdrA5VVX04r5/ke4upWlld5HY5LMckmplt4oVzcN83ZcUksu5Qqpg1sqL3YrkDwyR43jGakgtXf52HyjqaekZA3SHpQZieRwAMVoqUY6sXNfYe7QxHEHNIwSUDdKc+mKhLs5wK6rwL8MfiD8SNRTSfAHgvWvEV45C+Vp1lJPtP+0VGF+pIrZOPyFqc+NPOzzQuVFQsSvCLg+tfc3wt/4JPftKeMEhuPHdzovgmxkAZlurj7VdgHt5UWVB+rivqb4c/wDBID4DeG2W68f+J9f8WTjBMW8Wdvn/AHU+Yj6tU1KtOKsmVGnNn43jczBQpLHoB1NdJ4d+GfxG8XzpbeGfA2u6k78KLawlcH8QMV+//gL9kH9mz4aqP+EU+D/h6GUAAzz2onlOPVnya9W0/SNJ0mIQ6XplrZxgYCwQLGP0FcvtrbI0VHufgD4e/YP/AGr/ABKqtY/BnXIw/Q3KLCP/AB416j4c/wCCVn7WmohXvNA0TTEbGTdapHuH1C5NftxnPUmkwPej6xJbFexXU/HKH/gjx+0PdNvu/F/hG3yen2iRiPyWtCL/AIIzfGps+b8SvCien+uP/stfr9+dH4ms3VlLcpUoo/IGX/gjR8a0B8n4keFJOM8+aP8A2Wsm9/4I8/tFW2Ws/E3hG7x0Au3Qn81r9lPxNH5/lQqskJ0os/DnXf8Aglz+15ojGW38HaZqcadPseqROzf8BJBrzTxX+xZ+1N4bJfUvgv4hKIMloLfzR/46TX9CGM+tLk+prT6xK1hexR/MlrXgrxl4cmeDxB4V1fTpEJDC6spIsf8AfQFYoHOCK/p11Xw34d12Mxa3oOn36MMFbm1STI/4EDXjfj39h/8AZb+I7vP4h+EOixXLjm4sYzayfnHip9rfcl0mtj+fAoeoHFPTzO4yK/XT4k/8EcPhVrUkt38NPiJrfhyRgdltexreW4P1+VwPxNfJnxS/4JaftU/DxZ73w/oWn+NdOhyRJolyDcFR38iTa5Psu6umnUg+pnKEkfIhtneMlV+vNQeXtP3wK3fFnhnxP4Lvho3irw9qWjX6A77a/tXt5Fx/suAa54knrWlRxZKuSbC/3mpv2d+x/WkD4GKC7etc6UWPUltze2soltpXjdeQyNgivov4C/t1fGv4HXcMFtrk+o6YhAe1uHLDb6c184ox6huaUSsp+YA0nTXQLn7jfs9/8FJvhH8WorfS/E1wmg6s4ClZWxGzfU19e6fqNhqtpHfabdxXNvKAySROGUj6iv5g7e6nt5Vnt53hkU5VkOCK+rv2av8AgoV8U/gdd2+l6vfy61oQZVeCdixVfaodNrYadz91qK8Y+BP7WHwl+O+jW134e8RWsGoyIDLZTSBXVvQZ617OCCMg8VmMKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAK5/xr488KfD3RZtf8W6xb2FnApZmkcAn6DvXmX7Rf7V3w0/Z78O3d5rutW02rpGTBYI4Ls3bIHSvxg/aY/bL+JX7RWsSNqd/LZ6UrEQ2kTELtzxmgD6n/bL/AOCm+oa6Z/BHwVvHtbQEpNfocNIPavzn8Q+KNf8AFd/JqfiDVbi+uJSWZ5nLH9ap/ZX2+bKxweeaZgMcKnFaxpN7iuMjiaRgoHWrWFi/doNrr1b1pwk8tPlA3VXZnlbH8Xet4RjTFe5JvRziQ7j61ZhtQUL9SKqpFhgMEseAAOtfXP7M3/BOf46fHcW3iHWrJvBfhKbDf2hqcRWe4T1ggOGbP95sL9a154rWTFyuT0PkUR3FxOIIEeSRm2qiAlmPoAOtfTnwG/4J1/tGfG8W+qDw9/wi+hTAN/aOsAxbl9Uj++35V+rfwF/YM/Z5+AaQX+jeFI9b1+Nfn1jVlE8xbuUU/LH/AMBFfRKqqKEQbVUYAA4ArjnW5tEbRpdz4l+Cf/BKH9n74di21P4hSXfjvVYwGdLsmGxD+0SHLD/eb8K+xfC/hLwv4J0qPQvB/h3TtE06IYS2sLZIIx/wFQMn3Na350fiawbb3NlFLYMUUfiaPxNIYUUfiaPxNAwoo/E0fiaACij8TR+JoAKKTI9aNyjndQAtFM81P7w/Ol82P++KAHUU3zE/vD86Xcp6NQAtGKPxo/E0Acv4/wDhd8Ovipph0f4jeCtH8RWmCFTULVZSmf7jH5lPuCK+JPjZ/wAEg/hN4qW51X4OeJLzwlqDkulhdE3NkT/dBPzoPxav0D/E0fnVKTRMoqW5/Pn8df2Jv2g/gDNNceLvBM97pEbYXVtNBuLZl9SVGV/EV4PtQHDcV/T/AHNtbXtu9peW8c8Eo2vHKgZWHoQeDXyV+0L/AME0PgB8a0utX8P2B8E+JJiXF9pcY8iR/wDprBwpB9Rg1pGpbcxlStsfht5akjB61YeFY1w5wSK+gP2g/wBhT48/s6Xj3HiTQDrHh3efJ17SlM1qVzx5o+9C3swx6E18/wB8s8cuwjpXYmuW6MWnexXKR8/vAPwpqqxyEGaQAk88UoYryr9PaoVnuO9jZ8M+LfFHgzUI9U8O6tc2NxGwZWikK9K/T/8AZA/4Ke6dcWen+A/jIWSdNsEWoE5z2G6vypErEgnk+9WLa7kt5hKowRyDnFRKmmFz+nPQdf0fxNpkOsaFqEN5aXChkliYMCDWhX4i/sgft6+Nfgtdx+HNanbUdCkcAxSsWMS+2a/X34PfGnwT8afDEHiPwlqcUodR5kG4b4z7isZQcRp3O9oooqBhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFI7pEjSSOFVRlmJwAKAFZgoLMQAOST2r5I/bG/bt8H/ADSJtC8P3UOo+I542VEicMITjqcd68g/b+/4KC2vge3uvhb8KdRWXVZAY7u8ib/VeoBFfkx4i8Ta74s1KXVtf1Oe9upiWaSVyx5oA2/ib8T/Fvxa8VXnijxTqU11c3chcK7EhQT0Fc7BF5ClmTJNNhjaFPNZeo4phZjwWrrhSUNWQ5D8NNnB/Ckk/cfKOp61YtHEZBYUXdu7OpiUuZCAABkknsK6OT3bohO7KTZPfk16v8A/2Zfi7+0R4iTRvh14cmnhVgt1qMwKWlsp6l3PH4DmvqX9jT/gl94p+KSWPxI+O0d14d8KybZrTSMbL/UU6guDzDGff5j2A61+tHgbwB4O+Gvh218KeBfD1no2lWaBIre1jCjjuT1Y+55rgnUSeh0Rpt7nzF+y//wAE3fg38B0tfEni60h8aeMIwH+2XsQNraP1/cQnjIP8TZPpivrsDAAwcDgY7U6jA9Kxbb3N1FR0Qn50fnS4HpRgelIoT86PzpcD0owPSgBPzo/OlwPSjj2oFcT86PzqvdX9pZrunlVcduprmdV8d2tsGW3AyOMmtadGdV2ijixWYYfCK9SR1pdVGWbA9zVK51rTrXPmXKnHYGvLdV8fXMxYCY/TNcve+KLmYk+YTXp0conPWR8vi+MKNLSkj2G78c6bBkJyfUmsW7+JSpkR7BXkNxq9zISN5qnLdzP1c16VPJ6a+I+bxPGOKn8LsepXPxNuOcTYFZ8vxKuj/wAvJ/OvM5JpGz85qBnb+8a7IZXQXQ8arxNjZP4n956U3xJuwf8Aj5P50L8TLoHm4P515dK74Pzd+OartI394/nWv9mUH0OSXE2Nj9p/eexRfFCYEZmzWjbfFBD99x+deDvNIuSJCKjN/OnSQ/nUyyahPoXT4zx1HXmZ9KWnxFtJcbpgPxratfF1pPjbKp+hr5Vj168h58w8e9aFn42vLcgmVvzrjq8PJ/Az2sJ4jVIu1ZJn1bBrdrLj5wDV2O6hkGVfP41826T8TpUIWSXI967bR/iLaT4Hn+WfrxXj18oxFDZXR9jl/GeX42yk+VnsIYHv+tLn61xun+LlZQzMHU/xLzW/aa1a3IBSQc15kouDtJWPq6VanXjzU5XXkXru0tb+1lsb62jubadDHLDMgdJFPVWU8EH0NfDH7Tf/AAS7+H/xDe68YfBRrfwr4gYNK+mMP+JfdN6KOsJPtx7CvulZUcAripOKcJuDuipRUlZn85HxR+FnjP4O+KJ/CPxP8H3mj30ZwFlGEmX+9G44Ye4rjJIdBc4RWi+rE1/RZ8Y/gZ8Mvjx4Xm8KfEnwzbanbOp8mYjE9s+OHjkHKkV+O37YX/BPb4j/ALN8lz4u8NpceKPATOduowx5nsAei3KDoO3mD5fXFdlOvGej3OadNx1R8rNpFnJzBfoc9BtNVzpN8jZSMso70xJSny5x71et55IlEgY4roUEzLmZlv50EmSCjDmvXvgf+0h47+DmvWuq+H9euLdIZFZ4A52SAHkEV5rdXcUyjEYJ7ms9oYnb5Dg1M6dtBqR/QZ+y7+1V4O/aD8I213DfQW2tIgW5tWcBi3qBXvNfzY/Dj4heOvhrrlrrng/WLi2uIJFfEbkB8djzX7UfsYftf6T8dvDNvoXiS4S18UWsYWSJ2AM2B1Fc1XDyguZbFRmnofU1FFFcxYUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFfnv/AMFFP25ZPhnbXPwp+H10P7XuYyl1cRt/qwe1ejftyftx+HfgF4duPC3ha8ivPFV5G0arG2fs+R1PvX4seLfFevePvEF54t8UX0lzeXkhkZ3JPU9BVwg5vQDH1W81PWL+bVtYuJJZ7ly8kjtksTUEUaiTcFO3PWiVpJGCn7vQU9mCoIxXVCko6kNjriTzAFzhaijXd8xPApnJOAc11vw2+GXjX4ueMdP8AfD3RJtU1fUpAkcUY+VB3d26KoHJJqpyTd2K3Qz/AAz4a13xnr1l4W8I6Vc6pquoSiG3tbeMu7sTjgD+dfr1+xR/wTg8PfCC3sviJ8Z7S21vxgQs1tp7qJLbTD1GQeHkHr0HavTf2NP2HPA37LXh9NUvUt9b8d30Q+36u6ZWDI5htwfuoO56tX09k+ormq4iUlyx2N6dJLVigYopPyo/KuY3FopPyo/KgYtFJ+VH5UALRmkJAGTisPWvE9ppyMkbBpMdewq4U5VHaJz4jE08LDnqOxrXV5b2iGSeQKK5DXPHcUIaO1YDHGe9cdr3i64unb94efeuTub+WdiWY/nXt4XK18VQ+FzXiqTvTw+iN7VvFtxcs3708+9c5c6jPOSSxqszFjk0xjwa9ynQhTWiPiMRja2Id5MHdmySahbBrL1rxl4T8PDGueJNNsTjO2a4VW/75zmuE1X9o34Vae7Rw65PfuD0s7SRx/30QFP51cq9Kl8UkiKOBxeJ1pU5S9Ez0knqaikbHSvHZ/2ofCWcWXhrW7j0JSNP5tVOT9peGU4g8C35HbdcoP5A1l/aOFX2zp/1bzWptRf4f5ns7HNRs2BmvH4/2ioH/wBd4I1If7s6H+YFXYvj94el4udA1i3B7+Wj4/I1pHMsI/towqcNZtDV0G/u/wAz0p2yTUDEZrkbH4ueBNQIT+12tXPa5geP9cY/Wt+11rStSXfp+p2tyP8AplKrY/KuylXpVfgkn8zwMXgMZhf49KUfVMsSN+VVXbPSpXY9qrucck12RR4taZHKx6VWmcgbQalds5JNU5GJOc9a3ijzq0+VDWnePlWINT2+u3dqwIkP51Rd8nJPFVpHzyT9K29nGSs0cSxNSi+aErHoGhfEa6s3UNMwx716ToHxCtL0Lum8mT+8p4/EV81vMwbKnFT2niC4sZBtlPyn1rzsZklLFR0Wp9BlHHmLyqa5paH2Xpni94gpncPGejqcj/61ddp+tW94oZJAc+9fI/hX4my25WOWXKngg9DXqugeKo7tVn0q5VZOphZvlb6Hsa+Kx+SVsG20ro/c+HOOsFnMVCckpHuySKwyCKjurW2vraazvLeK4t50McsUqhkkQjBVlPBB9DXF6B4ziumEE5Mcq8MjcEGuxtruOdcqRzXibH3iaauj8zv22P8AgmPBi++Kn7Oum7AN1xqPhmP7vqz23p/uflX5q6lbzafv026tJbe5hYpJFIu10YHBBB5Br+mPOfSviH9uX/gnpo3xwsrv4k/CS0tdL8eW0ZkmtBiO31cAZKnskvo3Q9D6120MTb3ZmFSjfWJ+MqwyFSwGdvWmzgNyqla0tZ0jWfDWr32ga/plzp2pWMzQXVpcIUkikU4KsD3qpHOZBiRMV1OV2c9itDdywMCknI6V6h8JvjFr/wAPfEVlrelXUlvcW8isJVbHQ968wkhhLkq4p8avGAM5HatqV9nsTKKZ++f7JX7V/h747+G4rK91CBNdtkCyrux5uB1HvX0dX853wd+LHiX4Ya9b6zouoS20sLBso2M47Gv2p/ZD/an8P/tAeE4raa7RNfsYwtzETgvgdRXJi8IqXvw2/IdOrd8stz6IooorgNwooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACvnX9tH9pzS/wBnf4a3V5DMj61fRtFaRBvmUkY3V618V/ib4b+EngjUfGnie+jt7aziYpuP33xwor8Af2m/2gvFPx++Id/r+ralLLYCdhaQljtRM8YFNK4HB+NPGWv/ABH8T3vinxHfS3FxdStI7yMTtBPSsaZt6iNei96UxG2t1Gf9cP5VA7sDtHevRpxVOOpLZds0hkAEjAY5qC+tnRvMCnyz0angeUi54Ld63/AfhjXfH3imw8F+HNKm1PU9UnW3tbeIZZnJwPoB1J7CrdmjO7uP+FPwv8ZfGDxvpngHwJo8uoarqcoSNEHyxr/FI5/hVRySa/dL9kD9j7wT+yz4NW3tI4tR8WajGp1bV2T5mbr5Uf8AdjB/Oqf7F/7HPhP9lrwZ5ssMN/401iNX1fUiuTH3+zxH+FF7+p5r6Qrz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s7s6Pqj7LiE7Tk8MOxHsa990jU4r2BWRwcivi2mnZn7nCSmk0fnZ/wAFJv2NEAu/2h/hhpAV0/eeI7C3jxu/6eVUd/7351+WNzKsk7yZ3ZYkCv6cLu0tdRtJrC+t47i2uY2ilikXcrowwVI9CK/ED/god+yDc/s5fEf/AISvwpZO3gXxTM8ti6qdtlcdXtmPb1X1H0rvw+JfL7NnPVpWfMj5JMkcp+dMYpZbb5RLCdwbt6VDjBpVaSNs7jg05SbZmkS2l7NbTqyuUIPY1+nP/BNv9qu40rVY/hf4w1LOm3agWk0r8LJ2UZr8xSI5RleDXQ+DvEereG9StrzT7mSKS2mWWNkJBBBroUVUi4SJ2fMj+mJHWRA6MGVhkEdCKWvmb9iD9pbSvjb8O7TSby8Ua9pMKxTxs3zOBxur6Zry5RcHys1TurhRRRUjCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA5/wAf+MNN8BeDtV8W6rMkcGnWzzEscZIHAr+e79oP4t6l8YfilrXjXU7lpBNcOtuCeFQHjFfd3/BVv9p27tprf4LeFNRZFI337RP94/3TivzCn/1Sjv1NdGHjd3ZMthrEM+6Q4J6Zq2scBhKswDHp71m4LMD14q07hVVgeRXoRatqZMhksbhMyNAwjHVscV7j+yH+zdrX7TPxa0/wdaxyR6JZst3rN2o4htlPK5/vN0FeSaTNd6jd2+l2ts9zPdSLDFCgy0jscKoHqSa/eD9iD9mux/Zz+DljY31iieKNeRL/AFqTaNyOwysOfRAcfXNYV5qlC63ZrSi5y1PcvCvhfRPBfhvTvCfhuwjstL0m3S1tYI12qkajA6d+5961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4f1eSzu1+YjmvOzDDrE0mmfTcO5lLLMVGcXY+lPhD40udH1FtD1CUia3fZyfvDsR9a+sfDmrR31rG4fJIFfAtzqTQmx8VWhw0RWK5weq9jX1J8IPGialYwqZcnA71+a16TpTcX0P6ey7GRxtCNaPU9vuba2vraWzvIUmguI2iljblXRhggj3Br8H/wBvD9niT9nH436hp2nWxXw5r5bU9GcD5RGzfPFn1Vjj6Yr937aUTRhhzkV8zf8ABQ79nWP4/wD7PupnSbQSeJ/CSvrGklVy8gQfvYf+BJn8QKeHqulL1OqpHmVz8Iy3nkux6U6OcScOoyP5VABJEWjdSrAlWUjBBHY0uMDcDXbJ82pyWHXMfRoxn1wK9i/Zh+M2qfCb4o6Hr9tdywQQzqlwEON6Z5BrxqOVlYg9Knh3Q3CTQtgg5yD3pQve3Rg9Ef0zeB/FVh428KaZ4o0190GoW6TL7ZHNblfDH/BL747T+Ofh3L4B1m533mjAeTubkpX3PXFUg6cnFmkXzK4UUUVAwooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigDI8XeIbPwp4a1LxFfzLHBYW7zMzHA4HFfz4ftPfFTVPix8UNa8S314ZUmuXSHngIG4xX6uf8FM/jGngP4Nv4Q0+6Kalrx2BVPPl96/EvUJjLI7M24qetdWHir3ZEnrYLS2ykoU5cDpVaeCRD86kGrFrO8ZMi1Yjv4WkH2mHP4CvR9nBqxnfW5SjKqgUkV98f8Em/gEnjn4qX3xf1ywEuleEE2WZcfK9644x67RzXxDHb2l3IiQQNI0jBERAMsxOAB+Nfvh+xf8FrX4F/s+eGvCrWYt9UvbddT1Qt943Eo3YP+6pArlxcVShZdTWiuaR7lRRketGR615Z2hRRketGR60AFFGR60ZHrQAUEgDJNGR61R1q8FnYSS5wSCBVRi5NRRnVqKlBzfQ4Dx7rRkleJH4HAr4a/a4+I0l3c2vw30uc/ORcaht7j+FD/OvqP4i+KbXQtL1HXr+TbBYwPO59QB0/E18G+APDniD44fFIyBXe41e6MsjMciGLPU+wWvbxMlhcOqS3f5HwuV03mWYTxdX4Yfn/AMA9f/ZW+CI8TXX/AAkutwFdHsCCxIx58nZB/WvrPXNWjhjFtbKscUa7EReAoHQCo7XT9J8EeG7PwtocYjtbGIRjA5du7H1JNchquoNI7HdXm0aXM7s9nHYq+iK2pag0jHmsS4kLMTmpZ5WJ55zVVzk16KSR4U58zK8w5NUJhV+U9TVCY9feto7GEzOufumsK9J5FbtyflNYN8RzWkTkqbHPX7dfauX1R8A10moPjNcnq8gANddNankYuVkcvqcvJrkNUlBcjPSuk1WXAauQv5NzMfevQhoj5uq+Z27mXdyc8nisS8mzk5q/eS4Bz3rEu5Tzipmz1cLS2Ks0hJJqu05U9aJH6mqsj9s1zSke1Tp3Rq2WqvC4O4ivSfBHjuewmjUzEKPevGWnKng4rQ07VWhcZY1yVoqpGzNFQdOSnDc/VL9kn9pOOymg8E+Jb3Om3bBbWV2/495D2/3TX28rKwDKQQRkEdxX4S+AvGstlNGonYAEEEHkV+qn7Ifx1i+JnhEeGtXuw2taPGBljzPB0De5HQ185WpOjK3Q+4ynHfWKfJPdH0PRSClrI9kKKKKACiiigBDVTUbNbuBkYDkVcpCM0Afn1+1f8Mj4Q8XDxRYW+yx1dj5uBwk46/nXgcjd6/TD48/Dq38feBNS0nylM/lGW3YjlZVGRX5nXsM1ncS2lyhSWF2jdT1DA4NfoWQY94rC+zm/ejp8uh/OniDkKyrM3iaStCrr6Pqv1+ZBI+PxqrLJ2zT5XI59aqyPzkmvZbPiYqysNd6iWYxuHB5FI7d6gd6zk76HRTjbU9Q8G6pFqFnJpd0QY7hChB7ehr0j4K+K59H1R9Gu5CHt5PLOT6dDXz74Y1VrO+Rc4BPFehT6idL8Qadr8HEd6BHKR/z0X/EV8TnuF5J+0R+68AZr7ej9Wk9T9D/CerLfWcZDZyBXRsqupVwGVgQQRwQeorxL4P8Ailb+whHmZ+Ud69qgkDxhs9a+bP02OqPwa/4KD/AQ/Ar9ofWbfTbNodA8SMdW0w4+QCQ5kjH+62fzr5rUDaO9ftV/wVR+B8fxK+An/CeabZtLq/gmb7WCi5ZrVuJB9Bwa/FlFRgNo616OHfPE5ai5ZEUig4KgZqWGNscVcgtoVTfKP1qC7uo1+W3GMdTXU1GKuZXufU37E3xXuvhV8S9J1KGdlt7iZYLhM4BBOOa/c7S7+HVNOttRt2BjuYllUj0IzX8zfhPXb3TtVhniuGQo4YHJHINfvR+w38Un+KHwM0u7u7kS3mngW0vzZOAOK5cWlNKoioaPlPoWiiiuE0CiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKGIUFicADJornPiN4lj8H+B9a8SSYxY2ckoz0yFOKAPyC/4KV/GS08f/HU+HdPl8y00G3kgYg8eZivhmQ/63dxyK7j4peMrnxn8S9e8SXIAe9u5X49MmuFmO93+td0I8kCGrslhysG8ED+tNMwcEbMGkJxbRgccmmxgFqpVGS0j6L/YH+ED/Gr9pfwr4evLdpNI0mY6zqfy5Ahg+YKfq+0V++nA+4u0DgADgDsK/Or/AII6fCc6P4C8WfGG/twJ9ful0qxYr8wt4fmkI9i5H5V+i2PrXHiKnPO3Y6qMbK4nPv8AlRz7/lS4oxWBsJz7/lRz7/lS4oxQAnPv+VHPv+VLijFACc1x3j3UvJg8hW6DJrsWIUE/1ryTx7qJmupFDd8Cu7L6ftayPn+IsV9XwbSerPkn9sXxu1n4dsfBdnMRca1N5k4U/wDLBOx9icV6D+yP8NI/A3gFvGmpW2zUtbX9zvXmO3HQj614PrGlXnx1/afTw5DuksbKdbVivIjgi+aVvz4r7W1y4tdOtItOsUEdtaxrDEg4CoowP5VeMn7eu0tlp9xx5dS+oZfCL+KWr+Zg69qhkdvmrk7m4Lsec1a1K78xzzWS0nPNdEIcqPNrVHJils8mombuaUnNQyP2FanOyOZsg+9UJmxVmV81SmbqBWiRnN6FG6J21g37/erZu3xmuf1CT71axWpx1Wc/qL4BOa47WJcZ5rqdTkIB5ritZmOWrtoq54WNnoctq8+1W5rkr2Xrz1re1mfJ25rl76XGTnpXdsjxIrnqGTfTAE81iTybicmrt9LyQDmsqZ8Z5rnnI+jw1OyIZX71Ulk96klkqnK+a5pO56tKAx3qMXG1s56UyR+MZ5qvJJjpWEpHdCnfc6jQ9YeCVcP+tfSX7Pnxn1L4c+MNK8UWE5zZyr50eeJYj99T9RXyNb3bRyAg13XhXXXgkTDnqO9edioKaOrDXoVFKJ/QX4X8R6X4t8Paf4l0a4Way1K3S4hdTnhhnH1HStWvi3/gnR8ZR4i8M3/wv1O8L3GmH7Zp4c8mFvvoPoefxr7SryfU+wpzU4qSCiiigsKKKKACiiigCC6hWaFkIB4r83P2rvAf/CEfFK7nt4dllrK/bIcDA3H74/P+dfpTgV8uft1+B01X4e23i+3hJuNEul3sP+eMnDZ+hwa9jIsT9XxkU9paf5HxfHmWLMcnnJL3qfvL5b/gfBcrk81Wds0+VqrSNX6A2fzvCNxrt6nioHelkYZ61CTk5rKTOynC7JIZmjlWRDyDmvRIJv7Y8LTxK2ZrYC4i9dy8kflXm+QDkV2PgjURHOIJCCrfKQfQ8V4+aU1Xos+24UrywGMi+59G/s8+MfOigjaX0719iaFeC6tUYHORX5x/CLVn0LxPPpbNtENwVUdPlJyP5197fDzVReWER3A/KK+CkuU/oGEuZJ9zqfEvh+w8V+HtT8MarEJLTVbSW0mUjIKupH9a/nP+Mfw6vfhR8VPFPgHUgUfQ9SmtgWGNyBsofxUiv6QQc81+QP8AwWG+FT+Gfi74f+KWn2fl2Xi2wNvdSKuFN3Bxz/tFCD+Fb4epySIrRurnwNLdtnYpyPamAwhdpIO7v6VWjyM05l6cdea7JT5o2OZqxMYXt2EiMcdc1+k3/BJ/41jTPFF18NboSPFqq7oiTwHFfmzHKJF8iQ/rXs37Jnj65+HHxr8N6ul4YIBeIjt2wTzUqPNBxQPTU/oeoqppGoQatpdpqdtIHiuoUlVh0IIzVuuA1CiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAK+W/+CivxEuvAX7PmpLZSFJtTP2cEeh6ivqSvzI/4K7+PbtJNA8DwXDLCVM8qdia0pR5ppCbsfls873N9LM+dzFifrVU5BfIOav2sJe6YbeGyc0sul73bZMpPpur0nTdjPmuypEA8IUnpUkFrJLKkEI3PKwRBjqScCp49MukVeAFPc969Y/Zl+GknxE+PfgbwnJCs0F1q0L3CcnMaNub9BR7JKHMyea8rH7g/sp/De2+FH7PngjwXbwmOS20uKe4yMFppRvcn8W/SvWabFDHbxJBEu1IlCKB0AAwKdivHbuehFWVgooxRikUFFGKMUAFFGKMUAVtSmEFlLKTjCmvnf4oeIU0jR9V1iWUKtpbSy5J7gHH617t4suDBpL84LcV8c/tU629j8NNUhiY+bfyR2qAdyzdK9nLV7OnKr2Ph+JZfWMVSwq6tfizC/Yg8JY03xL8WNSVjc6jO1naO3oTukYfiQK9m8R6iXd/mpnw18PL4B+EHhvw1sWOWGxWacDvJJ8xz+YrB1u83O3zVyYeLk+ZnZmFVJ8q6GfcXG5ic1AZAKrvPk0wzGvSUTxXK5YeUetQPLmomkHrULy+9UlYhsWWTNUppMZp8kg9ao3EucgVSMZSuVruUYrn9Ql4IrUu5uDz0rndRm4bmtYI46sjB1WcDdzXD6vPyea6jWLjaDg9a4bWbjCsc16NGNj5zG1E2czqk4aRjngVzOoTYB5rYv5jzzXM6lMOefat5uyMMDTcndmXdSbmNZ00nXmp7h+uT1rPml64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TS7S2SMRiKFFCjoMAcVliJXshU1q2W6KKK5jYKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAGzRJPC8MgysilSPYivwh/bZ8A2Xgf46eKrS1YNHcStIi46EnNfvBX5Ff8ABV3wJb+GvivpXjCyhKDVodsp3cE963w8nGehE9j88ZMxOpHUjmpZEEsIbvT9VthBcsD1f5hVOKZ4W6muvkd7shO6JoVyNp4r60/4Ji+PY/A/7Vmi6dcy7LfxDbTaa5zxuYZX9RXypDm4YCNOT1PpXb/CvXj8NfiV4Y8cpJul0nU7e5I6fKHG4ce2a6HT56bSJU+WR/RzjHB7UVS0PVrbX9FsNcs3DwahbRXMbDurqGH86u14Wx6W4UUUUDCiiigAooooAKy9atRPbMCO1alRzpvQqRmi9tUTKKknFnzP8S9D8maSRU4PSvGtXso7uCW0mHDdPUHsa+q/iHoQuraXCZKgkcdq+bPEdg1ndupUjmvv8lxEcXQ9nP0Z/O3G2W1cox/1ijpZ3T/IyrYL4v8AD0ui6kAdS09dmT1kj7GvmL4oeCZtNupZFhIXJzxX0c0sthfxaraZEkRw4H8SelHj/wAJWnijR/7XsowyyLlgB9018/iaM8mxTg/gex9dhK1HivL442jpVjpNdpd/R7nwTqlm0LkY4rDnJU16/wCPPBU+m3EmIjtyT06V5Zqlk8Ln5TXeqsaiujPDOUXyVFZoxpJM+tVpX7CpZwV/CqcjY61EpWPYpQuRzPjgVRlk6mppX5qjNJjNcs5Ho0aZDO+c1QnfAOT1qxM/vWfM+49a5ps9WjAgkbP40ygnJzRWR2hRRRQAUoGTgUBSe1Soh6AUmDdhETsK0bGzaVhgdaSysnkb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2WP2TfBH7NPhdbfT449Q8R3kY/tHVXQb3PdE/uoD2ru/g98E/hx8C/CcPhD4deHodPtVAaecjdcXcmOZJZDy7H8h2AFd5WDd9zrhBQWgUUUUiwooooAKKKKACmk8ign8MV8Z/toftjW/guxvPhb8MdTV/EF0hh1DUIWyLGM8FEP/AD0I/L61tQw88TPkgcWYY+jl1F16z0X3t9kcT+3h+1Ut9Lc/Bf4famGgiOzW72B+GYf8sFI6/wC1+VfCLNgU6WV5HaSR2d3JZmY5JJ6knuagZ/U19dQowwtNU4fPzPybGYurmmIeIrfJdl2EZveoGbNK7Zz6VCzZqZSNKVO+gjNnk1GTk9aVuRTQxFYN3PSp0+VDvatPR7E3My8cDkms+CJppAoHJNdBKf7NsVtYv+Pi5GPdV7muXEVVShfqerl+EeKrKK2JIYm1nVkhhBMMR2Jjv6mvrn9n/wABM7wTPD6HpXgvwj8FyajfQsYickdq/Qb4NeCk06yhLRAHA7V4E5Xd2foEIKnFQieq+ENISxsowFxgCuoAPpUFrCIYgg9KsY9RWRqhOfT9a+C/+CvvxQHhr4HaH8M7O8Ed34w1RZbiNXwxtbf5jn2L7RX3rtzwBya/Df8A4KjfF6P4nftN6ho2nzF9N8HWyaRDzlTKPmlYfVjj8K0pfEZ1HaJ8lsIFPzNT42tuqn68VRHPSnqSnB716Cl1OWxoGe0xgr+lbfg60sr3VY42wSzAAe5rms7xx2r039nrwhc+Kvil4f0m3tGnaW9iygHbcK1jLqSz9rf2GfhpD4C+DOn3bRlLjU0ErAjGF7V9GVl+FdKh0Tw5pulQQLCltbRx7FHAIUZrUrypPmdzZBRRRSAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACmTxJPDJA4BWRSpB9CKfRQB+Ff7eXwh1P4X/AB01drm3I07WWeeBwvynPNfKILWtydw4BxX7U/8ABTr4RDxd8MrbxtYWQkvNGf8AeMB83l/5zX40+IbCO1vHWAfun5Br0qVR1KduqMXG0jPul3ATg8NTLaQg7TUcEixEox+VuKnWCMsHXG00JyuDR6H+z/8AFK/+C/xr8JfEmwlMf9j6lG1wOz27HbKp9ipNf0U6Rq1hr2lWet6VOk9lqFvHdW8iHKvG6hlIP0NfzLyW80qAQrlc1+2X/BMX41N8S/2fLbwbq90r6z4Jf+z3BbLvanmJvw5FZYui7c5tQnryn2DRRx7Uce1eedYUUce1HHtQAUUce1HHtQAUUce1HHtQAhAIrD8QaYLuBiv3hyDW7x7VHLGHXHWgTSasz50+IvhRb63kuI4sOvDgDoa+eNe02WwumDLgZxX2z4s0XG65jj3KQQ6+or5/+JPgkFWu7WPcjcgivuOHc2tajUep+B+JXBraeLw0dDxBJXjkEkbFWU5BB6GvafhJ8XpdPuItN1Ofa2QFYnhv/r14zd20lpM0Mi8g1WLlcFTg5yCOtfUZnldDNaVp6Po+x+UcLcWY/hLFc9F3g/ig9n/k+zPu7WvCPw2+M2jrZeL9Ftrx2XCXCgLNH/uuOa+W/i9/wTl1d1m1L4X61BqcTEsLK9IilA9Ff7p/HFT/AAz+Nl/4ZuIrDWpXktgQFm7qP9r1HvX1x4J+Iuna5aRTQXUcqOAQytkV+ZY/LMRltTlqrTo+jP6jyHiLK+KsOq2Fl73WL0lF+a/XY/G/4mfs+fEX4e3Utv4t8Farpuw/62S2YwsPUSAFT+dePan4XYZxHX9FjfYNVtWguYIbiKQYaORA6sPQg8GvL/F37J37OvjhpJtf+EuhGaXJaa0iNo+T3zCV5+tcSqSR7P1KK+E/n8vfD0ik4TpWS+hybvu1+3Gvf8Evv2bdWd5NPk8T6WWOQsOoiRR9BIhP61yk3/BJL4JSPuj8e+LEHp+4P/slV7WRSw1j8c10SQn7n6VYi0F26rX7Jad/wSc/Z9tZFbUPE3i68UdV+0wxg/lHmvTPCP8AwT3/AGT/AAkFdfhjHq8yHIl1a8muT+Klgn/jtT7RlLD+Z+IPhzwBrviS9TTvDuhX+qXbnCw2ds8zk/RATX1j8HP+CZPx78fyW954p0238G6VIAzS6ic3GPaFeQf94iv1+8LeBfBfgiyXTfBvhPSNDtVGBFp9lHAp+uwDP41uVLk2aRpRR8zfAb9gH4GfBQ2+qz6WfE+vRAE3+poHVG9Y4/ur+pr6YSNI1CRoFVRhVAwAPQU6ikapWCiiigAooooAKKSjNAC01pFQFmICgZJPAArE8Y+NvC3gHQ5/EXi7W7bTbC3Us0s7hc+wHUn2FfnJ+07+3R4i+JiXfgr4ZyXGi+GXzFPdqxS6vl6EZHKIfQcnvXXhcFVxcrQ27nk5rnWGymHNVd5dIrd/5Hq/7XH7cNroK3vw2+D+oR3OofNBqGrxNujtz0KRH+JvVhwK/PO7uri7uJbu7neWeZi8kjtlmYnkk9zTGbHFQs9fUUMPTwkOSG/Vn5fjcfiM3re2rvTouiEdsVA756GldueKiduwNEpFUqfQR27dqiYk8UE84zSfWsJM9OlT5UBIFIiknFJgsc1q6TprXEm9sBRySewrKclBXZ2UqbnJRjuWtKtI7aFr+5wEjGfqfStLw7pV14g1UTOhO9hgY6DsKpMH1e6Szs1P2eI4GP4j619DfBL4Yy3lxDK9vnJB6V4OJrOrK/Q+6yzBLCUrvdnrHwF+GpQQTSW+MY6ivsjwxo8dhaRoEAwPSuP+G/g6LSrKICILgDtXp8MYjQAVx7nqJdR4GKWjI74pPl9qCjhvjl8S9N+EHwl8UfETU7hIk0jT5ZItx+9MVIjUe5Yiv5xfE+u3/ijxDqXiTVZ2mvNTupLqZ25LO7Fj/Ov1K/4LCfHX+zvD+gfAjRb5RNqT/wBp6siN8yxLxGjfU8/hX5UBWPTpXRShpc5qstbESnBpWwRmpCjLzimsSxANa2ZjfUnsUM0gQDqa++/+CXHwzn1z4sf8JbJYCa308FdzLlUx3+tfC/haxe9uvKjXLOQoHqSa/cT/AIJ4fA9fhT8HYdWvItt9ruJ2yOQnalOTjC3cS1mfVtFFFcxqFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAcz8SvCFl468D6x4Xv4RLHfWsiAH+9tOP1r+er4t+D77wX4617wXqNo8M1jdSCIOCDsya/o7r8qf+Cq3wK/snxNZfFbQdJcxXi7L140+UN6nFdOGladu5E1dH5mPGUZo2HJ6VLbb2YW4zljitea2gSYxyjjG4H61HJMlmMWwFeiqaizPmuXbSF7OIRtgt1r6M/YL+Pp+Bn7QWkzapdCLQfEpGlajubCIHOEkP0bFfLkt1LKA0jZ5oEsg2vEzK6EMrKeQR0NXNKcXFiXuu5/TijJIoeNwyMAysOQQehp2K+XP+CeH7RUfx7+A1jbaterJ4m8IhNL1RCfmdVH7qb6Moxn1FfUdeDKLg+VnoxakrhijFFFSMMUYoooAMUYoooAMUYoooAp39olzEysM15f4r0FbXzEnjLW0v3uPuH1r1wgEYrI1nS4r2BkdM5FXTqSpSU47owxWGp4uk6NVXTPjr4i+BHtpHuLdMqfmVlHBFeT3KPBIY3Uhl4Ir7A8U6B9iD2l3EXs3J2tjJiP8AhXg/xA8BSW0jXVsmV6gr0YV+iZJnka8VSqvU/mnjvgOrl9Z4rCq8WeWu9bnhH4g+I/BV2LjSL1vLBy0DnKN+HasO7glt3KOpHrmqTt719HWpUsTBwqJNM/N8FisTlldVsNNwmuq0Psn4XftOeH9bMWn6xcDTb04GyZsI5/2W6fnX0JpHiWy1CJGSZSGGQQetflZIw6V2Xgn41ePvALqmlau1xaL/AMut0TJHj/Z7r+Br43H8LRd54R28n/mftPD3ivNJUc4hf+/Hf5x/y+4/TpJEkGUYEU+vkzwD+2f4cuxFa+LbOfS5jgNKP3kJP1HI/EV794W+Kng/xXbrNo2vWV2p7RzAkfh1r5XE4DE4R2qwa/L7z9ay3P8ALc3ipYStGXlez+56na0VXjvIJRlXBzUwZSODXIexe46iiigAooooAKKQ470hYKMkgAUAOorkPGHxa+G/gGBrjxZ4y0uwwD8jzqXP0Uc18z/E3/goz4M0VJrL4a+HbjW7oZVLq7zBbA+uPvMPy+tdNHCV8Q/3cWebjM3wWAV69RLy3f3I+wbq6trOCS6u7iOCGJSzySuFVVHUkngCvlv44/t7/Dn4fLcaJ4ACeKdbTchkibFnC3u4+/j0X86+Gviz+0l8XPjDJIni3xXONOZsrpln+5tV9ig+/wDVia8nlkzxXt4bJYw97EO/kj4fM+Np1U6eAjZfzPf5I7j4rfGv4ifGLV21bxxr812AxMNqh228A9FQcD69a8+Zu9K71CzV7Fo0o8sFY+SiqmJn7Ws22+rEduahd+1K71CzYrnnI9GnTsI7YqImlZqZnnFYSZ6NGnbUPwoIycClGTwKv6dpkt3IoCnHrWUpKKuztpwc3yoTTdOkupAAvHrWlcS7/wDiV6fyucSOP4j6fSnTziFf7N03lz8skg/kK734bfDm51a6iJgLZI7V42JxLqPlWx9llWWKgva1NzV+E/w3n1O6hZoCQSO1fd/wi+G8Wl2sLNAAcDtXNfBz4UR2EEMklvyAD0r6T0XSIrGBEVMYArzm7nvbsuafZJbRKirjiruKQLilpFBis/xFr2leFdB1HxNrl0ltp+lWst5dTOcKkaKWJJ/CtCvz1/4K3ftJf8Ib8PbP4B+GdQKat4rxc6wYzzFp6niMnt5jDkegppXdhSfKrn5r/tGfFnVPjx8Y/EnxL1GUmPU7thZxk8RWqnESgdvlAP415zHbtjgjFUMelKFb1r0YtLQ43qX3t3xgYqq0DpIARy1ORpkXKGrul3Mst3FG/wA3zAYxVxSk0iHeKue/fsefBy7+J/xM0rRxaO9v56STtt4Cg1+9nh7RrXw9odjolmgWGygSFAPQDFfC3/BM/wCDF5o2jzfELVrIxeegS33pgn3r75rkxE+aVlsi4LS7CiiisCwooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigArzb9ob4a2nxV+FOu+FZ7dZZZbZ2gyuSHA4xXpNBAIwaadncD+bDx/4V1Twl4g1XQNRs5IbnTpmjIcYO0HiuOinLkrJX6Z/wDBUj9nO40/Xbf4t+HbBVsbkbL0RJ0buTivzP1awks7jlSFPI9xXpwqc8ebqc/LyuxDMArEhuPSlgmGduaVJzLH9nfG0c5pGhEeGTBp87GkfQv7En7R15+zX8cdM8SXM7nw3rJXTddgDYVrdyMS/VDhh+NfvdYX1lqllb6npt1Hc2l3Ek8E0bBkkjYZVgR2INfzJrvaM78Yx6V+t3/BKv8Aaik8b+DH+A3jPUC2seHIy+jSTN809nnmIepQ9PaubE0uZe0RvQqWfKz9BaKT86PzrgOsWik/Oj86AFopPzo/OgBaKT86PzoAWmsoORil/Oj86AMLXtCh1C3dSgOR6V4z4p8OTaSZIbi3aayYnIxlo/cV9BMoIwR19aw9c0KDUIWRowcj0q6dSVKXNF2Zz4nC0sXTdKqrpnxp428Bo6G9sAJInyVZe9eSalp9xYSMskZAB64r6+8WeDL7RpZbjTot8LkmSA/df/A+9eT+IvCen62kr2cXlzqDvhfhl/xFfaZVxBdKnVPw3i7w7cXLE4NaHgsj4NQs2TXRa/4VvNMlbEbbQemK5uVWTggjmvq41oVY3iz8kqYGrhZ+zrRs0MdgBSW+o3uny+fYXk1vIDw0UhQ/mKhkeq0kmO9RNp6M2pXi+aLsejeH/wBor4veFkSHT/GV3LFH0juMSj9ea9G0L9vH4k6aoTWND0rUQvBcBomP5HFfNMknvVd5K8+tl2Eq6zpo+kwXEub4Oyo4iVuzd/zufZ+n/wDBQ+NMLqfw8k9zBej+RWtiP/gop4JC5m8B6yG/2Z4yK+EJH54NV3bPArglkeCf2bfNnv0eO89jo6ifrFf5H3rN/wAFGvBKg+T4A1hj/tXEYFYeo/8ABR9cEaV8Mz7G4vv6Ba+JOByajkkABrH+x8HHaP4s9CPGOdVVeVRL0ij6l8Tf8FCvivqCNHoeiaLpAPAYRtM//jxxXj/jD9pz43+NEaHV/H+opAxz5Vq3kr+S4ry95C3U8VVmnA4WtYYLD0vggjCrnOY4v+NWlb1t+RPqOp3V9M1xe3UtzM3LSSuXY/iay5ps96SSX3qrJJnvW+iPOk3N6iSSHOKgds0M3FRM1ZylY6qFHmd2I7VC7U5mqFmz0rlnI9anCw1j3qJjk09ielRnOKxZ3UodRpPNCIWPGTU8FrJM2FUmtu30u2sohc6hIETqB3P0Fc1WrGmrs9XDYapXlywRS03SHnO+QbUHJJ4AFXZbky/8S/SQdp+V5R1b6e1PH2zW3W1tITFbZ4QdW9zXq/w2+Ed1qU8TPbEgkdq8bEYp1XZbH2mXZTDCrnqayMP4dfDS71W5iLW7EEjtX2l8IPg9FZRwyS2wBAB6Vo/Cv4OQafHDJLbAHjtX0PoWgQadAqJGBj2rhbPZSuGgaBBp0CoqAYFbyqAKFQKBgflS/nUli0Un50fnQM5v4k/EHw98K/AutfEDxVdx2+m6LaPcys5xuIHyoPUk4Ar+d347fFzX/jr8VNe+JniKZmm1a6Z4oyxIhhBxHGvoAuK+3v8Agq3+1YPFfiGP9nfwTqe7S9GkE2vTQvlZ7r+GHI6hOp96/OUp6iumlTdrs5qs7uwgG0dKRiMZPWnYGKa2Ogq3dGKJYW3LtB5r1D9nv4Zap8SviJpnhvTrZ5ZJ7lAxAztXPNecWVq1wyqBnJA6V+tf/BMH9mmfQdJHxY8TWAWSdMWQcc896fM6auJrmdj7v+G/hG38DeCdI8L26gfYbZI3IGMsBya6WiiuU1CiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA474t/DbR/iv4E1PwZrMQaO8hZUYjJR8cEV+DPx4+Fd18N/GereBdUt5I5bGZ/szuuN6A8V/QvXw9/wUg/ZZX4m+Dm+I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oAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAr50/ak/ZZ0/4vaU2v8AhZIbHxPaAvDLsBWX/ZYdDmvouiqjJxd0JpNWZ+EXxp8DN4N1h/DHxL8M3Ph3W485vmcLaT+64HGfSvDtR8O2pLHS75L1B0eNiwNfvr+0L+zn4H/aD8H3Ph/xHp8K3hQ/ZrzYN8bdufSvxo/aR/Yt+Lf7P2pzN9nvL7RixaO5t9xXb2zivUo4z2kVCe5i6VvhPnu40+6hlK3ELKPcVPAksAxHyDVSPWtTtCYpI1cg4PmpuP61Zm8Q2siANaOr4+bbgDNae2UQ5WMuoZHO+UEfhRY38+m3MV7p95LbXFuweKaJyrow6EEcg1Zt7nTL6ErNdrCT/faq7aRcMxFqwmi/hdRwabrJi2Puv9mP/gql47+HK2nhL422k/i7w/HiNNRjYDUbVenJPEwHocH3r9RfhN8bvhd8cfDyeJvhh4wsdatSoM0cT7Z7Zj/DLEfmQ/UfTNfznjR9RTnyG/AV0Pgjxv4z+FviCDxR4L8T6loGr27ArPZzmMkDswHDD2IIrkqYaFTWOjNoVnDRn9JFFfl18A/+Cud/Yi10D4/+G/t0Qwja7paBZAP70kHQ/Vfyr9BvhX8ePhJ8adKj1X4beN9N1dHXLQRyhZ4z6NGfmH5Vw1KM6XxI6Y1Iz2O/ooorIsKKMj1oyPWgYUUZHrRketABRRketGR60AFFGR60ZHrQAUUZHrRketABRRketGR60AFFGR60ZHrQAUUZHrRketABRRketHXgZNAgozXj/wAa/wBrL4E/AOzkm+IHjqxivFB2adauJ7tyO3lryPxxX5uftB/8FbviX42+0+H/AIJaUPB2lybozqU22W/kU8ZX+GL6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1bAdM8g0Af0M0V518CvjP4c+N3gWy8V6HdRtJJGv2iENkxvjnNei0AFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUABVT1UH8KTYn90flS0UAJsT+6PypQqjoAKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigApHRZFKOoZWGCCOCKWigD8tf+CmH7L6aDqK/FvwnYJHZ3JxdxRJgK3c1+eKp6iv6NvH/gTw/8R/C974U8SWaXFneRlGDDO046ivxM/a8/Zn1r4AeO7iFLSQ6HdyFrSfHy4J6UAfP4AAwKKMU4DFA7H1F+wz+07dfA7x7Dper3LHQtTcRTKzcIT3xX7R6HrWneItJtdb0m4We0vI1likU8EEV/N4jtGwdCQynII7Gv0w/4J3/tjrcJb/CDx9fqhUCPTpnPfsuaAaP0hooBDAMpBB5BFFAgooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigArxn9qn4CaT8evhlfaBNbodSt42lspMfMHA6V7NRQB/OZ468E618PvE994W160e3urKVoyrAjIB61gV+t3/BQr9k2P4g+Hn+IfgfRk/tmzBe6ES8yKO/Ffkve2d1p91LZXkLRTQsUdGGCCKCkyGtLw3r9/wCF9bs9e0yVo7mylWVCDjkHNZtFAz9xv2Mv2m9L+PvgKCG5dYtb0yJYriMty+BjdX0ZX8/37Pfxv8R/BHx7Y+IdIv5IrbzVF1GGO10zzkV+53wl+KHhz4t+DLLxZ4cvo54541MqqclHxyDQS0dnRRRQIKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAZPBDdQvb3EavHIpVlYZBB7V+Rn/AAUV/Zeuvh54wk+IvhfTP+JJqTFpfKXiNz1ziv12rkvin8ONE+KvgnUvBuuwI8N7EyKxGSjY4IoA/naor179pT9n/wAR/AXx5eaBqNtI1i0ha2uNp2sueOa8hoKCvs3/AIJ7/tUp8IvFY8D+KJ2Oi6u4jVmfiJyeDXxlToZpbeVJ4XKOhDKwOCCKAZ/STY31pqVnDf2M6TQToHjkQ5DKehqevgP/AIJ6ftf2XibSLT4R+MbsjUrZdlpNI33x6Zr7868igkKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAPBf2v/wBnqw+O/wANLywt7aMaxZoZbWQKNzED7ua/ELxn4P1zwL4hvPDfiCyktru0kKMrrjOD1r+jevz8/wCCkf7K48SaU3xc8IaeWvbYYvYok+8P73FA0z8sKKdJHJDI0UqFXQkMCOQabQUb/gTxpq/gDxRYeKtFmaO5sZVkXBxnB6V+3/7KP7SXh74++A7S7S9hTW7aMJd224bsgfeAr8Ia9Y/Zt+OetfAr4jaf4nsJ5DaeYFuYQx2uh68UCaP36orlvhn8QNH+JvgzTfGOiSq8F9CrkA52tjkV1NBIUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUU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BRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAfJ37df7K+lfGTwRc+K9GtVj1/SomlBjQZmUDofWvxn1PTrvSNQuNNvoWint3MbqwwQQa/pHlijnjaGVA6OCrKehBr8vf+CjX7I+n+F8/FrwPYMsFzITfQxrwjHvxQNM/PGijocGigo7b4Q/FPxF8IfGdj4s8P3ckb20qtIgYgOueQa/dH9n740aJ8b/h3p3izTbiI3LxKLqFWGUfHPFfz8V9M/sQ/tK6l8EfiRaWOpaiy6BqTiK5R2+VcnrQJo/bmis/QNe0vxNpNtrejXaXNpdxiSORDkEGtCgkKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKyPFnhXRPGugXfhvxDYx3dleRlJI3Gevce9a9FAH4a/tjfs16x8C/iHeta6ZImgXkrPaSgfLgnpXzvX9AP7Q/wV8PfGv4fah4e1eySW5WF2tZCPmV8cYr8IviL4K1P4feMdS8K6rbvDLZTugDDGVB4NBSOboDFSGUkEcgiiigZ+l3/BOX9rjT4LGP4R+OtUKSbgLCWVuP93Jr9I1ZXUOjAqwyCO4r+bzQ9Zv/AA/q1trGmztDcWsiyIynBBBr9rP2J/2ntG+OXgG10q8u1XX9LiWKeN2G6QAYyPWglo+mKKKKBBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABXxL+35+x7Y/E3w7P8AEbwXYRQ65p6GW6VFwZlHJP1r7aqO5t4bu3ktbmNZIpVKOrDgg9RQB/Nve2dxp93LZXUZSWByjqexBqGvun/gon+ynF8PNe/4WN4N01l0rUGLXCRpkRv36V8LUFBXffBT4t+Ivg5450/xVoV9LCsMymeNWIEiZ5BrgaKBn9CfwQ+LehfGbwDp/i/RbhXM0SidAeUfHNd/X42fsEftU3vwg8YweDdduC+harKsZ3txExPWv2MsL611Oyhv7KZJYJ0EkbqcggiggnooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA5z4g+A9B+I/hW+8KeIbSOe2vImT5lBKEjgivw5/ap/Z+1f4CfEi90KW3lbTZpDJazFcKVJ6Zr96a8O/ax/Z60P48fDi+sJbNDq9pE0tnMFG7cB93NA07H4PUVueNPB+s+BfEd54b1yzktrm0lZCrrgkA9aw6Ch0M0sEqTQyMjoQyspwQa/Ub/AIJz/tdzeJraL4QeNrpftNsv+hXMr8sOy81+W9bPg/xbrHgjxDZ+JNDungurOVZEZTjOD0oEz+jnryKK8B/ZA/aM0r47/DqznuL6I65ZxiO7h3fMSB97Fe/UEhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQB8G/8ABRT9k228ZaDJ8UvBek51a0Ba7SIcuvrivyingmtZnt7iNo5I2KspHIIr+ki+srbUrOawvIlkgnQxyIwyCCOa/Hj9vj9k/UPhF4tuPHHh20Z/D2qSGQlRxG5PIoGj47ooooKPVf2dvjz4p+BHjq08Q6FdMLdpFW5hJ+V0zzxX7ofCv4h6T8UPA+meMdInjkjvYFeRUbOx8civ52q+2f8Agn1+1q3wu8RL4B8Z6i/9h6gwSJnbiJj0oJaP15oqDT7+01Syh1CwnWa3uEEkcinIZT0NT0CCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACuO+LPwv8OfF3wVfeDfEtqstvdIQjEco+OCK7GigD8Bv2kvgTrnwI+IN74a1CBhaGRmtZSOGTPFeTV+437Zn7M+jfHbwDdXUFqi65p0LSW8oHzMAM4r8SvEOhX3hrWrvQ9ShaK4tJWidWGDwcUFJmdT4JpLaZJ4WKvGQykdiKZXuv7NP7KXjn9oLX400+xkt9HicfaLp1IULnnBoGfoJ/wTj/AGk7z4l+EP8AhXuvpI99o0YEUuOGQdia+2a8i/Z//Zp8A/ADRBZeGbMNfSoBcXTD5nPevXaCAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAoorzP4vftC/Dn4NW7x+ItRa51Ux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BRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAf/9k=";



	pdf.addImage(uri, 'JPEG', 150, 30, 150, 140);



	source = $(id)[0];

	margins = {
		top: 150,
		bottom: 10,
		left: 150,
		width: 4500
	};
	// all coords and widths are in jsPDF instance's declared units
	// 'inches' in this case

	pdf.fromHTML(
		source, // HTML string or DOM elem ref.
		margins.left, // x coord
		margins.top, { // y coord
			'width': margins.width, // max width of content on PDF
			//'elementHandlers': specialElementHandlers
			'pagesplit': true,
			'margin':1
		},

		function (dispose) {
			// dispose: object with X, Y of the last line add to the PDF
			//          this allow the insertion of new lines after html
			pdf.save('Reporte.pdf');
		}, margins);



}




</script>









<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/show_associations/5', ['class'=>'btn btn-primary']);?>
  </div>
</div>








