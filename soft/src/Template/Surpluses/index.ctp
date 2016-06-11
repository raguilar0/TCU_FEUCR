
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá el superávit!</h1>
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
            <th><?= $this->Paginator->sort('Detalles') ?></th>
            <th><?= $this->Paginator->sort('Id de la asociación') ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($surpluses as $surplus): ?>
            <tr>
                <td><?= $this->Number->format($surplus->id) ?></td>
                <td><?= $this->Number->format($surplus->amount) ?></td>
                <td><?= h($surplus->date) ?></td>
                <td><?= h($surplus->detail) ?></td>
                <td><?= $surplus->has('association') ? $this->Html->link($surplus->association->name, ['controller' => 'Associations', 'action' => 'view', $surplus->association->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $surplus->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $surplus->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $surplus->id], ['confirm' => __('¿Estás seguro de que deseas borrarlo? # {0}?', $surplus->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

