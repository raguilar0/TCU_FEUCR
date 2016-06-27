
$('#submit1').submit(function(e){
    e.preventDefault();
    addAssociation();
});


$('#submit2').submit(function(e){
    e.preventDefault();
    addHeadquarter();
});


$('#submit3').submit(function(e){
    e.preventDefault();
    modifyAssociation();
});


$('#submit4').submit(function(e){
    e.preventDefault();
    modifyHeadquarter();
});

$('#submit5').submit(function(e){
   e.preventDefault();
    addAmounts();
});

$('#submit_add_initial_amount').submit(function(e){
   e.preventDefault();
    addInitialAmounts();
});

$('#submit_add_saving_account').submit(function(e){
    e.preventDefault();
    transferSavingAccount();
});

$("#submit_add_tract").submit(function(e){
  e.preventDefault();
  addTract();
});


//Esta función sirve para agregar una asociación 
function addAssociation()
{
    $.post($("#submit1").attr("action"),$("#submit1").serialize(), 
    function(data, status)
    {   

        var array_data = data.split(',');



        if(array_data[0] == "1" && array_data[1] == "1")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
        }
        else
        {
            if(array_data[0] == "0")
            {                
                $("#callback").text("Lo sentimos. Es probable que este nombre de asociación o de la sigla ya exista y por lo tanto no puede agregarse. Puede revisar las asociaciones deshabilitadas y en el caso de que se encuentre ahí, habilitarla.");
                $("#callback").css("color","red");
            }
            else
            {            
                $("#callback").text("Se guardó la Asociación, no así los montos. Revise si llenó los campos correctamente.");
                $("#callback").css("color","#FF8000");
            }
        }               

    });
}


//Este método sirve para agregar una sede
function addHeadquarter()
{
    $.post($("#submit2").attr("action"),$("#submit2").serialize(), 
    function(data, status)
    {

        if(data == "1")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#58ACFA");

            setTimeout(function(){location.reload();},1000);

        }
        else
        {
            $("#callback").text("Lo sentimos. Es probable que el nombre de esta sede ya exista y por lo tanto no pudo guardarse en la base de datos.");
            $("#callback").css("color","red");
        }               

    });
}


function modifyAssociation()
{
    $.post($("#submit3").attr("action"),$("#submit3").serialize(), 
    function(data, status)
    {

        if(data == '1')
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
        }
        else
        {
            $("#callback").text("Es probable que este nombre de asociación o de la sigla ya exista y por lo tanto no puede agregarse.");
            $("#callback").css("color","red");
        }
              

    });
}







//Los siguientes 3 métodos optimizan las consultas por medio de ajax a la base de datos.

function evaluateOnclickPenciModify(){

    if($("#addHeadquartersBtn").attr("class") == "glyphicon glyphicon-pencil btn btn-primary collapsed")
    {
        loadHeadquarterData();
    }
    
};

function evaluateOnchangeSelect(){

    if($("#addHeadquartersBtn").attr("class") == "glyphicon glyphicon-pencil btn btn-primary")
    {
        loadHeadquarterData();
    }
    
};

function loadHeadquarterData()
{
    var path = $('#submit4').attr('action');

    path = path.replace('verify','get_information');


    $.post(path,$("#submit3").serialize(), 

    function(data, status)
    {

        if(data != "")
        {
            var array_data = data.split(",");

            $("#headquarter_name").val(array_data[1]);
            $("#image_name").val(array_data[0]);

        }
        else
        {
            $("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
            $("#callback").css("color","#01DF01");
        }               

    })
}



function deleteHeadquarter()
{
    var path = $('#submit4').attr('action');

    path = path.replace('verify','deleteHeadquarter');

    $.post(path,$("#submit4").serialize(), 
    function(data, status)
    {
        if(data == "1")
        {
            $("#callback").text("¡Se eliminaron los datos con éxito!");
            $("#callback").css("color","#58ACFA");

            setTimeout(function(){location.reload();},1000);

        }
        else
        {
            $("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
            $("#callback").css("color","#01DF01");
        }               

    });

}

function modifyHeadquarter()
{
    var path = $('#submit4').attr('action');

    path = path.replace('verify','modifyHeadquarter');


    $.post(path,$("#submit4").serialize(), 
    function(data, status)
    {

        if(data == "1")
        {
            $("#callback").text("¡Los datos se actualizaron con éxito!");
            $("#callback").css("color","#58ACFA");
            
            setTimeout(function(){location.reload();},1000);
        }
        else
        {
            $("#callback").text("Lo sentimos. Es probable que el nombre de esta sede ya exista y por lo tanto no pudo guardarse en la base de datos.");
            $("#callback").css("color","red");
        }               

    });

}

function addInitialAmounts()
{
//TODO: Agregar el id al url, para guardar el monto en la asociación correspondiente
 var xhttp = new XMLHttpRequest();
    
    
        xhttp.onreadystatechange = function()
        {
    
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
                document.getElementById("callback").innerHTML = xhttp.responseText;
               setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 25000);
             
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
        
        

        
         //Con esto obtengo la direccion relativa a la computadora en la que estoy
         var path = location.pathname;
         path = path.substring(0,path.length)+"/"+document.getElementById("associations").value;
        
        
        xhttp.open("POST", path,true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send($("#submit_add_initial_amount").serialize());
        document.getElementById("callback").innerHTML = "Su transacción se está procesando...";
       

}



function transferSavingAccount()
{

    var xhttp = new XMLHttpRequest();


    xhttp.onreadystatechange = function()
    {

        if(xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("callback").innerHTML = xhttp.responseText;
            setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 25000);

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




    //Con esto obtengo la direccion relativa a la computadora en la que estoy
    var path = location.pathname;
    path = path.substring(0,path.length)+"/"+document.getElementById("associations").value;


    xhttp.open("POST", path,true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send($("#submit_add_saving_account").serialize());
    document.getElementById("callback").innerHTML = "Su transacción se está procesando...";

}



function addAmounts()
{
//TODO: Agregar el id al url, para guardar el monto en la asociación correspondiente
 var xhttp = new XMLHttpRequest();
    
    
        xhttp.onreadystatechange = function()
        {
    
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {

               document.getElementById("callback").innerHTML = xhttp.responseText;
               setTimeout(function(){document.getElementById("callback").innerHTML = "";}, 9000);
             
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
        
        
        
         //Con esto obtengo la direccion relativa a la computadora en la que estoy
         var path = location.pathname;
         path = path.substring(0,path.length)+"/"+document.getElementById("associations").value;
        
    

        
        
        
        xhttp.open("POST", path,true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send($("#submit5").serialize());
       

}

function getAssociationId()
{
    var xhttp = new XMLHttpRequest();
    var respo;
    
        xhttp.onreadystatechange = function()
        {
    
            if(xhttp.readyState == 4 && xhttp.status == 200)
            {
                respo = xhttp.responseText;
             
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
        
        var path = location.pathname; //Con esto obtengo la direccion relativa a la computadora en la que estoy
        path = path.substring(0,path.length-4)+"/getAssociationId/"+document.getElementById("associations").value;

        //path = path.replace("add","getAssociationId/"+document.getElementById("associations").value);
        xhttp.open("GET", path,false);
        //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();  
        
        return respo;
}




function addTract()
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


function confirmAction()
{
    var href = $('#associations').attr('href');

    href = href.split('/');

    found = false;
    index = (href.length - 1)

    while((index >= 0) && !found)
    {
        if(href[index] == 'delete')
        {
            found = true;
        }
        else
        {
            --index;
        }
    }

    if(href[index] == 'delete')
    {
        var action = confirm('¿Realmente desea realizar esta acción?');

        if(action == false)
        {
            $('#associations').attr('href','/soft/associations/');
        }
    }

}

//El siguiente Script es para los tooltips

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


$(document).ready( function(){
    if(!Modernizr.inputtypes.date)
    {           
        $('#date').datepicker();            
        $('#deadline').datepicker();  
    }        
});


//El siguiente script es para cargar las sedes y asociaciones que partenencen en esa sede. Esto en un dropdown


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
    
        xhttp.open("GET", "/soft/amounts/getAssociations/"+document.getElementById("headquarter_id").value,true);
        //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
       
    }
    

    function changeAssociation()
    {
        document.getElementById("association_name").innerHTML = document.getElementById("associations").value;
    }
    
    
