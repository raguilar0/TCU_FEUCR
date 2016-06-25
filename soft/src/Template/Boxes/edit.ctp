<div class="row text-center">
	<div class="col-xs-12">
		<h1>¡Modificá cajas!</h1>
	</div>
</div>

<br>

<div class="boxes form large-9 medium-8 columns content">
    <?= $this->Form->create($box) ?>
        <div class="form-group">
        <?php   
            
            echo "<div class = 'row'>";
                echo "<div class = 'col-xs-12 col-md-6'>";
                    echo "<h4>".$this->Form->input('little_amount', ['class' => 'form-control','label'=>'Caja Chica', 'min'=> '0'])."</h4>";
    	        echo "</div >";
    	        echo "<div class = 'col-xs-12 col-md-6'>";
                    echo "<h4>".$this->Form->input('big_amount', ['class' => 'form-control','label'=>'Caja Fuerte', 'min'=> '0'])."</h4>";
    	        echo "</div >";
    	    echo "</div >";
    	     echo "<div class = 'row'>";
                echo "<div class = 'col-xs-12 col-md-6'>";
                    echo "<h4>".$this->Form->input('association_id', ['options' => $associations,'class' => 'form-control','label'=>'Asociación', 'min'=> '0'])."</h4>";
    	        echo "</div >";
    	        echo "<div class = 'col-xs-12 col-md-6'>";
                    echo "<h4>".$this->Form->input('tract_id', ['options'=>$tracts,'class' => 'form-control','label'=>'Tracto', 'min'=> '0'])."</h4>";
    	        echo "</div >";
    	    echo "</div >";    
    	    
        ?>
        </div>
    <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?= $this->Form->end() ?>
</div>
