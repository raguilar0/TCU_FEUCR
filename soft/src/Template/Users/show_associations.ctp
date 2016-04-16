<div class = 'row text-center'>
    <div class='col-xs-10'>
		<h1>Elegí una Sede y luego una Asociación</h1>
    </div>
</div>

<br>
<br>



<?php

	$link = $data['link'];

	unset($data['link']);

	$counter = 0;
	$last = "";
	$div = "";



	foreach ($data as $key) {

		if(($counter % 12) == 0)
		{
			echo "<div class = 'row text-center'>";
		}


		if($last != $key['name'])
		{
			echo $div;
			echo $div;
			echo "<div class = 'col-xs-12 col-md-4 colSedes'>";
			echo "<button data-toggle='collapse'  class=' btn btn-info' data-target='#id".$counter."'> ".$key['name']."</button>";
			echo "<div id = 'id".$counter."'class='collapse'>";

			$div = "</div>";
			$div = "</div>";

			$last = $key['name'];
			$counter += 4;
		}

		echo "<h4>";
		echo $this->Html->link($key['a']['name'], '/users/'.$link."/".$key['a']['id'], ['onclick'=>'confirmAction()', 'id'=>'associations']);
    //echo "key[id] en show associations".debug($key['a']['id']);
    echo "</h4>";

		if(($counter % 12) == 0)
		{
			echo "</div>";
		}
	}

	if(isset($data[0]))
	{
		echo "</div>";
		echo "</div>";
	}
	else
	{
		echo "<h2> No hay asociaciones registradas.</h2>";
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
     <?php echo $this->Html->link('Atrás', '/users/', ['class'=>'btn btn-primary']);?>
  </div>
</div>
