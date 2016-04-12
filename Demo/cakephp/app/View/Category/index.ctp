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

        .productsform
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

        #registro textarea
        {
             float:right;
        }

        table, td {
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px;
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
    <div class="productsform">

    <h3>Listado de Categorías</h3>

    <table style="width:100%">
        <tr>
            <th>Nombre de la Categoría</th>
		    <th colspan="4">Acciones</th>
        </tr>
        <?php foreach ($categorylist as $key => $value): ?>
        <tr>
            <td><?php echo $this->Html->link($value, array('controller' => 'Category', 'action' => 'view', $key)); ?></td>
		    <td><?php
		        if($this->Session->read('Auth.User.role')=='admin')
		        {
		            echo $this->Html->link('Editar', array('action' => 'edit', $key));
		            echo '  ';
                    echo $this->Form->postLink('Eliminar', array('action' => 'delete', $key), array('confirm' => 'Seguro?'));
                    echo '  ';
                    echo $this->Html->link('Subir', array('action' => 'moveup', $key));
                    echo '  ';
                    echo $this->Html->link('Bajar', array('action' => 'movedown', $key));
                }?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($categorylist); ?>
    </table>

    <br>
    <h1><?php echo $this->Html->link('Agregar categoría', array('action' => 'add'));?></h1>

    </div>
</div>

</body>
</html>