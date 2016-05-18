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

    <h3>Estado de Cuenta de Tarjeta</h3>

    <table style="width:100%">
         <tr>
            <td>
                <a><?php echo "Nombre: "; ?></a>
         </td>
         <td>
             <?php echo $name." ".$lastname; ?>
             <td>
         </tr>

        <?php foreach ($data as $d): ?>
        <tr>
            <td>
                <a><?php echo "Numero de Tarjeta: "; ?></a>
            </td>
            <td>
                <?php echo $d['Creditcard']['card_number']; ?>
            <td>
        </tr>
        <tr>
            <td>
                <a><?php echo "Saldo: "; ?></a>
            </td>
            <td>
                <?php echo $d['Creditcard']['balance'];  ?>
            </td>
        </tr>
        <tr>
             <td>
               <a><?php echo "Vencimiento: "; ?></a>
             </td>
             <td>
                  <?php echo $d['Creditcard']['expiration_date'];  ?>
             </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($data); ?>
    </table>

    <br>
   </div>
</div>

</body>
</html>