
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá las sedes!</h1>
    </div>

</div>
<br>
<br>
<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name',['label'=>'Nombre']) ?></th>
                <th><?= $this->Paginator->sort('image_name','Nombre de la imagen') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($headquarters as $headquarters): ?>
            <tr>
                <td><?= h($headquarters->name) ?></td>
                <td><?= h($headquarters->image_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $headquarters->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $headquarters->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $headquarters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $headquarters->id)]) ?>
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
