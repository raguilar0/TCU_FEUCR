<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de la tienda</title>
    <style>

        #container
        {
            width:100%;
            height:100%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #product
        {
            width:70%;
            height:1000px;
            display:inline;
            float: left;
            margin:5px;
            background-color: #fff;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        .categories
        {
            width:25%;
            display:block;
            float: right;
            margin:5px;
            background-color: #fff;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #simple
        {
            float:left;
            width:250px;
            height:350px;
            background-color:#fff;
            border:solid 0px #dcdcdc;
            padding:10px;
            margin:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
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

        table tr td
        {
            padding: 6px;
            text-align: left;
            vertical-align: top;
            border-bottom:0px solid #ddd;
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

<div id="container">

    <div id="product">
        <?php foreach ($results as $product): ?>
        <div id="simple">
            <tr>
                 <div id="info">
                    <?php echo $this->Html->image($product['Product']['image'], array('title' => $product['Product']['name'],'style'=> "height:60%;width:60%;"));?>
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <p><?php echo 'Precio: $'.$product['Product']['price']; ?></p>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                    </td>
                    <td id="small">
                        <?php echo $this->Form->postLink('Añadir al carrito',array('action' => 'agregarCarrito',$product['Product']['id']));?>
                    </td>
                    <?php
                        if($this->Session->read('Auth.User.administrator')!=null)
                        {
                                echo "<br>";
                                echo $this->Html->link('Editar',array('action' => 'edit', $product['Product']['id']));
                                echo " ";
                                echo $this->Form->postLink('Eliminar',array('action' => 'delete', $product['Product']['id']),array('confirm' => '¿Está seguro?'));
                        }
                    ?>
                 </div>
            </tr>
        </div>
        <?php endforeach; ?>
        <?php unset($product); ?>
    </div>

    <div class="categories">
    <table id='categorytree' style="width:100%">
        <h1>Categorías</h1>
        <?php foreach ($categorylist as $key => $value): ?>
            <p>
                <a><?php echo $this->Html->link($value, array('controller' => 'products', 'action' => 'search', $value)); ?></a>
            </p>
            <?php endforeach; ?>
            <?php unset($categorylist); ?>
        </table>
    </div>

</div>
</body>
</html>