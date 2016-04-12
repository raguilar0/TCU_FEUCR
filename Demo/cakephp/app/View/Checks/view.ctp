<!DOCTYPE html>
<html>

<head>
    <title>Cat�logo de la tienda</title>
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

    <?php $number=0;
    if(isset($items)){
	echo '<br>&nbsp'.$this->Html->link('Volver', array('controller' => 'checks', 'action' => 'index'));
	echo '<br><br><div align="center"><H3>Factura #'.$check['Check']['id'].' &nbspTotal: $'.$check['Check']['amount'].' &nbspVendido el: '.$check['Check']['sold_the'].'</H3></div><br>';
	echo '<br><div align="center">Direccion de envio: '.$address.'</div><br>';
	foreach($products as $product){ ?>
			<div id="simple">
            <tr>
                <div id="info">
                    <?php echo $this->Html->image($product['Product']['image'], array('title' => $product['Product']['name'],'style'=> "height:60%;width:60%;"));?>
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <p><?php echo 'Precio: $'.$items[$number]['CheckProduct']['prize']; ?>
                    <?php
                        if($product['Product']['discount']!=0){
                            echo '<br>Descuento: '.$items[$number]['CheckProduct']['discount'].'%';
                        }
                    ?>
					<?php echo '<br>Unidades: '.$items[$number]['CheckProduct']['quantity']; ?>
					</p>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                    </td>
                    <div>&nbsp;</div>
                </div>
            </tr>
        </div>
	<?php $number++;
	}

	}else{
	     echo 'Acceso no autorizado<br>';
	}

	?>
</div>

</body>
</html>