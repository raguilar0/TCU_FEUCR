
function getAssociations(path)
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


    xhttp.open("GET", path+"/"+document.getElementById("headquarter_id").value,true);

    xhttp.send();

}



function changeAssociation()
{
    document.getElementById("association_name").innerHTML = document.getElementById("associations").value;
}