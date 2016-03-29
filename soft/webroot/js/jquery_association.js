
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
   // modifyHeadquarter();
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
                $("#callback").text("Lo sentimos. Es probable que este nombre de asociación o de la sigla ya exista y por lo tanto no puede agregarse.");
                $("#callback").css("color","red");
            }
            else
            {            
                $("#callback").text("Lo sentimos. Algo salió mal al guardar los montos");
                $("#callback").css("color","red");
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
        if(data == "1")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
        }
        else
        {
            $("#callback").text("Lo sentimos. Es probable que este nombre de asociación o de la sigla ya exista y por lo tanto no puede agregarse.");
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

    $.post("/FEUCR/soft/headquarters/get_information",$("#submit3").serialize(), 

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
    $.post("/soft/headquarters/deleteHeadquarter",$("#submit4").serialize(), 
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
    $.post("/FEUCR/soft/headquarters/modifyHeadquarter",$("#submit4").serialize(), 
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