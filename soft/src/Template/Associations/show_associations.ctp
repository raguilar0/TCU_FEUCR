<h1>Elije una Sede y posteriormente una Asociación</h1>


<?php

	echo $this->Html->link('Agregue una Asociación', '/associations/add')."<br>";

	foreach($data as $item)
	{
		echo $item['name'];

		echo $this->Html->link('','/associations/modify/'.$item['id'],['class'=>'glyphicon glyphicon-pencil']);

		echo $this->Html->link('','/associations/delete/'.$item['id'],['class'=>'glyphicon glyphicon-trash'])."<br>";

	}

	
?>