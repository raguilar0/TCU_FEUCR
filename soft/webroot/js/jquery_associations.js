$('#submit1').submit(function(e){
    e.preventDefault();
    modifyAssociation();
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
