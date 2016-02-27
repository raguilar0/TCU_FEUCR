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

        .productsform
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
    <div class="productsform">
    <fieldset id="registro">
        <legend><?php echo __('Editar producto'); ?></legend>
    <?php
		echo $this->Form->create('Product', array('type' => 'file'));
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('name', array('label' => 'Nombre del videojuego:'));
        echo "<br><br>";
        echo $this->Form->input('platform_id', array('type' => 'select', 'options' => $platforms, 'empty' => 'no seleccionada', 'label' => 'Plataforma:'));
        echo "<br><br>";
        echo $this->Form->input('Product.release_year', array(
            'type' => 'date',
            'dateFormat' => 'Y',
            'minYear' => date('Y') - 15,
            'maxYear' => date('Y'),
            'label' => 'Año de lanzamiento:',
            'empty' => 'no seleccionado',
			'name'=>"data[Product][release_year]"
        ));
        echo "<br><br>";
        echo $this->Form->input('price', array('label'=>'Price in dollars', 'default' => '0'));
        echo "<br><br>";
        echo $this->Form->input('description', array('rows' => '3', 'label'=>'Descripción del videojuego:'));
        echo "<br><br><br><br>";
        //amount es para insertar en stock
        echo $this->Form->input('amount', array('label'=>'Cantidad de producto (unidades):', 'type' => 'number', 'default'=>$cant['Stock']['amount']));
        echo "<br><br>";
        echo $this->Form->input('presentation', array('type' => 'select', 'options' => array('Físico', 'Digital'), 'label' => 'Formato de entrega:', 'empty' => 'no seleccionado'));
        echo "<br><br>";
        echo $this->Form->input('requirement', array('rows' => '3', 'label'=>'Requerimientos específicos:'))."<br><br>";
        echo "<br><br>";
        echo $this->Form->input('rated', array('type' => 'select', 'label'=>'Público:', 'options' => array('early childhood', 'everyone', 'everyone 10+','teen','mature','adults only','rating pending','kids to adults'), 'empty' => 'no seleccionado'));
        echo "<br><br>";
        echo $this->Form->input('discount',array('label'=>'Descuento de producto en %:','type'=>'number','default'=>$cant['Stock']['amount']));
        echo "<br><br>";
		echo $this->Form->input('tax',array('label'=>'Impuesto de producto en %:','type'=>'number','default'=>$cant['Stock']['amount']));
        echo "<br><br>";
        echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Seleccione un archivo de imagen:'));
        echo "<br><br>";
        echo $this->Form->input('video', array('rows' => '1', 'label'=>'Link de un vídeo:'));
    ?>
    </fieldset>
    <?php echo $this->Form->end('Guardar cambios'); ?>
    </div>
</div>
</body>
</html>