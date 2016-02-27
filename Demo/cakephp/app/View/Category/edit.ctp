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

        .categoryform
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
    <div class="categoryform">
    <?php echo $this->Html->link('Volver',array('action'=>'index')); ?>
    <br>
    <?php echo $this->Form->create('Category'); ?>
        <fieldset id="registro">
            <h3><?php echo __('Editar Categoría'); ?></h3>
            <br>
            <?php
                echo $this->Form->input('name',array('label' => 'Nombre nuevo:'));
                echo '<br><br>';
                echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $categories, 'empty' => 'Ninguna', 'label' => 'Categoría Padre:'));
                ?>
        </fieldset>
        <?php echo $this->Form->end(__('Guardar cambios')); ?>
    </div>
</div>

</body>
</html>