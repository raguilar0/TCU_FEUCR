
<div class="row text-center">
    <div class="col-xs-12">
        <h1>¡Administrá los montos!</h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('amount',['label'=>'Monto']) ?></th>
            <th><?= $this->Paginator->sort('type',['label'=>'Tipo']) ?></th>
            <th><?= $this->Paginator->sort('date',['label'=>'Fecha de asignación']) ?></th>
            <th><?= $this->Paginator->sort('detail',['label'=>'Detalle']) ?></th>
            <th><?= $this->Paginator->sort('association_id', ['Asoaciación']) ?></th>
            <th><?= $this->Paginator->sort('tract_id', ['label'=>'Tracto']) ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($amounts as $amount): ?>
            <tr>
                <td><?= "¢ ".number_format($amount->amount,2,".",",") ?></td>
                <td><?= $amount->type ? 'Ingresos Generados': 'Tracto' ;?></td>
                <td><?= h($amount->date) ?></td>
                <td><?= $amount->detail ?></td>
                <td><?= $amount->has('association') ? $this->Html->link($amount->association->name, ['controller' => 'Associations', 'action' => 'view', $amount->association->id]) : '' ?></td>
                <td><?= $amount->has('tract') ? $this->Html->link($amount->tract->date." - ".$amount->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $amount->tract->id]) : '' ?></td>
                <td class="actions">
                    <?php
                        if(($this->request->session()->read('Auth.User.role')) != 'rep'){
                            echo $this->Html->link('', ['action' => 'view', $amount->id],['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]);
                            
                        }
                    ?>
                    <?= $this->Html->link('', ['action' => 'edit', $amount->id],['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]) ?>
                    
                    <?php
                        if(($this->request->session()->read('Auth.User.role')) == 'rep')
                        {
                            echo $this->Form->postLink('', ['action' => 'delete', $amount->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('¿Estás seguro de que deseas borrarlo? # {0}?', $amount->id)]);
                        }
                    ?>
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

