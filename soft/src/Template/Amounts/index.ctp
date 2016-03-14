<h4>Montos</h4>


 
<!-- link to add new users page -->
<!-- <div class='upper-right-opt'>
<?php echo $this->Html->link( '+ New User', array( 'action' => 'add' ) ); ?>
</div>
 -->
<table style='padding:5px;'>
    <!-- table heading -->
    <tr style='background-color:#fff;'>
        <th>ID</th>
        <th>Monto</th>
        <th>Fecha de Tracto</th>
        <th>Fecha de Cierre</th>
    </tr>
     
<?php
 
    foreach( $amount as $amount ){
     
        echo "<tr>";
            echo "<td>{$amount['Amount']['id']}</td>";
            echo "<td>{$amount['Amount']['amount']}</td>";
            echo "<td>{$amount['Amount']['date']}</td>"; 
            echo "<td>{$amount['Amount']['deadline']}</td>";
            //here are the links to edit and delete actions
            echo "<td class='actions'>";
                echo $this->Html->link( 'Edit', array('action' => 'edit', $amount['Amount']['id']) );
                 
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