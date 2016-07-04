
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá las asociaciones!</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('acronym',['label'=>'Sigla']) ?></th>
                <th><?= $this->Paginator->sort('name',['label'=>'Nombre']) ?></th>
                <th><?= $this->Paginator->sort('location',['label'=>'Dirección']) ?></th>
                <th><?= $this->Paginator->sort('schedule',['label'=>'Horario']) ?></th>
                <th><?= $this->Paginator->sort('authorized_card',['label'=>'Tarjeta autorizada']) ?></th>
                <th><?= $this->Paginator->sort('enable',['label'=>'Estado']) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($associations as $association): ?>
            <tr>
                <td><?= h($association->acronym) ?></td>
                <td><?= h($association->name) ?></td>
                <td><?= h($association->location) ?></td>
                <td><?= h($association->schedule) ?></td>
                <td><?= ($this->Number->format($association->authorized_card) ? 'Aprobada': 'Reprobada' ); ?></td>
                <td><?= ($this->Number->format($association->enable) ? 'Habilitada': 'Deshabilitada' ); ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $association->id],['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $association->id],['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $association->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('Estas seguro que deseas borrarlo? # {0}?', $association->id)]) ?>
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
