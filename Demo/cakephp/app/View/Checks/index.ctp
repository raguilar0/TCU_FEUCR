<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de la tienda</title>
    <style>

        body
        {
            background: #151515;
        }

        #contenedor
        {
            margin-left: auto;
            margin-right: auto;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #simple
        {
            float:left;
            width:60%;
            background-color:#fff;
            border:solid 1px #dcdcdc;
            padding:10px;
            margin:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
        }

        #info
        {
            float: right;
            display: inline;
            width:420px;
        }

        #info h3
        {
            font-family: Helvetica, Geneva;
            color: #56BBAC;
        }

        #info p
        {
            padding-bottom:10px
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

<div id="contenedor">

    <?php
        echo '<div align="center"><table>';
        echo $this->Form->postLink('Actualizar estado',array('action' => 'cstatus'))."<br><br>";
        foreach($checks as $check){
			echo '<tr><td>'.$this->Html->link('Factura #:'.$check['Check']['id'],array('controller'=>'checks','action'=>'view',$check['Check']['id'])).'<br>Monto total: '.$check['Check']['amount'].'$<br>Fecha de factura: '.$check['Check']['sold_the'].'<br>';

            echo "Estado del envío: ";
                //date("Y-m-d H:i:s");
                $time = strtotime($check['Check']['sold_the']);
                $curtime = time();
                $inter = $curtime-$time;
                //echo $inter;
                if($check['Check']['dstatus']==0)
                echo "Enviada";
                elseif($check['Check']['dstatus']==1)
                echo "En proceso";
                elseif($check['Check']['dstatus']==2)
                echo "Entregada";
                //echo $inter;

            echo'</td></tr><br>';
		}
		echo '</table></div>'
    ?>


</div>

</body>
</html>