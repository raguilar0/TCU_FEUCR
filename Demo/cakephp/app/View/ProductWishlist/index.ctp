<!DOCTYPE html>
<html>
<head>
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

            #product
            {
                width:40%;
                background-color: #fff;
                border:solid 1px #dcdcdc;
                padding:10px;
            }

            #info
            {
                width:100%;
                text-align: center;

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

<?php foreach ($ProductWishlistList as $pw): ?>
            <div id="product">
            <tr>
                 <div id="info">
                    <?php echo $this->Html->image($pw['Product']['image'], array('style'=> "height:60%;width:60%;"));?>
                    <h3><?php echo $pw['Product']['name']; ?></h3>
                    <p><?php echo 'Precio: $'.$pw['Product']['price']; ?></p>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $pw['Product']['id'])); ?>
                    </td>
                    <td id="small">
                        <?php echo $this->Form->postLink('Añadir al carrito',array('action' => 'agregarCarrito',$pw['Product']['id']));?>
                    </td>
					<td id="small">
                        <?php echo $this->Form->postLink('Eliminar de la Lista',array('controller'=>'productwishlist','action' => 'delete',$pw['Product']['id']));?>
                    </td>
          		    <div>&nbsp;</div>
                 </div>
            </div>
            </tr>
<?php endforeach; ?>
<?php unset($ProductWishlistList); ?>
</body>
</html>
