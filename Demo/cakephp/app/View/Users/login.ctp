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
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User'); ?>
        <fieldset id="registro">
            <legend><?php echo __('Por favor ingrese nombre de usuario y contraseña'); ?></legend>
                <?php
                    echo $this->Form->input('username',array('title' => 'Nombre de usuario', 'label' => 'Nombre de usuario '));
                    echo "<br><br>";
                    echo $this->Form->input('password',array('title' => 'Contraseña', 'label' => 'Contraseña '));
                ?>
        </fieldset>
        <?php echo $this->Form->end(__('Ingresar')); ?>
    </div>
</div>

</body>
</html>