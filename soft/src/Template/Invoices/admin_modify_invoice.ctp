<div class="row text-center">
  <div class="col-xs-12">
    <h1>Modificar factura</h1>
  </div>
</div>

<br>

<?php
  //debug($data);
  echo $this->Form->create($data, ['enctype'=>'multipart/form-data']);
  echo "<div class='form-group'>";




    echo "<div class = 'row'>";

      echo "<div class = 'col-xs-12 col-md-4'>";
       echo "<h4>".$this->Form->input('number', ['class' => 'form-control','label'=>'Número de Factura','value'=>$data['number'], 'maxlength'=> '20', 'placeholder'=>'Ejemplo: MJ5-5'])."</h4>";
      echo "</div >";


      echo "<div class = 'col-xs-12 col-md-4'>";
       echo "<h4>".$this->Form->input('amount', ['class' => 'form-control','label'=>'Monto','value'=>$data['amount'], 'placeholder'=>'Monto de la factura'])."</h4>";
      echo "</div >";


    echo "<div class = 'col-xs-12 col-md-4'>";
    echo "<label for='sel1' id = 'tipos_label'>Tipo</label>";
       echo "<select class='form-control' name = 'kind'>";

            $kind = $options['invoices_type'];
            foreach ($kind as $key => $value) {
                  echo "<option>".$key."</option>"."<br>";
            }

        echo "</select>";
    echo "</div>";
  echo "</div >";



    echo "<div class = 'row'>";
    
      echo "<div class = 'col-xs-12 col-md-4'>";
       echo "<h4>".$this->Form->input('legal_certificate', ['class' => 'form-control','label'=>'Cédula Juridica', 'value'=>$data['legal_certificate'],'maxlength'=> '12', 'placeholder'=>'Ejemplo: 1-234-567890'])."</h4>";
      echo "</div >";

      echo "<div class = 'col-xs-12 col-md-4'>";
       echo "<h4>".$this->Form->input('provider', ['class' => 'form-control','label'=>'Proveedor','value'=>$data['provider'], 'maxlength'=> '100', 'placeholder'=>'Ejemplo: PriceSmart'])."</h4>";
      echo "</div >";

     echo "<div class = 'col-xs-12 col-md-4'>";
        	echo "<label for = 'date'>Fecha</label>";
        	echo "<input type='date' name = 'date' class = 'form-control' id = 'date'>";
	  echo "</div >";


  echo "</div >";
  echo "<div class = 'row'>";

      echo "<div class = 'col-xs-12 col-md-4'>";
       echo "<h4>".$this->Form->input('attendant', ['class' => 'form-control','label'=>'Responsable', 'value'=>$data['attendant'],'maxlength'=> '100', 'placeholder'=>'Ejemplo: Andrey Pérez'])."</h4>";
      echo "</div >";

  echo "</div >";


   echo "<div class = 'row'>";

      echo "<div class = 'col-xs-12'>";
       echo "<h4>".$this->Form->input('detail', ['class' => 'form-control','label'=>'Detalles','value'=>$data['detail'], 'maxlength'=> '1024', 'type'=>'textarea'])."</h4>";
      echo "</div >";

      echo "<div class = 'col-xs-12'>";
       echo "<h4>".$this->Form->input('clarifications', ['class' => 'form-control','label'=>'Aclaraciones','value'=>$data['clarifications'], 'maxlength'=> '1024', 'type'=>'textarea'])."</h4>";
      echo "</div >";

  echo "</div >";
    
    echo "<div class = 'row'>";

        echo "<div class = 'col-xs-12'>";
            echo $this->Form->checkbox('state', ['hiddenField' => false, 'class'=>'checkbox-inline', 'id'=>'id_state'])."</h4>";
            echo "<label for='id_state'>Aprobada</label>" ;
        echo "</div >";

    echo "</div >";

    echo  "<div class='row text-center'>";
        echo "<div class = 'col-xs-12'>";   
        echo "<h4>".$this->Form->submit('Modificar factura', ['class'=>'btn btn-primary', 'id' => 'invoice_id'])."</h4>";
        echo "</div>";

    echo  "</div>";

    echo $this->Form->end();

?>

<br>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01">
          <?= $this->Flash->render('success') ?></h4>
    </div>
</div>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#FF0000">
          <?= $this->Flash->render('error') ?></h4>
    </div>
</div>


<div class="row text-right">
  <div class="col-xs-12">
    <p id="callback" style="font-size:20px"></p>
  </div>
</div>
