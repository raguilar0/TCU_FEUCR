<div class="row text-center">
    <div class="col-xs-12">
        <h1>Administrá los montos</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('Monto') ?></th>
                <th><?= $this->Paginator->sort('Fecha') ?></th>
                <th><?= $this->Paginator->sort('Detalle') ?></th>
                <th><?= $this->Paginator->sort('Tipo') ?></th>
                <th><?= $this->Paginator->sort('Asociación') ?></th>
                <th><?= $this->Paginator->sort('Id del Tracto') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($amounts as $amount): ?>
            <tr>
                <td><?= $this->Number->format($amount->id) ?></td>
                <td><?= $this->Number->format($amount->amount) ?></td>
                <td><?= h($amount->date) ?></td>
                <td><?= h($amount->detail) ?></td>
                <td><?= $this->Number->format($amount->type) ?></td>
                <td><?= $amount->has('association') ? $this->Html->link($amount->association->name, ['controller' => 'Associations', 'action' => 'view', $amount->association->id]) : '' ?></td>
                <td><?= $amount->has('tract') ? $this->Html->link($amount->tract->id, ['controller' => 'Tracts', 'action' => 'view', $amount->tract->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $amount->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $amount->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $amount->id], ['confirm' => __('Seguro de que desea borrar el monto # {0}?', $amount->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
