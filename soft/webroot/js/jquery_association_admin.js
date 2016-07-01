

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





$(document).ready( function(){
    if(!Modernizr.inputtypes.date)
    {           
        $('#date').datepicker();            
        $('#deadline').datepicker();  
    }        
});

    
    
