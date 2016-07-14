function setTractValues(object)
{

    var select =  document.getElementById("tracts_id");
    var date = "Periodo del tracto: <br><br>"+select.options[select.selectedIndex].text +"<br><br>";


    var boxes_classes = document.getElementsByClassName("boxes_total_tract");


    boxes_classes[0].innerHTML = object.amounts.total_boxes;
    boxes_classes[1].innerHTML = object.amounts.total_boxes;
    document.getElementById("little_amount_tract").innerHTML = object.amounts.little_amount;
    document.getElementById("big_amount_tract").innerHTML = object.amounts.big_amount;


//*******************************END BOXES****************************//

//*******************************INVOICES****************************//
    var invoices_length = object.invoices.length;
    var html = "";

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
            html+="<td>"+object.invoices[i].legal_certificate+"</td>";

            html+="</tr>";

        }



    }

    document.getElementById("tract_invoices_total").innerHTML = "<h4> Total: "+object.amounts.total_outgoing+"</h4>";
    document.getElementById("tract_invoices").innerHTML = html;




    amount_classes = document.getElementsByClassName("tract_saving_total");
    document.getElementById("tract_amount").innerHTML = object.amounts.tract_amount;
    saving_classes = document.getElementsByClassName("saving_amount");
    saving_classes[0].innerHTML = object.amounts.saving_amount;
    saving_classes[1].innerHTML = object.amounts.saving_amount;

    amount_classes[0].innerHTML =  object.amounts.period_income;
    amount_classes[1].innerHTML =  object.amounts.period_income;

    document.getElementById("tract_date").innerHTML = date;
    document.getElementById("total_income").innerHTML = object.amounts.total_income; //Total de ingresos monto inicial + monto de ahorro
    document.getElementById("total_spent").innerHTML = object.amounts.total_outgoing; //Total de gastos
    document.getElementById("tract_initial_amount").innerHTML = object.amounts.initial_amount;
    document.getElementById("tract_final_balance").style = ((object.amounts.final_balance < 0)? "color: red" : "color:green");
    document.getElementById("tract_final_balance").innerHTML =  object.amounts.final_balance; // saldo final = total de ingresos - total de gastos
    document.getElementById("tract_count").innerHTML = object.amounts.account;
    document.getElementById("tract_count").style = ((object.amounts.negative_final_balance != 0) ? "color: red": "color: green");



}






function setGeneratedValues(object)
{

    var select =  document.getElementById("generated_id");
    var date = "Periodo del tracto: <br><br>"+select.options[select.selectedIndex].text +"<br><br>";


    //*******************************BOXES****************************//
    var boxes_classes = document.getElementsByClassName("generated_total_boxes");



    boxes_classes[0].innerHTML = object.amounts.total_boxes;
    boxes_classes[1].innerHTML = object.amounts.total_boxes;
    document.getElementById("generated_little_amount").innerHTML = object.amounts.little_amount;
    document.getElementById("generated_big_amount").innerHTML = object.amounts.big_amount;


//*******************************END BOXES****************************//


//*******************************INVOICES****************************//

    var invoices_length = object.invoices.length;
    var html = "";


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
            html+="<td>"+object.invoices[i].legal_certificate+"</td>";

            html+="</tr>";


        }



    }

    document.getElementById("generated_invoices_total").innerHTML = "<h4> Total: "+object.amounts.total_outgoing+"</h4>";
    document.getElementById("generated_invoices").innerHTML = html;

//**************************** END INVOICES **********************//

//*******************************INCOMES****************************//

    amount_classes = document.getElementsByClassName("generated_amount");

    html = "";
    var incomes_length = object.amounts.amounts.length;

    if(incomes_length > 0)
    {
        for(i = 0; i < incomes_length; ++i)
        {
            html+="<tr>";

            html+="<td>"+(i+1)+"</td>";
            html+="<td>"+(object.amounts.amounts[i].date.split("T"))[0]+"</td>";
            html+="<td>"+object.amounts.amounts[i].detail+"</td>";
            html+="<td>"+object.amounts.amounts[i].amount+"</td>";

            html+="</tr>";

        }


    }

    amount_classes[0].innerHTML = "<h4> Total: "+ object.amounts.period_income+"</h4>";
    document.getElementById("generated_incomes").innerHTML = html;

//****************************** END INCOMES **************************//

//*******************************AMOUNTS****************************//



    amount_classes[1].innerHTML =  object.amounts.period_income;

    document.getElementById("generated_date").innerHTML = date;
    document.getElementById("generated_total_income").innerHTML = object.amounts.total_income;
    document.getElementById("generated_total_spent").innerHTML = object.amounts.total_outgoing;
    document.getElementById("generated_initial_amount").innerHTML = object.amounts.initial_amount;
    document.getElementById("generated_final_balance").innerHTML =  object.amounts.final_balance;
    document.getElementById("generated_final_balance").style = ((object.amounts.negative_final_balance != 0) ? "color:red" : "color:green");
    document.getElementById("generated_saving_account").innerHTML = object.amounts.account;




    /************************** END AMOUNTS ********************************************************/


}



function setSurplusValues(object)
{

    var invoices_length = object.invoices.length;
    var html = "";

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
            html+="<td>"+object.invoices[i].legal_certificate+"</td>";

            html+="</tr>";

        }


    }

    document.getElementById("surplus_total_invoices").innerHTML = "<h4> Total: "+object.amounts.total_outgoing+"</h4>";
    document.getElementById("surplus_invoices").innerHTML = html;

//******************* END INVOICES **********************///


    date = "Superávit del año: "+document.getElementById("surplus_year_id").value +"<br><br>";


    amount_classes = document.getElementsByClassName("surplus_amount");


    amount_classes[0].innerHTML =  object.amounts.amount;
    amount_classes[1].innerHTML =  object.amounts.amount;
    amount_classes[2].innerHTML =  object.amounts.amount;

    document.getElementById("surplus_date").innerHTML = date;
    document.getElementById("surplus_total_spent").innerHTML = object.amounts.total_outgoing;
    document.getElementById("surplus_final_balance").innerHTML = object.amounts.final_balance;
    document.getElementById("surplus_final_balance").style = ((object.amounts.negative_final_balance != 0) ? "color:red" : "color:green");




    /************************** END AMOUNTS ********************************************************/


}