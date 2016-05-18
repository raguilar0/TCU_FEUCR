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

    <br><div align="center"><H3>Ítemes a comprar: </H3></div>
    <div id="simple">
        <?php $number=0;
        $total=0;
        $totalConDesc=0;
		$totalConImp = 0;
        foreach ($cart as $key => $product ):
            $cantidad=$this->Session->read('CartQty.'.$number);
            $number++;
        ?>
            <tr>
				 <?php echo $this->Html->image($product['Product']['image'], array('style'=> "width:200px;height:200px;")); ?>
                 <div id="info">
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <p><?php echo 'Precio: '.$product['Product']['price'].'$'; ?></p>
                        <?php
                        $subtotal=$cantidad*$product['Product']['price'];
                        $total=$total+$subtotal;
                        echo 'Cantidad: '.$cantidad.'<br>Precio subtotal: '.$subtotal.'$';
                        if($product['Product']['discount']!=0){
                            $subtotal=$subtotal*(100-$product['Product']['discount'])/100;
                            echo '<br>Descuento: '.$product['Product']['discount'].'%<br>Precio con Descuento: '.$subtotal.'$';
                        }
                        $totalConDesc = $totalConDesc+$subtotal;
						if($product['Product']['tax']!=0){
                            $subtotal=$subtotal*(100+$product['Product']['tax'])/100;
                            echo '<br>Impuesto: '.$product['Product']['tax'].'%<br>Precio con Impuesto: '.$subtotal.'$<br>';
                        }
						$totalConImp = $totalConImp + $subtotal;
						$valorFinal = $totalConImp;
						?>
                 </div>
            </tr>
        <?php endforeach; ?>
        <?php unset($product); ?>
        <?php
			$valorFinal = $valorFinal + $sendCost;
            echo '<br><br><br><p><div align="right">Direccion de envio: '.$direccion.'<br>';
			echo '<b>Costo de envío:</b> '.$countryName.' : '.$sendCost.'$<br><b>Precio total de la compra: </b>'.$total.'$<br><b>Precio total con descuentos: </b>'.$totalConDesc.'$<br><b>Precio total con impuestos: </b>'.$totalConImp.'$<br><b>Total con envio: </b>'.$valorFinal.'$<br><br>';
            echo $this->Form->create('Check',array('action'=>'receipt'));
			echo $this->Form->input('id', array('type' => 'hidden'));
            echo $this->Form->input('debcard', array('title' => 'Pago', 'type' => 'select', 'options' => $debitcards, 'empty' => 'Seleccione su método de pago', 'label' => 'Método de pago: '));
			echo '<br>';
			//echo $this->Form->input('address', array('title' => 'Direccion de Envio', 'type' => 'select', 'options' => $address, 'empty' => 'Seleccione su direccion de envio', 'label' => 'Direccion de envio: '));
			//echo '<br>';
			echo $this->Form->input('amount', array('type' => 'hidden', 'default' => $valorFinal));
			echo $this->Form->input('address', array('type' => 'hidden', 'default' => $address));
			echo '<br><br>';
            echo $this->Form->end("COMPRAR");
            echo '</div></p>';
        ?>
    </div>

</div>
</body>
</html>