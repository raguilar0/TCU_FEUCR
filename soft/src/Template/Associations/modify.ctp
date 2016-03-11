


<!--
<form class="form-inline">
	
	<input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre o la sigla de Asociación que desea buscar"></input>

</form>


<button type="submit" class="glyphicon glyphicon-search btn btn-primary" id="submit"></button>


<div id="datos">
	

</div>

-->




<script>
$(document).ready(function(){
	$("#submit").click(function(){
		$.post("modify",$("#name").serialize(), 
			function(data, status)
			{
				$("#datos").text(data);
			}
		);

	});
});
</script>