<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del monto de ahorro #<?= h($saving->id) ?></h1>
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
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($saving->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Monto asignado') ?></th>
            <td><?= $this->Number->format($saving->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Estado (aprobado/rechazado)') ?></th>
            <td><?= $this->Number->format($saving->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($saving->date) ?></td>
        </tr>
    </table>
