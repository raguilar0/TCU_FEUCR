<div class="row text-center">
    <div class="col-xs-12">
        <h1 id="association_name"></h1>  


        <h3><?php

                if(empty($data[0]))
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
        if(!empty($data[0]))
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






    <?php if(!empty($data[0])): ?>

        <?= $this->Form->create(null, ['id'=>'submit5']); ?>

            <div class='form-group'>

                <div class="row">
                    <div class="col-md-6 col-xs-4"><h4><strong>Montos</strong></h4></div>
                    <div class="col-md-6 col-xs-8"><h4><strong>Fecha del Tracto<strong></h4></div>
                </div>

                <?php

                    $tract[1] = "Tracto 1";
                    $tract[2] = "Tracto 2";
                    $tract[3] = "Tracto 3";
                    $tract[4] = "Tracto 4";

                foreach ($data as $key => $value){
                    $tract_name = $tract[$value['number']];

                    echo "<div class='row'>";
                        echo "<div class='col-md-6 col-xs-8'>";
                            echo "<label>".$tract_name."</label>";
                            echo "<div class='input-group'>";
                                echo "<span class='input-group-addon' >₡</span>";
                                echo $this->Form->input('amountTract'.$value['number'], ['class' => 'form-control', 'label'=>false, 'min'=>'0', 'placeholder'=>'Ejemplo: 50000', 'required']);
                                echo "<span class='input-group-addon'>.00</span>";
                            echo "</div>";
                        echo "</div>";

                        echo "<div class='col-md-6 col-xs-4'>";
                            echo $this->Form->input('tract0', ['class' => 'form-control', 'label'=>$tract_name,'type'=>'text','disabled','value'=>$value['date']." - ".$value['deadline']]);
                        echo "</div>";
                    echo "</div>";

                }


                ?>


<br>
<br>


            <div class='row text-center'>
                <div class='col-xs-12'>
                    <h4>Detalle</h4>
                   <h4><?=$this->Form->textarea('detail', ['class' => 'form-control', 'required'])?></h4>
                </div>
            </div>


            <div class='row text-center'>
                <div class = 'col-xs-12'>
                   <h4><?= $this->Form->submit('Guardar Montos', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id'])?></h4>
                </div>
            </div>
            </div>




        <?= $this->Form->end(); ?>
    <?php endif; ?>




<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"><?= $this->Flash->render('addAmounts') ?></h4>   
    </div>

</div>


<div class="row text-right">
    <div class="col-xs-12">
        <h4 id="callback" style="color:#01DF01"></h4>   
    </div>

</div>




<div class="row text-center">
  <div class="col-xs-12">
     <?php echo $this->Html->link('Atrás', '/associations', ['class'=>'btn btn-primary']);?>
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