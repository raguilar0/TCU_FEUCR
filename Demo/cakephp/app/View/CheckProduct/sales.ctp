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

        table, td {
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px;
        }
        #enc {
             background-color: #007f7f;
             color: white;
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

 <h3>Detalles de Ventas</h3>

  <table >
       <tr>
          <td id="enc" >
              Producto
          </td>
          <td id="enc" >
              Cantidad
          </td>
          <td id="enc">
              Fecha
          </td>
       </tr>

  <?php foreach ($sale as $s):?>

      <tr>
         <td >
            <?php   echo $s['Product']['name']; ?>
         </td>
         <td>
           <?php   echo $s['CheckProduct']['quantity']; ?>
         </td>
         <td>
           <?php   echo $s['Check']['sold_the']; ?>
         </td>
       </tr>

  <?php endforeach; ?>
  </table>
<div>
</body>
</html>