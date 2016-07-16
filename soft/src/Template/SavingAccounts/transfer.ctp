<div class = "row text-center">
    <div class = "col-xs-12">
        <h1>Transferí la cuenta de ahorro al siguiente tracto</h1>
    </div>
</div>

<div class="row text-center">
    <div class="col-xs-12">
        <h2 id="association_name"></h2>


        <h3><?php

            if(empty($data))
            {
                echo "Debe crear un tracto primero antes de poder asignar montos.";
            }
            ?>
        </h3>
    </div>
</div>


<br>
<br>


<div class="row text-center">
    <?php
    if(!empty($data))
    {
        echo "<div class = 'col-xs-12 col-md-5'>";

        echo "<label><h4><strong>Sedes</strong></h4></label>";
        echo "<select class='form-control' id= 'headquarter_id' name = 'type' onchange='getAssociations();'>";



        foreach ($head as $key => $value) {
            echo "<option>".$value['name']."</option>"."<br>";
        }

        echo "</select>";
        echo "</div>";



        echo "<div class = 'col-xs-12 col-md-7'>";

        echo "<label><h4><strong>Asociaciones</strong></h4></label>";
        echo "<select class='form-control' name = 'type' id = 'associations' onchange = 'changeAssociation();'>";


        echo "</select>";
        echo "</div>";
    }


    ?>



</div>


<br>
<br>
<br>
<br>



<?php if(!empty($data)) { ?>

    <?= $this->Form->create(null, ['id'=>'submit_add_saving_account']); ?>
    <div class="form-group">

        <br>
        <br>

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <h4>Trasferir de: </h4>
                <?php
                    echo "<select class='form-control'  name = 'first_tract'>";

                    /**
                     *  Imprime las fechas del tracto anterior y las actuales
                     **/

                    foreach ($data[0] as $key => $value) {
                        echo "<option>".$value['date']->format('Y-m-d')."</option>"."<br>";
                    }

                    foreach ($data[1] as $key => $value) {
                        echo "<option>".$value['date']->format('Y-m-d')."</option>"."<br>";
                    }

                    echo "</select>";
                ?>
            </div>

            <div class="col-xs-12 col-md-6">
                <h4>Hacia:</h4>
               <?php
                   echo "<select class='form-control' name = 'second_tract'>";

                   /**
                    *  Imprime solo las fechas de los tractos acutales
                    **/
                   foreach ($data[1] as $key => $value) {
                       echo "<option>".$value['date']->format('Y-m-d')."</option>"."<br>";
                   }

                   echo "</select>";
               ?>
            </div>
        </div>



    <br>
    <br>
    <br>
    <br>
    <div class="row text-center">
        <div class="col-xs-12">
            <?= $this->Form->submit('Transferir', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id']) ?>
        </div>
    </div>


   <?= $this->Form->end(); ?>
<?php } ?>



<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>
    </div>

</div>



<?=$this->Html->script('amounts_admin') ?>

<script>

    //El siguiente script es para cargar las sedes y asociaciones que partenencen en esa sede. Esto en un dropdown

    $(document).ready( function ()
    {
        var path = "<?php echo $this->Url->build(["controller" => "Amounts", "action" => "getAssociations"]);?>";
        getAssociations(path);
    });


</script>
