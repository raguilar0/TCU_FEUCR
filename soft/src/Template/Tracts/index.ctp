<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá las fechas tractos!</h1>
    </div>

</div>
<br>
<br>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('Número de tracto') ?></th>
                <th><?= $this->Paginator->sort('Fecha de inicio') ?></th>
                <th><?= $this->Paginator->sort('Fecha de finalización') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tracts as $tract): ?>
                <tr>
                    <td><?= $this->Number->format($tract->id) ?></td>
                    <td><?= $this->Number->format($tract->number) ?></td>
                    <td><?= h($tract->date) ?></td>
                    <td><?= h($tract->deadline) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $tract->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $tract->id]) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $tract->id], ['confirm' => __('Estás seguro de que deseas borrar esta fechas # {0}?', $tract->id)]) ?>
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

