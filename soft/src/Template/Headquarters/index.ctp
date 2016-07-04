
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
                    <?= $this->Html->link('', ['action' => 'view', $headquarters->id], ['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]) ?>
                    <?= $this->Html->link('',['action' => 'edit', $headquarters->id], ['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $headquarters->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger', 'confirm' => __('Estas seguro que deseas borrarlo? # {0}?', $headquarters->id)]) ?>
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
