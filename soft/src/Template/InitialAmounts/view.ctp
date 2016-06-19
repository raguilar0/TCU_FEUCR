<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del monto inicial #<?= h($initialAmount->id) ?></h1>
    </div>

</div>
<br>
<br>


    <table class="table">
        <tr>
            <th><?= __('Asociación') ?></th>
            <td><?= $initialAmount->has('association') ? $this->Html->link($initialAmount->association->name, ['controller' => 'Associations', 'action' => 'view', $initialAmount->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tracto') ?></th>
            <td><?= $initialAmount->has('tract') ? $this->Html->link($initialAmount->tract->id, ['controller' => 'Tracts', 'action' => 'view', $initialAmount->tract->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($initialAmount->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Monto') ?></th>
            <td><?= $this->Number->format($initialAmount->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= $initialAmount->type ? 'Ingresos Generados': 'Tracto' ;//$this->Number->format($initialAmount->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha de asignación') ?></th>
            <td><?= h($initialAmount->date) ?></td>
        </tr>
    </table>

