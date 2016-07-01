
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá las facturas!</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('Numero') ?></th>
            <th><?= $this->Paginator->sort('Proveedor') ?></th>
            <th><?= $this->Paginator->sort('Associación') ?></th>
            <th><?= $this->Paginator->sort('Resposable') ?></th>
            <th><?= $this->Paginator->sort('Monto') ?></th>
            <th><?= $this->Paginator->sort('Estado') ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($invoices as $key): ?>
            <tr>
                <td><?= h($key->number) ?></td>
                <td><?= h($key->provider) ?></td>
                <td><?= $key->has('association') ? $this->Html->link($key->association->name, ['controller' => 'Associations', 'action' => 'view', $key->association->id]) : '' ?></td>
                <td><?= h($key->attendant) ?></td>
                <td><?= h($key->amount) ?></td>
                <?php
                  if($key->state == 0){
                    echo "<td> Sin aprobar </td>";
                  }else{
                    echo "<td> Aprobada </td>";
                  }
                ?>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'admin_modify_invoice', $key->id], ['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $key->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger' ,'confirm' => __('¿Estás seguro de que deseas borrarlo? # {0}?', $key->id)]) ?>
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

