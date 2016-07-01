<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del superávit #<?= h($surplus->id) ?></h1>
    </div>

</div>
<br>
<br>


    <table class="table">
        <tr>
            <th><?= __('Detalle') ?></th>
            <td><?= h($surplus->detail) ?></td>
        </tr>
        <tr>
            <th><?= __('Asociación') ?></th>
            <td><?= $surplus->has('association') ? $this->Html->link($surplus->association->name, ['controller' => 'Associations', 'action' => 'view', $surplus->association->id]) : '' ?></td>
        </tr>

        <tr>
            <th><?= __('Monto asignado') ?></th>
            <td><?= $this->Number->format($surplus->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha de asignación') ?></th>
            <td><?= h($surplus->date) ?></td>
        </tr>
    </table>

