


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



    echo $this->Form->end();
?>

<button id="asso_id" class="form-control">Actualizar Datos</button>

<div class="row text-right">
	<div class="col-xs-12">
		<h4 id="callback" style="color:#01DF01"></h4>	
	</div>

</div>

<script>
$(document).ready(function(){
	$("#asso_id").click(function(){
		$.post($("form").attr("action"),$("form").serialize(), 
			function(data, status)
			{
				if(data == "1")
				{
					$("#callback").text("¡Los datos se actualizaron con éxito!");
					$("#callback").css("color","#01DF01");
					$("input").css("background-color","white");
				}
				else
				{
					if($("#name").val() == "")
					{
						$("#name").css("background-color","#FA5858");
					}

					if($("#acronym").val() == "")
					{
						$("#acronym").css("background-color","#FA5858");
					}

					if($("#location").val() == "")
					{
						$("#location").css("background-color","#FA5858");
					}

					$("#callback").text("Debe llenar el o los campos en rojo");
					$("#callback").css("color","red");
				}				

			}
		);

	});
});
</script>