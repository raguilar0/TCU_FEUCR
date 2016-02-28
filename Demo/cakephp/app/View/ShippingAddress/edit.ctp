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
    <?php echo $this->Form->create('ShippingAddress'); ?>
        <fieldset id="registro">
            <legend><?php echo __('Registrar dirección de envío'); ?></legend>
            <?php
                echo $this->Form->input('country', array('title' => 'País', 'type' => 'select', 'options' => $countries, 'empty' => 'Seleccione su país', 'label' => 'País '));
                echo "<br><br>";
                echo $this->Form->input('address',array('title' => 'Dirección exacta', 'type' => 'textarea', 'label' => 'Dirección '));
                echo "<br><br>";
            ?>
        </fieldset>
    <?php echo $this->Form->end(__('Guardar')); ?>
    </div>
</div>

</body>
</html>