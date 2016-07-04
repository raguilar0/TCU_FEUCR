<div class="row text-center">
	<div class="col-xs-12">
		<h1>Administración de cajas</h1>
	</div>
</div>
<br>
<br>

<div class="boxes index large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table read_association">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('association_id',['label'=>'Asociación']) ?></th>
                <th><?= $this->Paginator->sort('little_amount',['label'=>'Caja chica']) ?></th>
                <th><?= $this->Paginator->sort('big_amount',['label'=>'Caja fuerte']) ?></th>
                <th><?= $this->Paginator->sort('type',['label'=>'Tipo']) ?></th>
                <th><?= $this->Paginator->sort('tract_id',['label'=>'Tracto']) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boxes as $box): ?>
            <tr>
                <td><?= $box->has('association') ? $this->Html->link($box->association->name, ['controller' => 'Associations', 'action' => 'view', $box->association->id]) : '' ?></td>
                <td><?= $this->Number->format($box->little_amount) ?></td>
                <td><?= $this->Number->format($box->big_amount) ?></td>
                <?php if($box->type== 0){
                    echo "<td>Tracto</td>";
                }else{
                    echo "<td>Ing. Generados</td>";
                }?>
                <td><?= $box->has('tract') ? $this->Html->link($box->tract->date." - ".$box->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $box->tract->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__(''), ['action' => 'edit', $box->id], ['class'=>'glyphicon glyphicon-pencil btn btn-primary']) ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $box->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $box->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
