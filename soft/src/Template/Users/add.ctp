<!-- src/Template/Users/add.ctp -->
<div class = 'row text-center'>
    <div class='col-xs-12'>
        <h1>¡<b>Agregá</b> un usuario !</h1>
    </div>
</div>

<br>
<br>



<?= $this->Form->create($user); ?>

<div class="form-group">
    <?= "<h4>".$this->Form->input('username', ['class' => 'form-control','label'=>'Nombre de usuario','maxlength'=> '40', 'type'=>'mail', 'placeholder'=>'@ucr.ac.cr'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('password', ['class' => 'form-control','label'=>'Contraseña (mínimo 8 caracteres y al menos 1 número)', 'type'=>'password'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('repass', ['class' => 'form-control','label'=>'Repetir Contraseña', 'type'=>'password'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('name', ['class' => 'form-control','label'=>'Nombre'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('last_name_1', ['class' => 'form-control','label'=>'Primer Apellido'])."</h4>"; ?>
    <?= "<h4>".$this->Form->input('last_name_2', ['class' => 'form-control','label'=>'Segundo Apellido'])."</h4>"; ?>

    <?php if(($this->request->session()->read('Auth.User.role')) == 'admin'):?>
        <?= $this->Form->input('role', ['options' => $role, 'class'=>'form-control', 'label'=>'Rol', 'onchange'=>'hideAssociations(this)', 'empty'=>'Elegí un rol']); ?>
        <div id="as_id">
            <?= $this->Form->input('association_id', ['options' => $association, 'class'=>'form-control', 'label'=>'Asociación correspondiente', 'empty'=>'Elegí una asociación']);?>
        </div>



    <?php endif;?>

    <br>
    <br>
    <div class="row">
        <div class="text-center">
            <?= "<h4>".$this->Form->submit('Agregar', ['class' => 'btn btn-primary'])."</h4>"; ?>
        </div>
    </div>

    <?= $this->Form->end(); ?>



</div>

<script>
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