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
            <th><?= $this->Paginator->sort('amount',['Monto']) ?></th>
            <th><?= $this->Paginator->sort('date',['Fecha']) ?></th>
            <th><?= $this->Paginator->sort('state',['Estado']) ?></th>
            <th><?= $this->Paginator->sort('letter',['Carta']) ?></th>
            <th><?= $this->Paginator->sort('association_id',['Asociación']) ?></th>
            <th><?= $this->Paginator->sort('tract',['Tracto']) ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($savings as $saving): ?>
            <tr>
                <td><?= $this->Number->format($saving->amount) ?></td>
                <td><?= $saving->date?></td>
                <td><?php  
                    switch ($this->Number->format($saving->state)) {
                        case 0:
                            echo "Pendiente";
                            break;
                        case 1:
                            echo "Aceptado";
                            break;
                        case 2:
                            echo "Rechazado";
                            break;
                    }
                    
                    
                
                
                ?>
                </td>
                <td><?= $this->Html->link( $saving->letter,['controller'=>'Savings', 'action'=>'download', $saving->letter]);?></td>
                <td><?= $saving->has('association') ? $this->Html->link($saving->association->name, ['controller' => 'Associations', 'action' => 'view', $saving->association->id]) : '' ?></td>
                <td><?= $saving->has('tract') ? $this->Html->link($saving->tract->date." - ".$saving->tract->deadline, ['controller' => 'Tracts', 'action' => 'view', $saving->tract->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $saving->id],['class'=>'glyphicon glyphicon-eye-open btn btn-info' ]) ?>
                    <?php
                    if(($this->request->session()->read('Auth.User.role')) == 'admin'){
                      echo $this->Html->link('', ['action' => 'edit', $saving->id],['class'=>'glyphicon glyphicon-pencil btn btn-primary' ]);
                    }
                    ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $saving->id], ['class'=>'glyphicon glyphicon-remove btn btn-danger','confirm' => __('¿Estás seguro de que desea borrar este monto # {0}?', $saving->id)]) ?>
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
