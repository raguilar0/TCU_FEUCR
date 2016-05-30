<!DOCTYPE html>
<html>
<head>
    <style>
        #container
        {
            width:100%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        .datos
        {
            width:50%;
            margin:0 auto;
            margin-top:2%;
            background-color: #fff;
            color: black;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #registro input
        {
            float:right;
        }

        #registro textarea
        {
             float:right;
        }

        table, td {
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px;
        }

    </style>
</head>

<body>



<div id="container">
    <div class="datos">

    <h3>Mis Tarjetas</h3>

    <table style="width:100%">
         <tr>
            <td>
                <a><?php echo "Nombre: "; ?></a>
         </td>
         <td>
             <?php echo $name." ".$lastname; ?>
             <td>
         </tr>

         <tr>
            <td>
                <a><?php echo $this->Html->link("Mis tarjetas de Debito",array('controller' => 'debitcard', 'action' => 'index')); ?></a>
            </td>
        </tr>
        <tr>
            <td>
                <a><?php echo $this->Html->link("Mis tarjetas de Credito",array('controller' => 'creditcard', 'action' => 'index')); ?></a>
            </td>
        </tr>
    </table>

    <br>
   </div>
</div>

</body>
</html>