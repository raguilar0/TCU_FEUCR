<!DOCTYPE html>
<html>

<head>
    <style>

        #container
        {
            width:100%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        .usersform
        {
            width:50%;
            margin:0 auto;
            margin-top:2%;
            background-color: #fff;
            color: black;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #registro input
        {
            float:right;
        }
    </style>
</head>

<body>

<?php if($this->Session->read("Auth.User.role") == 'admin')
      {
        include("headeradmin.ctp");
      }
      else
      {
        include("header.ctp");
      }
?>

<div id="container">

    <div class="usersform">
        <?php echo $this->Form->create('User'); ?>
        <fieldset id="registro">
            <legend><?php echo __('Registro de Usuarios'); ?></legend>
            <?php   echo $this->Form->input('username', array('title' => 'Nombre de usuario', 'label' => 'Nombre de usuario '));
                    echo "<br>";
                    echo "<br>";
                    echo $this->Form->input('password', array('title' => 'Contraseña', 'label' => 'Contraseña '));
                    echo "<br>";
                    echo "<br>";
                    echo $this->Form->input('password_confirm', array('label' => 'Confirmar contraseña ', 'title' => 'Confirmar contraseña', 'type'=>'password'));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('name', array('title' => 'Nombre', 'label' => 'Nombre '));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('lastname', array('title' => 'Apellido', 'label' => 'Apellido '));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('email', array('title' => 'Correo electrónico', 'label' => 'Correo electrónico '));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('country', array('title' => 'País', 'type' => 'select', 'options' => $countries, 'empty' => 'Seleccione su país', 'label' => 'País '));
                    echo "<br>";
                    echo "<br>";
                    echo $this->Form->input('role', array('options' => array('admin' => 'Administrador', 'cust' => 'Cliente'), 'title'=>'Rol', 'label'=>'Rol '));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Registrar')); ?>
    </div>

</div>
</body>
</html>