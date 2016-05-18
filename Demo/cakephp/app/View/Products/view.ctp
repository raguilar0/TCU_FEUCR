<!DOCTYPE html>
<html>

<head>
    <title>Vista detalles</title>
    <style>

        body
        {
            background: #151515;
        }

        #container
        {
            margin-left: auto;
            margin-right: auto;
            background-color: #FFFFFF;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #product
        {
            float:left;
            width:1000px;
            margin-left: auto;
            margin-right: auto;
            border:solid 1px #dcdcdc;
            padding-top:10px;
            padding-left:10px;
            padding-right:10px;
            padding-bottom:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
        }
		#wl{
        	float: right;
        	border: 1px solid #CCC;
        	padding-left: 10px;
            padding-top: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            margin-left: auto;
            margin-right: 20px;
            margin-top: 20px;
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
	
		<div id="wl">
			<?php
            if($in_list == '1'){
                echo $this->Html->link("Quitar de la WishList",array('controller'=>'productwishlist', 'action' =>'delete',$product['Product']['id']))."<br>";

            }
            else {
                echo $this->Html->link("Añadir a WishList",array('controller'=>'productwishlist', 'action' =>'add',$product['Product']['id']))."<br>";
            }

			?>
			<?php echo $this->Form->postLink('Añadir al carrito',array('action' => 'agregarCarrito',$product['Product']['id'],$product['Product']['price']*(100-$product['Product']['discount'])/100));?>
        </div>

        <h3><?php echo "Nombre del videojuego: ". $product['Product']['name']; ?></h3>
		
		<p><b>Plataforma: </b><?php echo $platform['Platform']['name']; ?></p>

        <p><b>Año de lanzamiento: </b><?php echo $product['Product']['release_year']; ?></p>
		
		<p><b>Requerimientos: </b><?php echo $product['Product']['requirement']; ?></p>

        <p><b>Precio: $ </b><?php echo $product['Product']['price']; ?></p>

        <?php
             if($product['Product']['discount']!=0){
                echo '<p><b>Descuento: </b>'.$product['Product']['discount'].'%</p>';
             }
        ?>
		
		 <?php
             if($product['Product']['tax']!=0){
                echo '<p><b>Impuesto: </b>'.$product['Product']['tax'].'%</p>';
             }
        ?>

        <p><b>Descripción: </b><?php echo $product['Product']['description']; ?></p>

        <p><b>Formato: </b>
                <?php
                     $p = $product['Product']['description'];
                     if($p != null){
                        if($p == 0)
                            echo 'Físico';
                        if($p == 1)
                            echo 'Digital';
                     }
                ?>
        </p>

        <p><b>Público: </b>
                <?php
                    $r = $product['Product']['rated'];
                    if($r != null){
                        if($r == 0)
                            echo 'early childhood';
                        if($r == 1)
                            echo 'everyone';
                        if($r == 2)
                            echo 'everyone 10+';
                        if($r == 3)
                            echo 'teen';
                        if($r == 4)
                            echo 'mature';
                        if($r == 5)
                            echo 'adults only';
                        if($r == 6)
                            echo 'rating pending';
                        if($r == 7)
                            echo 'kids to adults';
                    }else{
                        echo 'No asignado.';
                    }

                ?>
        </p>

		<p><b>Categorías: </b>
			 
				<?php foreach ($categories as $cat): ?>
					<tr>
						 <div id="info">
							<p> <?php echo "   ". $cat; ?> </p>
						 </div>
					</tr>
				<?php 
					endforeach; 
					unset($categories); 
				?>
		</p>
	
		<p><b>Cantidad en stock: </b><?php echo $cant['Stock']['amount']; ?></p>
		
        <!--
        <p> <?php //$linkImagen = $product['Product']['image']; ?></p>
        <img width="420" height="320" src= "<?php //echo $linkImagen; ?>" />
		-->
		
		<?php echo $this->Html->image($product['Product']['image'], array('style'=> "width:240px;height:128px;padding:10px;"));?>

        <p> <?php $linkVideo = $product['Product']['video']; ?></p>
        <iframe width="420" height="320" src="<?php echo $linkVideo; ?>" frameborder="0" allowfullscreen></iframe>

    </div>

</div>

</body>
</html>