$('#submit1').submit(function(e){
    e.preventDefault();
    modifyAssociation();
});

$('#submit2').submit(function(e){
   e.preventDefault();
    saveInvoices();
});

$('#submit3').submit(function(e){
    e.preventDefault();
    modifyBoxes();
});

function modifyAssociation()
{
    var formData = new FormData(this);

    $.post($("#submit1").attr("action"),formData, 
    function(data, status)
    {
        if(data == '1')
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
        }
        else
        {
             $("#callback").text("Ocurrió un error inesperado. Revise los datos e intentelo nuevamente. Si el problema persiste, contacte al administrador");
            $("#callback").css("color","red");
        }
       
    });
}

/**
function saveInvoices()
{
    $.post($("#submit2").attr("action"),$("#submit2").serialize(), 
    function(data, status)
    {
        alert(data);
        if(data == '1')
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
        }
        else
        {
             $("#callback").text("Ocurrió un error inesperado. Revise los datos e intentelo nuevamente. Si el problema persiste, contacte al administrador");
            $("#callback").css("color","red");
        }
       
    });
}
**/


function saveInvoices()
{
    var sure = confirm("¿Ya verificó que el Tipo y la Fecha estén bien?")


    if(sure)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {

            if(xhttp.readyState == 4 && xhttp.status == 200 )
            {
                document.getElementById("callback").innerHTML = "¡Los datos se guardaron con éxito!";
                document.getElementById("callback").style.color = "#01DF01";
                setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 3000);
            }
            else
            {
                if(xhttp.status == 500)
                {
                    document.getElementById("callback").innerHTML = "Ocurrió un error inesperado. Revise los datos e intentelo nuevamente. Si el problema persiste, contacte al administrador";
                    document.getElementById("callback").style.color = "red";
                    setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 6000);
                } 
            }          
               
        };

        var form = $('#submit2')[0];
        var formData = new FormData(form); //El serialize no funciona cuando hay archivos involucrados
        //Por eso se usa FormData, el cual crea un objeto de pairs y además 
        //crea un content-type que se necesita para enviar archivos i.e multipart/form-data

        xhttp.open("POST", document.getElementById("submit2").action,true);
        xhttp.send(formData);        
    }

}

function modifyBoxes()
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
            if(xhttp.status == 500)
            {
                document.getElementById("callback").innerHTML = "Ocurrió un error inesperado. Revise los datos e intentelo nuevamente. Si el problema persiste, contacte al administrador";
                document.getElementById("callback").style.color = "red";
                setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 6000);
            } 
        }          
           
    };

    xhttp.open("POST", document.getElementById("submit3").action,true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send($("#submit3").serialize());    
}

$(document).ready( function(){
    if(!Modernizr.inputtypes.date)
    {           
        $('#date').datepicker();            
        $('#deadline').datepicker();  
    }        
});