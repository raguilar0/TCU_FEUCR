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
            width:30%;
            margin:0 auto;
            margin-top:2%;
            background-color: #fff;
            color: black;
            border:solid 1px #dcdcdc;
            padding:2px;
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
    <?php echo $this->Html->link('Volver',array('action'=>'index')); ?>
    <div class="categoryform">
    <fieldset id="registro">
            <legend><?php echo "Información de la Categoría" ?></legend>
            <h1><?php echo "Nombre: ".h($category['Category']['name'])." "; ?></h1>
            <h1><?php
                if($category['Category']['parent_id'] != '')
                {
                    echo "Categoría Padre: ".h($parent['Category']['name'])." ";
                }
            ?></h1>
            <h1><?php
                if($child != null)
                {
                    echo "Subcategorías: ";
                    foreach ($child as $children):
                        echo '<br>'.$children;
                    endforeach;
                }

            ?></h1>
    <?php unset($child); ?>
</fieldset>
</div>
</div>
</body>
</html>