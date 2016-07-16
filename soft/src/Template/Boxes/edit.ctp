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
                    echo "<label> Caja chica </label>";
                    echo "<div class='input-group'>";
                        echo "<span class='input-group-addon' >₡</span>";
                            echo $this->Form->input('little_amount', ['class' => 'form-control','label'=>false, 'min'=> '0']);
                        echo "<span class='input-group-addon'>.00</span>";
                    echo "</div>";
    	        echo "</div >";



    	        echo "<div class = 'col-xs-12 col-md-6'>";
                    echo "<label> Caja fuerte </label>";
                    echo "<div class='input-group'>";
                        echo "<span class='input-group-addon' >₡</span>";
                            echo $this->Form->input('big_amount', ['class' => 'form-control','label'=>false, 'min'=> '0']);
                        echo "<span class='input-group-addon'>.00</span>";
                    echo "</div>";

    	        echo "</div >";
    	    echo "</div >";
    	    if(($this->request->session()->read('Auth.User.role')) == 'admin'){
    	     echo "<div class = 'row'>";
                echo "<div class = 'col-xs-12 col-md-6'>";
                    echo "<h4>".$this->Form->input('association_id', ['options' => $associations,'class' => 'form-control','label'=>'Asociación', 'min'=> '0'])."</h4>";
    	        echo "</div >";
    	        echo "<div class = 'col-xs-12 col-md-6'>";
                    echo "<h4>".$this->Form->input('tract_id', ['options'=>$data,'class' => 'form-control','label'=>'Tracto', 'min'=> '0'])."</h4>";
    	        echo "</div >";
    	      echo "</div >";
    	    }

        ?>
        </div>
    <?= $this->Form->button(__('Guardar'), ['class'=>'form-control', 'id'=>'asso_id']) ?>
    <?php $this->Form->end();

		if(($this->request->session()->read('Auth.User.role')) == 'admin'){
		echo "<br>";
		echo "<div class='row text-center'>";
			echo "<div class='col-xs-12'>";

						echo $this->Html->link(
						'Atrás',
						['controller' => 'Boxes', 'action' => 'index'], ['class'=>'btn btn-primary']
						);

			echo "</div>";
		echo "</div>";
		}

		if(($this->request->session()->read('Auth.User.role')) == 'rep'){
		echo "<br>";
		echo "<div class='row text-center'>";
		  echo "<div class='col-xs-12'>";

		        echo $this->Html->link(
		        'Atrás',
		        ['controller' => 'Boxes', 'action' => 'modify'], ['class'=>'btn btn-primary']
		        );

		  echo "</div>";
		echo "</div>";
		}?>



</div>
