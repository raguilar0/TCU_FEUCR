


<!--
<form class="form-inline">
	
	<input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre o la sigla de Asociación que desea buscar"></input>

</form>


<button type="submit" class="glyphicon glyphicon-search btn btn-primary" id="submit"></button>


<div id="datos">
	

</div>

-->


<h1>Acá podés <b>Modificar</b> la Asociación</h1>

<?php

	echo $this->Form->create($data);
	echo "<div class='form-group'>";
    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'value'=>$data['acronym']])."</h4>";

    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación', 'value'=>$data['name'], 'id'=>'name'])."</h4>";

    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización','value'=>$data['location']])."</h4>";

    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario','value'=>$data['schedule']])."</h4>";

    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";

    if($data['authorized_card'] == 0)
    {
    	echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";
    }
    else
    {
    	echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline', 'checked'])."</h4>";
    }


    echo "</div>";

 	echo "<h4>".$this->Form->submit('Actualizar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";

    echo $this->Form->end();
?>



<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>	
	</div>

</div>

<script>
	$('form').submit(function(e){
		e.preventDefault();
		ajaxRequest();
	});

	function ajaxRequest()
	{
			$.post($("form").attr("action"),$("form").serialize(), 
			function(data, status)
			{
				if(status == "success")
				{
					$("#callback").text("¡Los datos se actualizaron con éxito!");
					$("#callback").css("color","#01DF01");
					$("input").css("background-color","white");
				}
				else
				{
					$("#callback").text("Lo sentimos. Ocurrió un error inesperado. Inténtelo más tarde.");
					$("#callback").css("color","#01DF01");
					$("input").css("background-color","white");
				}				

			});
	}

</script>