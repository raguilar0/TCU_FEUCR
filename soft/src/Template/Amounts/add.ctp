


<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Agregá los montos de tracto!</h1>
    </div>
</div>


<?= $this->Form->create(null)?>

<?php
    $val = ((isset($this->request->params['pass'][0]))? $this->request->params['pass'][0] : 0);
    echo $this->Form->input('association_id', ['options' => $associations, 'class'=>'form-control', 'label'=>'Asociación correspondiente','empty'=>'Elegí una asociación','value'=>$val, 'onchange'=>'changeAssociation(this)']);
?>
<br />
<?php if(isset($this->request->params['pass'][0])):?>

<?php if(!empty($tracts)):?>

<div class="row text-center">
    <div class="col-xs-6">
        <h4>Montos</h4>
    </div>

    <div class="col-xs-3">
        <h4>Fechas de tracto</h4>
    </div>

    <div class="col-xs-3">
        <h4>Número de tracto</h4>
    </div>
</div>

<?php

    foreach ($tracts as $tracts)
    {
        $attr_name = "tract_".$tracts['id'];
        echo "<div class='row text-center'>";
            echo "<div class='col-xs-6'>".$this->Form->input($attr_name,['class' => 'form-control', 'label'=>false, 'min'=>'0', 'placeholder'=>'Ejemplo: 50000', 'required', 'type'=>'number'])."</div>";
            echo "<div class='col-xs-3'>".$tracts['date']." - ".$tracts['deadline']."</div>";
            echo "<div class='col-xs-3'>".$tracts['number']."</div>";
        echo "</div>";

    }
?>
<br />
<br />
<div class='row text-center'>
    <div class='col-xs-12'>
        <h4>Detalle</h4>
        <h4><?=$this->Form->textarea('detail', ['class' => 'form-control', 'required'])?></h4>
    </div>
</div>

<br />
<br />
<br />
<div class="row text-center">
    <div class="col-xs-12">
        <?= $this->Form->submit('Guardar Montos', ['class' => ' btn btn-primary'])?>
    </div>
</div>

<?= $this->Form->end() ?>
<?php endif;
    if(empty($tracts))
    {
        echo "<h3>¿Por qué no se muestran los campos para ingresar los montos? Esto puede deberse a que ya se asignaron todos los montos para esta asociación o a que aún no se han asignado las ".$this->Html->link('fechas de tracto.',['controller'=>'Tracts','action'=>'add'])."</h3>";
    }
?>


<?php endif;?>


<script>
    function changeAssociation(id)
    {
        var url = "<?php echo $this->Url->build(["controller" => "Amounts", "action" => "add"]);?>/"+id.value;
        window.location = url;
    }
</script>
