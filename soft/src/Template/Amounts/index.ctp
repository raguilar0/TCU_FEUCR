<h4>Montos</h4>


 
<!-- link to add new users page -->
<!-- <div class='upper-right-opt'>
<?php echo $this->Html->link( '+ New User', array( 'action' => 'add' ) ); ?>
</div>
 -->
<table style='padding:5px;'>
    <!-- table heading -->
    <tr style='background-color:#fff;'>
        <th>Monto Máximo</th>
        <th>Fecha de Tracto</th>
        <th>Fecha de Cierre</th>
        <th>Asociación</th>
    </tr>
     
<?php
 
    foreach( $amount as $value ){
     
        echo "<tr>";
            //echo "<td>".$value['id']."</td>";
            echo "<td>".$value['amount']."</td>";
            echo "<td>".$value['date']."</td>"; 
            echo "<td>".$value['deadline']."</td>";
            echo "<td>".$value['association_id']."</td>";
            //here are the links to edit and delete actions
            echo "<td class='actions'>";
                echo $this->Html->link( 'Edit', array('action' => 'edit', $value['id']) );
                 
               /* 
                echo $this->Form->postLink( 'Delete', array(
                        'action' => 'delete', 
                        $amount['Amount']['id']), array(
                            'confirm'=>'Seguro que desea eliminar el monto?' ) );
                */
            echo "</td>";
        echo "</tr>";
    }

?>
     
</table>