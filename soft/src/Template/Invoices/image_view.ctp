<div class="row text-center">
  <div class="col-xs-12">
    <h1>Imagen de Factura</h1>
  </div>
</div>

<br>

<?php
  //debug($data);
  echo $this->Form->create($data, ['enctype'=>'multipart/form-data']);
  echo "<div class='form-group'>";
  
     echo "<div class = 'row'>";
        echo $this->Html->image('invoices/'.$data['image_name'], ['alt' => 'Imagen de Factura']);
     echo "</div>";
    
  echo "</div>";
  
  