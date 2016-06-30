<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del monto de ahorro</h1>
    </div>

</div>
<br>
<br>


    <table class="table">

        <tr>
          <th><?php echo __('Asociación') ?></th>
          <td><?php echo $saving->has('association') ? $this->Html->link($saving->association->name, ['controller' => 'Associations', 'action' => 'view', $saving->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tracto') ?></th>
            <td><?= $saving->has('tract') ? $this->Html->link($saving->tract->date." - ".$saving->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $saving->tract->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Monto asignado') ?></th>
            <td><?= $this->Number->format($saving->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Estado (aprobado/rechazado)') ?></th>
            <td><?= ($this->Number->format($saving->state) ? "Aceptado":"Pendiente" );?>
            </td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($saving->date) ?></td>
        </tr>
        
        <tr>
            <th><?= __('Carta') ?></th>
            <td><?= $this->Html->link( $saving->letter,['controller'=>'Savings', 'action'=>'download', $saving->letter]);?></td>
        </tr>
    </table>
