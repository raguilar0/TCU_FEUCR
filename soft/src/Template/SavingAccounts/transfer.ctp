<div class = "row text-center">
    <div class = "col-xs-12">
        <h1>¡Transferí las cuentas de ahorro!</h1>
    </div>
</div>

<br>
<br>


<?php
    echo $this->Form->create(null);
    $val = ((isset($this->request->params['pass'][0]))? $this->request->params['pass'][0] : 0);
    echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control', 'label'=>'Asociación correspondiente','empty'=>'Elegí una asociación','value'=>$val, 'onchange'=>'changeAssociation(this)']);


    ?>


    <?php
        if(isset($this->request->params['pass'][0])) {
            if (!empty($from_tracts)) {
                ?>

                <?php if (!empty($destination)) { ?>

                    <br/>
                    <div class="row text-center">
                        <div class="col-xs-12"><h4>Escogé las fechas de tracto involucradas en la transferencia</h4>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div
                            class="col-xs-6"><?= $this->Form->input('from', ['options' => $from_tracts, 'label' => 'Desde:', 'class' => 'form-control']); ?></div>
                        <div
                            class="col-xs-6"><?= $this->Form->input('to', ['options' => $destination, 'label' => 'Hacia:', 'class' => 'form-control']); ?></div>
                    </div>

                    <br/>
                    <br/>
                    <div class='row text-center'>
                        <div class='col-xs-12'>
                            <?= "<h4>" . $this->Form->submit('Transferir', ['class' => 'form-control btn btn-primary', 'id' => 'asso_id']) . "</h4>" ?>
                        </div>
                    </div>


                    <?= $this->Form->end(); ?>


<?php

                }
                else
                {
                    echo "<h3> ¿Por qué no puedo hacer la transferencia con esta asociación? Probablemente ya se le asoció un monto inicial a todas las fechas de tracto existentes, para poder asignarle un monto inicial nuevo deberá crear una nueva ".$this->Html->link('fecha de tracto.',['controller'=>'Tracts','action'=>'add'])."</h3>";
                }
            }
            else
            {
                echo "<h3> ¿Por qué no se muestra la información de transferencia? Esto puede deberse a dos casos: <br><br>1) aún no se han asignado ".$this->Html->link('fechas de tracto',['controller'=>'Tracts','action'=>'add'])." <br> 2) no se ha asignado una cuenta a esta asociación, tal que pueda ser transferible.</h3>";
            }
        }


?>




<br />
<div class="row text-center">
    <div class="col-xs-12">
        <?php echo $this->Html->link('Atrás', ['controller'=>'SavingAccounts', 'action'=>'index'], ['class'=>'btn btn-primary']);?>
    </div>
</div>



<script>
    function changeAssociation(id)
    {
        var url = "<?php echo $this->Url->build(["controller" => "SavingAccounts", "action" => "transfer"]);?>/"+id.value;
        window.location = url;
    }
</script>