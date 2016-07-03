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
            html+="<td>"+object.invoices[i].legal_certificate+"</td>";

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
            html+="<td>"+object.invoices[i].legal_certificate+"</td>";

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
            html+="<td>"+object.invoices[i].legal_certificate+"</td>";

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