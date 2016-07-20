function setTractNumber(element)
{
    var object = document.getElementById("tract_number");

    var val = new Date(element.value);
    val = val.getMonth();
    ++val;
    var number;

    if(val >= 1 && val <= 3)
    {
        number = 2;
    }
    else if(val >= 4 && val <= 6)
    {
        number = 3;
    }
    else if(val >= 7 && val <= 9)
    {
        number = 4;
    }
    else if(val >= 10 && val <= 12)
    {
        number = 1;
    }

    if((object.value.length < 1) || (object.value != number))
    {
        object.value = number;

        object.style = "border:2px solid #00FF80";
        setTimeout(function(){object.style = "background-color:white";},3000);
    }
    
}