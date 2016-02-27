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

    <?php echo '<br>'.$this->Html->link("Vaciar carrito",array('controller'=>'products','action'=>'vaciar')).'<br>' ;?>
    <div id="simple">
        <?php $number=0;
        $total=0;
        $totalConDesc=0;
        foreach ($cart as $key => $product ):
            $cantidad=$this->Session->read('CartQty.'.$number);
            $number++;
        ?>
            <tr>
				 <?php echo $this->Html->image($product['Product']['image'], array('style'=> "width:200px;height:200px;")); ?>
                 <div id="info">
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                    </td>
                    <td>
                         <?php
                             //remove product from a cart
                             echo $this->Html->link('Eliminar del carrito', array('action' => 'eliminarCarrito',$key));
                         ?>
                    </td>
                    <div>&nbsp;</div>
                    <p><?php echo 'Precio: '.$product['Product']['price'].'$'; ?></p>
                        <?php
                        $subtotal=$cantidad*$product['Product']['price'];
                        $total=$total+$subtotal;
                        echo 'Cantidad: '.$cantidad.'<br>Precio subtotal: '.$subtotal.'$';
                        if($product['Product']['discount']!=0){
                            $subtotal=$subtotal*(100-$product['Product']['discount'])/100;
                            echo '<br>Descuento: '.$product['Product']['discount'].'%<br>Precio con Descuento: '.$subtotal.'$<br>';
                        }
                        $totalConDesc = $totalConDesc+$subtotal;  ?>
                        <br>
                 </div>
            </tr>
        <?php endforeach; ?>
        <?php unset($product); ?>
        <?php
            echo '<p><div align="right"><b>Precio total de la compra: </b>'.$total.'$<br><b>Precio total con descuentos: </b>'.$totalConDesc.'$<br><br>';
            echo $this->Form->create("Checks",array('action' => 'check'));
			echo $this->Form->input('address', array('title' => 'Direccion de Envio', 'type' => 'select', 'options' => $address, 'empty' => 'Seleccione su direccion de envio', 'label' => 'Direccion de envio: '));
			echo '<br><br><br>';
            echo $this->Form->end("Realizar compra");
            echo '</div></p>';
        ?>
    </div>

</div>
</body>
</html>