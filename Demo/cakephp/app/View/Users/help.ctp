<!DOCTYPE html>
<html>
<head>
<style>
        #data
        {
            width:70%;
            display:inline;
            float: left;
            margin:5px;
            background-color: #fff;
            border:solid 1px #dcdcdc;
            padding:10px;
        }
        h3
        {
            font-family: Helvetica, Geneva;
             color: #56BBAC;
        }
        h4
        {
         font-family: Helvetica, Geneva;
                     color: #2F4F4F;
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

    <div id="data">
         <ul>
            <li><a href="#register">Como Registrarse</a></li>
            <li><a>Como Comprar</a></li>
         </ul>
    </div>
    <div id="data">
         <h3>Como Registrarse</h3>
         <h4 name="register">
            <?php
                $txt = "Para poder utilizar todos nuestros servicios de forma mas completa es necesario que cree una cuenta.
                        Utilice el link 'Crear Cuenta' o presione ".$this->Html->link('aqui',array('controller' => 'users', 'action' => 'add')).
                        ". Esto lo dirigira a un formulario donde debera completar sus datos, al finalizar podra disfrutar de todos los servicios de la Tienda Web.";

                echo $txt;
            ?>
         </h4>
    </div>
</body>
</html>