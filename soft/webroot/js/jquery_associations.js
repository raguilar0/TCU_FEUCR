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
    $.post($("#submit1").attr("action"),$("#submit1").serialize(), 
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

function saveInvoices()
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

    xhttp.open("POST", document.getElementById("submit2").action,true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send($("#submit2").serialize());
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