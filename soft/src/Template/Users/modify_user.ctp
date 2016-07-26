<div class="row text-center">
    <div class="col-xs-12">
        <h1>Modificar la información de <?= $user['name'];?></h1>
    </div>

</div>


<br />
<br />
<br />

<?= $this->Form->create($user); ?>

    <div class="form-group">
        <?= $this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de Usuario', 'value'=>$user['username'], 'maxlength'=> '0']); ?>
        <?= $this->Form->input('name', ['class' => 'form-control', 'label'=>'Nombre', 'value'=>$user['name'], 'maxlength'=> '20']); ?>
        <?= $this->Form->input('last_name_1', ['class' => 'form-control','label'=>'Primer Apellido','value'=>$user['last_name_1'], 'maxlength'=> '20']); ?>
        <?= $this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido','value'=>$user['last_name_2'], 'maxlength'=> '20']); ?>

        <?php
            if($this->request->session()->read('Auth.User.role') == 'admin')
            {
                echo $this->Form->input('role', ['options' => $role, 'class'=>'form-control', 'label'=>'Rol', 'empty'=>'Elegí un rol','onchange'=>'hideAssociations(this)']);
                $style = (($user['role'] == 'admin')? "style = 'display:none'": '');

                echo "<div id='as_id' ".$style.">" ;
                echo $this->Form->input('association_id', ['options' => $associations, 'label'=>'Asociación', 'class'=>'form-control', 'empty'=>'Elegí una asociación']);
                echo "</div>";

            }
        ?>
        <?= $this->Form->input('state', ['type'=>'checkbox','class'=>'checkbox-inline', 'label'=>'Bloquear usuario']);?>
        <br />
        <div class="row text-center">
            <div class="col-xs-12">
                <?= $this->Form->submit('Guardar Usuario', ['class' => 'btn btn-primary']); ?>
            </div>
        </div>

    </div>




<?= $this->Form->end(); ?>

<?php
    if($this->request->session()->read('Auth.User.role') == 'admin')
    {
        echo $this->Html->link('Cambiar contraseña',['action'=>'reset-password',$this->request->params['pass'][0]],['class'=>'btn btn-danger']);
    }
?>
<br />
<br />
<br />

<div class="row text-center">
    <div class="col-xs-12">
        <?= $this->Html->link('Atrás', ['action' => 'modify'], ['class'=>'btn btn-primary']); ?>
    </div>
</div>


<script>
    $(document).ready(function () {

    });
    function hideAssociations(element)
    {
        var obj = document.getElementById("as_id");
        if(element.value === 'admin')
        {
            obj.style.display = "none";
        }
        else
        {
            obj.style.display = "block";
        }
    }
</script>