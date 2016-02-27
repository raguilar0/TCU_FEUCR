<!DOCTYPE html>
<html>
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

<h5>Registrar una nueva entrada de category_product.</h5>
<h1></h1>
    <?php
        echo $this->Form->create('CategoryProduct');
        echo $this->Form->input('product_id', array('label'=>'Id de producto:', 'type' => 'select', 'options' => $products));
		echo $this->Form->input('category_id', array('label'=>'Id de wishlist:', 'type' => 'select', 'options' => $categories));
        echo $this->Form->end('Guardar');
    ?>
</body>
</html>
