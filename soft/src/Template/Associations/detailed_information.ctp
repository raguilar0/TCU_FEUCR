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
					echo "<label><h4><strong>Elegí el año</strong></h4></label>";
					echo "<select class='form-control' id= 'tract_year_id' name = 'year' onchange='reloadPage(this)'>";


					foreach ($years as $key => $value) {
						echo "<option>".$value['year']."</option>"."<br>";
					}

					echo "</select>";
					?>
				</div>

				<div class="col-xs-12 col-md-6">
					<?php
					echo "<label><h4><strong>Elegí el tracto</strong></h4></label>";
					echo "<select class='form-control' id= 'tracts_id' name = 'type' onchange='getAmounts(0,0,0,this);'>";



					foreach ($dates as $key => $value) {
						echo $key;
						echo "<option>".$value['tract']['date']."</option>"."<br>";
					}

					echo "</select>";
					?>
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


					<table class="table table-striped">
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
					<button onclick="generatePDF('Informe de montos de Tracto', '#tract', document.getElementById('tract_date'));" class="btn btn-success">Informe</button>
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
					<button onclick="generatePDF('Informe de montos de Superávit', '#surplus', document.getElementById('tract_date'));" class="btn btn-success">Informe</button>
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
					echo "<label><h4><strong>Elegí el año</strong></h4></label>";
					echo "<select class='form-control' id= 'tracts_generated_id' name = 'year' onchange='reloadPage(this)'>";


					foreach ($years as $key => $value) {
						echo "<option>".$value['year']."</option>"."<br>";
					}

					echo "</select>";
					?>
				</div>

				<div class="col-xs-12 col-md-6">
					<?php
					echo "<label><h4><strong>Elegí el tracto</strong></h4></label>";
					echo "<select class='form-control' id= 'generated_id' name = 'type' onchange='getAmounts(1,1,1,this);'>";



					foreach ($dates as $key => $value) {
						echo $key;
						echo "<option>".$value['tract']['date']."</option>"."<br>";
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
					<button onclick="generatePDF('Informe de montos de Ingresos Generados', '#generated', document.getElementById('tract_date'));" class="btn btn-success">Informe</button>
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
            	switch(amount_type)
            	{
            		case 0:
            			setTractValues(xhttp.responseText);
            		break;

            		case 1:
            			setGeneratedValues(xhttp.responseText);
            		break;

            		case 2:
            			setSurplusValues(xhttp.responseText);
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
    
    	var path = location.pathname;

    	path = path.split('/');

    	var index = getIndex(path, 'detailed_information');
    	var newPath = "";

		for (var i = 0; i  < index; ++i) {
			newPath += path[i]+"/";
		}
    	newPath += 'getAmounts/'+path[(index+1)];

    	newPath += "/"+amount_type+"/"+box_type+"/"+invoice_type+"/"+object.value;

        xhttp.open("GET",newPath,true);
        //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
       
    }
    
    function setTractValues(json)
    {

    	object = JSON.parse(json);




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
		var saving_amount = 0;
		var tract_saving_total = 0;
		var total_income = 0;
		var tract_initial_amount = 0;
		var final_balance = 0;
		var tract_final_balance = 0;
		var tract_count = 0;
		var date = "";
		var saving_classes = 0;


		if(object.initial_amount.length > 0)
		{
 			tract_initial_amount = object.initial_amount[0].amount;
		}	

		if(object.savings.length > 0)
		{
			saving_amount = object.savings[0].amount;
		}

		if(object.amount.length > 0)
		{
			 tract_amount = object.amount[0].amount;
			 tract_saving_total = tract_amount + saving_amount;
			 total_income = (tract_initial_amount + tract_saving_total);
			
			 tract_final_balance = (total_income - invoices_total);
			 tract_count = (tract_final_balance - total_boxes);
			 date = "Periodo del tracto: <br><br>"+document.getElementById("tracts_id").value + " - " +object.amount[0].tract.deadline+"<br><br>";			
		}

	

		amount_classes = document.getElementsByClassName("tract_saving_total");
    	document.getElementById("tract_amount").innerHTML = tract_amount;
		saving_classes = document.getElementsByClassName("saving_amount");
		saving_classes[0].innerHTML = saving_amount;
		saving_classes[1].innerHTML = saving_amount;
    	
    	amount_classes[0].innerHTML =  tract_saving_total;
    	amount_classes[1].innerHTML =  tract_saving_total ;
    	
    	document.getElementById("tract_date").innerHTML = date;
    	document.getElementById("total_income").innerHTML = total_income;//TODO: Sumar el saldo incial de cajas y el monto de ahorro
    	document.getElementById("total_spent").innerHTML = invoices_total;
    	document.getElementById("tract_initial_amount").innerHTML = tract_initial_amount;
		if(tract_final_balance < 0)
		{
			document.getElementById("tract_final_balance").style = "color: red";
		}
		else
		{
			document.getElementById("tract_final_balance").style = "color: green";
		}
 
    	document.getElementById("tract_final_balance").innerHTML =  tract_final_balance; //TODO: El amount no es el correcto, lo correcto es sumar el ahorro, las cajas y el ingreso de tracto

    	document.getElementById("tract_count").innerHTML = tract_count;

		if(tract_count < 0)
		{
			document.getElementById("tract_count").style = "color: red";
		}
		else
		{
			document.getElementById("tract_count").style = "color: green";
		}


    }






  function setGeneratedValues(json)
  {


	object = JSON.parse(json);


    var total_boxes = 0;
    var little_amount_generated = 0;
    var big_amount_generated = 0;

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

    document.getElementById("generated_invoices_total").innerHTML = total_message;
    document.getElementById("generated_invoices").innerHTML = html;

//**************************** END INVOICES **********************//

    amount_classes = document.getElementsByClassName("generated_amount");
    
    html = "";
    var incomes_total = 0;
    total_message = "";
    var incomes_length = object.amount.length;;

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


    var generated_initial_amount = 0;

    var generated_final_balance = 0;
    var generated_saving_account = 0;

    var date = "";

    if(object.initial_amount.length > 0)
    {
        generated_initial_amount = object.initial_amount[0].amount;

    }

	 generated_final_balance = ((incomes_total + generated_initial_amount) - invoices_total);
	 //date = "Periodo del tracto: <br><br>"+document.getElementById("tracts_id").value + " - " +object.amount[0].tract.deadline+"<br><br>";


    if(object.saving_account.length > 0)
	{
		generated_saving_account = object.saving_account[0].amount;
	}

    amount_classes[1].innerHTML =  incomes_total; 
 
    
    document.getElementById("tract_date").innerHTML = date;
    document.getElementById("generated_total_income").innerHTML = incomes_total;
    document.getElementById("generated_total_spent").innerHTML = invoices_total;
    document.getElementById("generated_initial_amount").innerHTML = generated_initial_amount;

    document.getElementById("generated_final_balance").innerHTML =  generated_final_balance;
	  if(generated_final_balance < 0)
	  {
		  document.getElementById("generated_final_balance").style = "color:red";
	  }
	  else
	  {
		  document.getElementById("generated_final_balance").style = "color:green";
	  }

    document.getElementById("generated_saving_account").innerHTML = generated_saving_account;




    /************************** END AMOUNTS ********************************************************/


}



function setSurplusValues(json)
{

	object = JSON.parse(json);



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
	var hr = window.location.href;
	var splt = hr.split('/');
	var path = "";
	var index = getIndex(splt, 'detailed_information');

	for (var i = 0; i  < (index+2); ++i) {
		path += splt[i]+"/";
	}

	path += element.value;

	window.location = path;
}


function getIndex(array,word) {
	var len = array.length;
	var index = 0;
	var out = false;

	for (var i = len - 1; (i >= 0) && !out; i--) {

		if(array[i] == word)
		{
			index = i;
			out = true;
		}
	}

	return index;
}



function generatePDF(title, id, date) {
	var pdf = new jsPDF('landscape', 'pt', 'tabloid');
	pdf.setFontType("bold");

	pdf.setFontSize(16);
	var header = document.getElementById("association_name");
	date = date.innerHTML;
	date = date.split(":");

	var label = date[0];
	date = date[1].replace(/<br>/g, "");
	header = header.innerHTML;
	var initialPosition = 380;
	var titlePosition = getPosition(header.length, title.length);
	titlePosition = titlePosition + initialPosition + 80;
	var labelPosition = getPosition(title.length, label.length);
	var datePosition = getPosition(label.length, date.length);

	labelPosition = titlePosition + labelPosition + 40;
	datePosition = labelPosition + datePosition;

	pdf.text(initialPosition, 40, header);

	pdf.text( titlePosition,70,title);
	
	pdf.text(labelPosition,100, label);
	pdf.text(datePosition,140,date);

	// source can be HTML-formatted string, or a reference
	// to an actual DOM element from which the text will be scraped.
	source = $(id)[0];

	// we support special element handlers. Register them with jQuery-style
	// ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
	// There is no support for any other type of selectors
	// (class, of compound) at this time.
	/**
	specialElementHandlers = {
		// element with id of "bypass" - jQuery style selector
		'#bypassme': function (element, renderer) {
			// true = "handled elsewhere, bypass text extraction"
			return true
		}
	};
	 **/
	margins = {
		top: 100,
		bottom: 10,
		left: 150,
		width: 3500
	};
	// all coords and widths are in jsPDF instance's declared units
	// 'inches' in this case
	pdf.fromHTML(
		source, // HTML string or DOM elem ref.
		margins.left, // x coord
		margins.top, { // y coord
			'width': margins.width // max width of content on PDF
			//'elementHandlers': specialElementHandlers
		},

		function (dispose) {
			// dispose: object with X, Y of the last line add to the PDF
			//          this allow the insertion of new lines after html
			pdf.save('Test.pdf');
		}, margins);
}

	function getPosition(lengthFirst, lengthSecond) {
		var total = lengthFirst - lengthSecond;



		return total;
	}




</script>









<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/show_associations/5', ['class'=>'btn btn-primary']);?>
  </div>
</div>








