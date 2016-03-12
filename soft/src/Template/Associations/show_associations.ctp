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

<script >
	$(document).ready(function(){
	$(".glyphicon-trash").click(function(){
		var action = confirm("¿Realmente desea borrar esta Asociación?");

		if(action == false)
		{
			$(".glyphicon-trash").attr('href','./showAssociations');
		}


	});
});
</script>