

$('#submit3').submit(function(e){
    e.preventDefault();
    modifyAssociation();
});



$('#submit1').submit(function(e){
    e.preventDefault();
    addAssociation();
});


$('#submit2').submit(function(e){
    e.preventDefault();
    addHeadquarter();
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

/
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
            $("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
            $("#callback").css("color","#01DF01");
        }               

    });
}

$(document).ready(function(){
    $(".glyphicon-trash").click(function(){
        var action = confirm("¿Realmente desea borrar esta Asociación?");

        if(action == false)
        {
            $(".glyphicon-trash").attr('href','./showAssociations');
        }


    });
});