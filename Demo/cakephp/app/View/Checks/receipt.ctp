<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de la tienda</title>
    <style>

        body
        {
            background: #151515;
        }

        #contenedor
        {
            margin-left: auto;
            margin-right: auto;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #simple
        {
            float:left;
            width:60%;
            background-color:#fff;
            border:solid 1px #dcdcdc;
            padding:10px;
            margin:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
        }

        #info
        {
            float: right;
            display: inline;
            width:420px;
        }

        #info h3
        {
            font-family: Helvetica, Geneva;
            color: #56BBAC;
        }

        #info p
        {
            padding-bottom:10px
        }

    </style>
</head>

<body>

<?php if($this->Session->read("Auth.User.role") == 'admin')
      {
        include("headeradmin.ctp");
      }
      else
      {
        include("header.ctp");
      }
?>

<div id="contenedor">

    <?php
        if(isset($idCheck)){
			echo '<br><div align="center"><H3>FACTURA #: '.$idCheck.'</H3><H4>Total facturado: '.$finalPrice.'$</H4>';
			echo '<br><br><b>DIRECCION DE ENVIO:</b> '.$direccion.'</div>';
			echo '<div id="simple">
					<br><br><div align="center">¡GRACIAS POR SU COMPRA!</div><br><br>
				</div>';
		}else{
			echo '<br><div align="center"><H3>LO SENTIMOS!</H3><br><b>FONDOS INSUFICIENTES O LA TARJETA HA EXPIRADO!</b></div><br>';
		}
	?>

</div>
</body>
</html>