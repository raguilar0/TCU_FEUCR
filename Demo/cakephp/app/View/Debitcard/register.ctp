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
    <?php echo $this->Form->create('Debitcard'); ?>
        <fieldset id="registro">
            <legend><?php echo __('Registrar tarjeta'); ?></legend>
            <?php
                echo $this->Form->input('card_number',array('title' => 'Número de tarjeta', 'label' => 'Número de tarjeta '));
                echo "<br><br>";
                echo $this->Form->input('csc',array('title' => 'Código de seguridad', 'label' => 'Código de seguridad '));
                echo "<br><br>";
            ?>
        </fieldset>
    <?php echo $this->Form->end(__('Registrar')); ?>
    </div>

</div>
</body>
</html>