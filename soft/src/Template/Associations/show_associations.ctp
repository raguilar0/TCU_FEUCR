<div class = 'row text-center'>
    <div class='col-xs-12'>
<h1>Elegí una Sede y posteriormente una Asociación</h1>
    </div>
</div>

<br>
<br>



<?php

	$link = $data['link'];

	unset($data['link']);

	$counter = 0;
	
	
	foreach ($data as $key => $value) {

		if(($counter % 12) == 0)
		{
			echo "<div class = 'row'>";
		}

		echo "<div class = 'col-xs-12 col-md-4 colSedes'>";

		echo "<button data-toggle='collapse' class='btn btn-info' data-target='#id".$counter."'>".$key."</button>";
		echo "<div id = 'id".$counter."'class='collapse'>";
			for ($i=0; $i < count($data[$key]); $i++) { 
			 	
				echo "<h4>";
				echo $this->Html->link($data[$key][$i]['name'], '/associations/'.$link."/".$data[$key][$i]['id'], ['onclick'=>'confirmAction()', 'id'=>'associations']);
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

<br>
<br>


<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations/', ['class'=>'btn btn-primary']);?>
  </div>
</div>