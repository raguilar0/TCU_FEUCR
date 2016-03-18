<h1>¡Acá podés <b>agregar</b> una nueva Asociación!</h1>

<?php

	echo $this->Form->create($association, ['id'=>'submit1']);
	echo "<div class='form-group'>";




    echo "<div class = 'row'>";

    echo "<div class = 'col-xs-12 col-md-4'>";
     echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Asociación', 'maxlength'=> '256'])."</h4>";
    echo "</div >";

    echo "<div class = 'col-xs-6 col-md-4'>";

    echo "<div class='form-group'>";
    echo "<label for='sel1' id = 'sedes_label'>Sedes:</label>";
       echo "<select class='form-control' name = 'headquarter_id' >";

            $headquarter = $association['headquarter'];

            foreach ($headquarter as $key => $value) {
                echo "<option>".$value['name']."</option>"."<br>";
            }
            
        echo "</select>";
    echo "</div>";



    echo "</div >";    

    echo "<div class = 'col-xs-6 col-md-4'>";
      echo $this->Form->button('',['type'=>'button' ,'data-toggle'=>'collapse', 'data-target'=>'#form_headquarter', 'class'=>'glyphicon glyphicon-plus btn btn-success', 'id'=>'addHeadquartersBtn']);
    echo "</div >";


    echo "</div>";






    echo "<h4>".$this->Form->input('acronym', ['class' => 'form-control', 'label'=>'Sigla', 'maxlength'=> '256'])."</h4>";

   


    //echo "<h4>".$this->Form->input('headquarters', ['class' => 'form-control','label'=>'Sede', 'maxlength'=> '100'])."</h4>";

    echo "<h4>".$this->Form->input('location', ['class' => 'form-control','label'=>'Localización', 'maxlength'=> '1024'])."</h4>";

    echo "<h4>".$this->Form->input('schedule', ['class' => 'form-control','label'=>'Horario', 'maxlength'=> '512'])."</h4>";
    

    echo "<h4>".$this->Form->label('Associations.authorized_card','Tarjeta Autorizada ');
    echo "  ";
    echo $this->Form->checkbox('authorized_card', ['hiddenField' => false, 'class'=>'checkbox-inline'])."</h4>";

    echo "<h4>".$this->Form->submit('Guardar Asociación', ['class' => 'form-control', 'id' => 'asso_id'])."</h4>";

    echo "</div>";

    echo $this->Form->end();
?>




<div class="collapse" id="form_headquarter">

    <br><br>

    <h3 style="text-align: center;"> ¡Agregá una <b>Sede</b>!</h3><br><br>
    
    <?php

        echo $this->Form->create(null,['url' => ['controller'=>'headquarters', 'action' =>'add'], 'id'=>'submit2']);

        echo "<div class='form-group'>";

        echo "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre de la Sede', 'maxlength'=> '100'])."</h4>";

        echo "<h4>".$this->Form->input('image_name', ['class' => 'form-control', 'label'=>'Nombre de la imagen', 'maxlength'=> '100'])."</h4>";

        echo "<h4>".$this->Form->submit('Guardar Sede', ['class' => 'form-control', 'id' => 'sede_id'])."</h4>";

        echo "</div>";

        echo $this->Form->end();



    ?>  

</div>

<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>
