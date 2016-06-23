<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del monto #<?= h($amount->id) ?></h1>
    </div>

</div>
<br>
<br>
<div class="table-responsive">

    <table class="table">
        <tr>
            <th><?= __('Detalle') ?></th>
            <td><?= h($amount->detail) ?></td>
        </tr>
        <tr>
            <th><?= __('Asociación') ?></th>
            <td><?= $amount->has('association') ? $this->Html->link($amount->association->name, ['controller' => 'Associations', 'action' => 'view', $amount->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tracto') ?></th>
            <td><?= $amount->has('tract') ? $this->Html->link($amount->tract->id, ['controller' => 'Tracts', 'action' => 'view', $amount->tract->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($amount->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Monto') ?></th>
            <td><?= $this->Number->format($amount->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= $this->Number->format($amount->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($amount->date) ?></td>
        </tr>
    </table>
</div>
