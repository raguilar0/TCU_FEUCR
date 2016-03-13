<h1 style="text-align:center;">Elegí una Sede y posteriormente una Asociación</h1>

<div class="row text-center addBtn">
	<div class="col-xs-12">
	<?php echo $this->Html->link('Agregar Asociación','/associations/add/',['class'=>'btn btn-danger']);?>
	</div>
</div>

<?php

	$counter = 0;
	
	foreach ($data as $key => $value) {

		if(($counter % 12) == 0)
		{
			echo "<div class = 'row'>";
		}

		echo "<div class = 'col-xs-12 col-md-4 colSedes'>";

		echo "<button data-toggle='collapse' class='btn btn-primary' data-target='#id".$counter."'>".$key."</button>";
		echo "<div id = 'id".$counter."'class='collapse'>";
			for ($i=0; $i < count($data[$key]); $i++) { 
			 	
				echo "<h4>";
				echo $data[$key][$i]['name']." ";

				echo "</h4>";
				
			 }

		echo "</div>";

		echo "</div>";

		$counter += 4;

		if(($counter % 12) == 0)
		{
			echo "</div>";
		}



	}

	if(($counter % 12) != 0)
	{
		echo "</div>";
	}


?>