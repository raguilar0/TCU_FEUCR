
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



/**
$('#asso_id, #sede_id').click(function(){
    if(this.id == 'asso_id')
    {
        addAssociation();
    }
    else
    {
        if(this.id == 'sede_id')
        {
            addHeadquarter();
        }
        else
        {

        }        
    }
});

**/


function modifyAssociation()
{
    $.post($("#submit3").attr("action"),$("#submit3").serialize(), 
    function(data, status)
    {
        if(status == "success")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
        }
        else
        {
            $("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
            $("#callback").css("color","#01DF01");
        }               

    });
}

//Esta función sirve para agregar una asociación 
function addAssociation()
{
    $.post($("#submit1").attr("action"),$("#submit1").serialize(), 
    function(data, status)
    {

        if(status == "success")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
        }
        else
        {
            $("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
            $("#callback").css("color","#01DF01");
        }               

    });
}

//Este método sirve para agregar una sede
function addHeadquarter()
{
    $.post($("#submit2").attr("action"),$("#submit2").serialize(), 
    function(data, status)
    {

        if(status == "success")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
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

//Esta función sirve para modificar las Sedes

/**
function modifyHeadquarter()
{
    $.post($("#submit4").attr("action"),$("#submit4").serialize(), 
    function(data, status)
    {
        alert(data);

        if(data == "1")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
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
**/

//Este evento se dispara cuando se presiona el botón de basura de las asociaciones
$(document).ready(function(){
    $(".glyphicon-trash").click(function(){
        var action = confirm("¿Realmente desea borrar esta Asociación?");

        if(action == false)
        {
            $(".glyphicon-trash").attr('href','./showAssociations');
        }


    });
});



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
    $.post("/FEUCR/soft/headquarters/getInformation",$("#submit3").serialize(), 
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
    $.post("/FEUCR/soft/headquarters/deleteHeadquarter",$("#submit4").serialize(), 
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
            $("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
            $("#callback").css("color","#01DF01");
        }               

    });

}

function confirmAction()
{
    var href = $('#associations').attr('href');

    href = href.split('/');

    if(href[4] == 'delete')
    {
        var action = confirm('¿Realmente desea realizar esta acción?');

        if(action == false)
        {
            $('#associations').attr('href','/FEUCR/soft/associations/');
        }
    }

}