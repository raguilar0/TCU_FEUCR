<h1>Agregue una nueva Asociación</h1>

<?php

	echo $this->Form->create($association);
	echo "<div class='form-group'>";
    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla'])."</h4>";
    echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación'])."</h4>";
    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización'])."</h4>";
    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario'])."</h4>";
    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";
    echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";
    echo "<h4>".$this->Form->submit('Guardar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";
    echo "</div>";

    echo $this->Form->end();
?>


<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>

<script >
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
                $("#callback").text("¡Los datos se guardaron con éxito!");
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