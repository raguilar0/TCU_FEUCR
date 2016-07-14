
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
            <th><?= $this->Paginator->sort('amount',['Monto']) ?></th>
            <th><?= $this->Paginator->sort('date',['Fecha de asignación']) ?></th>
            <th><?= $this->Paginator->sort('detail',['Detalles']) ?></th>
            <th><?= $this->Paginator->sort('association_id',['Asociación']) ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($surpluses as $surplus): ?>
            <tr>
                <td><?= "¢ ".number_format($surplus->amount,2,".",",") ?></td>
                <td><?= h($surplus->date) ?></td>
                <td><?= h($surplus->detail) ?></td>
                <td><?= $surplus->has('association') ? $this->Html->link($surplus->association->name, ['controller' => 'Associations', 'action' => 'view', $surplus->association->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $surplus->id],['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $surplus->id],['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $surplus->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('¿Estás seguro de que deseas borrarlo? # {0}?', $surplus->id)]) ?>
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

