<!DOCTYPE html>
<html>
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

    <br><br>
    <h1>Listado de Usuarios</h1>
    <table>
        <tr>
            <th>Nombre de usuario</th>
		    <th>Acciones</th>
        </tr>
        <?php foreach ($users as $users): ?>
        <tr>
            <td><?php echo $this->Html->link($users['User']['username'], array('controller' => 'users', 'action' => 'view', $users['User']['id'])); ?></td>
		    <td><?php
		        if($this->Session->read('Auth.User.role')=='admin')
		        {
		            echo $this->Html->link('Editar', array('action' => 'edit', $users['User']['id']));
		            echo '  ';
                    echo $this->Form->postLink('Eliminar', array('action' => 'delete', $users['User']['id']), array('confirm' => 'Are you sure?'));
                }
                else
                {
                    if($this->Session->read('Auth.User.id')==$users['User']['id']){
                    echo $this->Html->link('Edit', array('action' => 'edit', $users['User']['id']));
                    }
                    else
                    {
                        echo 'None';
                    }
                }
            ?></td>
        </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
    </table>

</body>
</html>