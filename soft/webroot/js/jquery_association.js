$('form').submit(function(e){
    e.preventDefault();
    ajaxRequest();
});

function ajaxRequest()
{
    $.post($("form").attr("action"),$("form").serialize(), 
    function(data, status)
    {
        if(status == "success")
        {
            $("#callback").text("¡Los datos se guardaron con éxito!");
            $("#callback").css("color","#01DF01");
            $("input").css("background-color","white");
        }
        else
        {
            $("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
            $("#callback").css("color","#01DF01");
            $("input").css("background-color","white");
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