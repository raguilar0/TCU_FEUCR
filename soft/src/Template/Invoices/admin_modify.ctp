
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
            <th> Número</th>
            <th><?= $this->Paginator->sort('kind', ['label'=>'Tipo']) ?></th>
            <th><?= $this->Paginator->sort('date', ['label'=>'Fecha']) ?></th>
            <th><?= $this->Paginator->sort('association',['label'=>'Asociación']) ?></th>
            <th><?= $this->Paginator->sort('amount',['label'=>'Monto']) ?></th>

            <th><?= $this->Paginator->sort('state',['label'=>'Estado']) ?></th>
            <th><?= $this->Paginator->sort('tract_id',['label'=>'Tracto']) ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($invoices as $key): ?>

            <tr>
                <td><?= h($key->number) ?></td>
                 <?php
                    switch ($key->kind) {
                    case 0:
                        echo "<td> Tracto </td>";
                        break;
                    case 1:
                         echo "<td> Ing.Gen. </td>";
                         break;
                    default:
                        echo "<td> Superavit </td>";
                        break;

                    }

                ?>
                <td><?= $key->date ?></td>
                <td><?= $key->has('association') ? $this->Html->link($key->association->name, ['controller' => 'Associations', 'action' => 'view', $key->association->id]) : '' ?></td>
                <td><?= h($key->amount) ?></td>
                <?php
                    switch ($key->state) {
                    case 0:
                        echo "<td> Pendiente </td>";
                        break;
                    case 1:
                         echo "<td> Aprobada </td>";
                         break;
                    default:
                        echo "<td> Rechazada </td>";
                        break;

                    }

                ?>
                <td><?= $key->has('tract') ? $this->Html->link($key->tract->date." - ".$key->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $key->tract->id]) : '' ?></td>
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
