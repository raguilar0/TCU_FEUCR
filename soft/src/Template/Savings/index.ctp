<div class="row text-center">
    <div class="col-xs-12">
        <h1>Administrá los montos de ahorro</h1>
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
            <th><?= $this->Paginator->sort('Estado') ?></th>
            <th><?= $this->Paginator->sort('Fecha') ?></th>
            <th><?= $this->Paginator->sort('Id de la asociación') ?></th>
            <th><?= $this->Paginator->sort('Tracto') ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($savings as $saving): ?>
            <tr>
                <td><?= $this->Number->format($saving->id) ?></td>
                <td><?= $this->Number->format($saving->amount) ?></td>
                <td><?= $this->Number->format($saving->state) ?></td>
                <td><?= h($saving->date) ?></td>
                <td><?= $saving->has('association') ? $this->Html->link($saving->association->name, ['controller' => 'Associations', 'action' => 'view', $saving->association->id]) : '' ?></td>
                <td><?= $saving->has('tract') ? $this->Html->link($saving->tract->date." - ".$saving->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $saving->tract->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $saving->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $saving->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $saving->id], ['confirm' => __('¿Estás seguro de que desea borrar este monto # {0}?', $saving->id)]) ?>
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

