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
        <h2><?php echo "Información del usuario" ?></h2>
        <h3><?php echo "Nombre de usuario: ".h($users['User']['username'])." "; ?></h3>
		<h3><?php if($users["User"]["type"] == 0){
								echo "Tipo de cliente:  Estandar"; 
								}elseif($users["User"]["type"] == 1){
									echo "Tipo de cliente:  VIP		(10% descuento)";
								}elseif($users["User"]["type"] == 2){
									echo "Tipo de cliente:  Adulto Mayor	(10% descuento)";
								}elseif($users["User"]["type"] == 3){
									echo "Tipo de cliente:  Adulto Mayor VIP		(15% descuento)";
								}
								?></h3>
        <h3><?php echo "Nombre: ".h($users['User']['name'])." ".h($users['User']['lastname'])." "; ?></h3>
        <h3><?php echo "Correo electrónico: ".h($users['User']['email'])." "; ?></h3>
        <h3><?php echo "País: ".$country." "; ?></h3>
        <h3><?php if($this->Session->read('Auth.User.role')== 'admin')
        {
            echo "Rol: ".h($users['User']['role'])." ";
        } ?></h3>
        <h3><?php
            echo $this->Html->link("Tarjetas registradas",array('controller' => 'carduser', 'action' => 'index'));
        ?></h3>
        <br>
        <h3><?php
            echo $this->Html->link("Mis Compras",array('controller' => 'checkproduct', 'action' => 'sales'));
        ?></h3>
        <br>
		<h3>Direcciones de envío</h3><br>
		<h3><?php
            if(empty($shipaddress))
            {
                echo "No tiene direcciones registradas hasta el momento";
            }
            ?></h3>
		    <table>
		           <tr>
                        <th>Dirección</th>
                   </tr>
                   <?php foreach ($shipaddress as $address): ?>
                   <tr>
                        <td><?php echo $address; ?></td>
                   </tr>
                   <?php endforeach; ?>
                   <?php unset($address); ?>
            </table>
		<br><br>
		<br>
                		<h3>Dirección de Facturación</h3><br>
                		<h3><?php
                            if(empty($billaddress))
                            {
                                echo "No tiene direcciones registradas hasta el momento";
                            }
                            ?></h3>
                		    <table>
                		           <tr>
                                        <th>Dirección</th>
                                   </tr>
                                   <?php foreach ($billaddress as $address): ?>
                                   <tr>
                                        <td><?php echo $address; ?></td>
                                   </tr>
                                   <?php endforeach; ?>
                                   <?php unset($address); ?>
                            </table>
                <br><br>

        <h3><?php echo $this->Html->link('Editar mi perfil',array('controller' =>'users','action'=>'edit',$this->Session->read('Auth.User.id'))); ?>
    </div>
</div>

</body>
</html>