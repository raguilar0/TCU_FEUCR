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
            <legend><?php echo __('Editar usuario'); ?></legend>
            <?php
                echo $this->Form->input('username',array('title' => 'Nombre de usuario', 'label' => 'Nombre de usuario '));
                echo "<br><br>";
                echo $this->Form->input('password',array('title' => 'Contraseña', 'label' => 'Contraseña '));
                echo "<br><br>";
		        echo $this->Form->input('name',array('title' => 'Nombre', 'label' => 'Nombre '));
		        echo "<br><br>";
		        echo $this->Form->input('lastname',array('title' => 'Apellido', 'label' => 'Apellido '));
		        echo "<br><br>";
		        echo $this->Form->input('email',array('title' => 'Correo electrónico', 'label' => 'Correo electrónico '));
		        echo "<br><br>";
		        echo $this->Form->input('country', array('title' => 'País', 'type' => 'select', 'options' => $countries, 'empty' => 'Seleccione su país', 'label' => 'País '));
		        echo "<br><br><br>";
				echo "Tarjetas registradas:";
		        echo "<br><br>";
                if(empty($dcard_num) && empty($ccard_num))
                {
                    echo "No tiene tarjetas registradas hasta el momento";
                }
                ?>
                <table>
                    <tr>
                        <th>Últimos cuatro dígitos de la tarjeta de débito</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($dcard_num as $dcardnum => $value): ?>
                    <tr>
                        <td><?php echo "------------".$value[12].$value[13].$value[14].$value[15]; ?></td>
                        <td>
                            <?php echo $this->Html->link('Eliminar', array('controller' => 'CardUser', 'action' => 'delete_debit', $dcardnum)); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php unset($dcardnum); ?>
                </table>
                <?php
                echo $this->Html->link('Registrar nueva tarjeta de débito',array('controller' =>'debitcard','action'=>'register'));
                echo "<br><br>";
                ?>
                <table>
                    <tr>
                        <th>Últimos cuatro dígitos de la tarjeta de crédito</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($ccard_num as $ccardnum => $value): ?>
                    <tr>
                        <td><?php echo "------------".$value[12].$value[13].$value[14].$value[15]; ?></td>
                        <td>
                            <?php echo $this->Html->link('Eliminar', array('controller' => 'CardUser', 'action' => 'delete_credit', $ccardnum)); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php unset($ccardnum); ?>
                </table>
                <?php
                echo $this->Html->link('Registrar nueva tarjeta de crédito',array('controller' =>'creditcard','action'=>'register'));
                echo "<br><br>";
                ?>
                <br>
                <?php echo "Direcciones de envío:"; ?><br><br>
                    <table>
                	<tr>
                        <th>Dirección</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    <?php foreach ($shipaddress as $address => $value): ?>
                    <tr>
                        <td><?php echo $value; ?></td>
                        <td><?php
                        	echo $this->Html->link('Editar', array('controller' => 'ShippingAddress', 'action' => 'edit', $address));
                        	echo '  ';
                            echo $this->Html->link('Eliminar', array('controller' => 'ShippingAddress', 'action' => 'delete', $address), array('confirm' => '¿Seguro?'));
                        ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php unset($address); ?>
                    </table>
                <?php echo "Dirección de Facturación:"; ?><br><br>
                    <table>
                    <tr>
                        <th>Dirección</th>
                        <th colspan="2">Acciones</th>
                        </tr>
                        <?php foreach ($billaddress as $address => $value): ?>
                        <tr>
                            <td><?php echo $value; ?></td>
                            <td><?php
                                echo $this->Html->link('Editar', array('controller' => 'BillingAddress', 'action' => 'edit', $address));
                                echo '  ';
                                echo $this->Html->link('Eliminar', array('controller' => 'BillingAddress', 'action' => 'delete', $address), array('confirm' => '¿Seguro?'));
                            ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($address); ?>
                        </table>
                <?php
                echo $this->Html->link('Registrar nueva dirección de envío',array('controller' =>'shippingaddress','action'=>'add'));
                ?>
                <?php
		        if($this->Session->read('Auth.User.role')== 'admin')
		        {
                    echo $this->Form->input('role', array('options' => array('admin' => 'Administrator', 'cust' => 'Customer'), 'title'=>'Rol', 'label'=>'Rol '));
                }
				echo "<br><br>";
				if($this->Session->read('Auth.User.role')== 'admin')
		        {
                    echo $this->Form->input('type', array('title' => 'Tipo de Cliente', 'type' => 'select', 'options' => array('Estandar', 'VIP','Adulto Mayor ',' Adulto Mayor VIP') , 'empty' => 'Seleccione tipo', 'label' => 'Tipo de Usuario: '));
                }
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Guardar cambios')); ?>
    </div>
</div>

</body>
</html>