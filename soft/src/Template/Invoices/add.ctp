<div class="row text-center">
	<div class="col-xs-12">
		<h1>¡Agregá una factura!</h1>
	</div>
</div>

<br>

<?php

	echo $this->Form->create($data, ['id'=>'submit2']);
	echo "<div class='form-group'>";




    echo "<div class = 'row'>";

	    echo "<div class = 'col-xs-12 col-md-4'>";
	     echo "<h4>".$this->Form->input('number', ['class' => 'form-control','label'=>'Número de Factura', 'maxlength'=> '20', 'placeholder'=>'Ejemplo: MJ5-5'])."</h4>";
	    echo "</div >";


	    echo "<div class = 'col-xs-12 col-md-4'>";
	     echo "<h4>".$this->Form->input('amount', ['class' => 'form-control','label'=>'Monto', 'placeholder'=>'Monto de la factura'])."</h4>";
	    echo "</div >";


    echo "<div class = 'col-xs-12 col-md-4'>";

    echo "<label for='sel1' id = 'tipos_label'>Tipo</label>";
       echo "<select class='form-control' name = 'kind' >";

            $kind = $data['invoices_type'];

            foreach ($kind as $key => $value) {
                echo "<option>".$value."</option>"."<br>";
            }
            
        echo "</select>";
    echo "</div>";
  
	echo "</div >";    



    echo "<div class = 'row'>";

	    echo "<div class = 'col-xs-12 col-md-6'>";
	     echo "<h4>".$this->Form->input('provider', ['class' => 'form-control','label'=>'Proveedor', 'maxlength'=> '100', 'placeholder'=>'Ejemplo: PriceSmart'])."</h4>";
	    echo "</div >";	      

	    echo "<div class = 'col-xs-12 col-md-6'>";
        	echo "<h4>".$this->Form->input('date', ['class' => 'form-control', 'label'=>'Fecha', 'type'=> 'date', 'id'=>'date_input'])."</h4>";
	    echo "</div >";    
    

	echo "</div >";  


   echo "<div class = 'row'>";

	    echo "<div class = 'col-xs-12'>";
	     echo "<h4>".$this->Form->input('detail', ['class' => 'form-control','label'=>'Detalles', 'maxlength'=> '1024', 'type'=>'textarea'])."</h4>";
	    echo "</div >";

	    echo "<div class = 'col-xs-12'>";
	     echo "<h4>".$this->Form->input('clarifications', ['class' => 'form-control','label'=>'Aclaraciones', 'maxlength'=> '1024', 'type'=>'textarea'])."</h4>";
	    echo "</div >";

	echo "</div >";  



    echo "<div class = 'row'>";
        echo "<div class = 'col-xs-12'>";    echo "<h4>".$this->Form->submit('Guardar Factura', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
        echo "</div>";
    echo  "</div>";

    echo $this->Form->end();

?>
