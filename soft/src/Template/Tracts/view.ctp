<div class="row text-center">
    <div class="col-xs-12">
        <h1>Información del tracto #<?= h($tract->id) ?></h1>
    </div>

</div>
<br>
<br>

<div class="table-responsive">
    <table class="table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tract->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Número') ?></th>
            <td><?= $this->Number->format($tract->number) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha de Inicio') ?></th>
            <td><?= h($tract->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha de Finalización') ?></th>
            <td><?= h($tract->deadline) ?></td>
        </tr>
    </table>
</div>


    <div class="table-responsive">
        <h4>Montos Relacionados</h4>
        <?php if (!empty($tract->amounts)): ?>
        <table class="table">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Detail') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Association Id') ?></th>
                <th><?= __('Tract Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tract->amounts as $amounts): ?>
            <tr>
                <td><?= h($amounts->id) ?></td>
                <td><?= h($amounts->amount) ?></td>
                <td><?= h($amounts->date) ?></td>
                <td><?= h($amounts->detail) ?></td>
                <td><?= h($amounts->type) ?></td>
                <td><?= h($amounts->association_id) ?></td>
                <td><?= h($amounts->tract_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Amounts', 'action' => 'view', $amounts->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Amounts', 'action' => 'edit', $amounts->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['controller' => 'Amounts', 'action' => 'delete', $amounts->id], ['confirm' => __('Seguro de que desea borrar el monto # {0}?', $amounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <h4>Montos iniciales relacionados</h4>
        <?php if (!empty($tract->initial_amounts)): ?>
        <table class="table">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Association Id') ?></th>
                <th><?= __('Tract Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tract->initial_amounts as $initialAmounts): ?>
            <tr>
                <td><?= h($initialAmounts->id) ?></td>
                <td><?= h($initialAmounts->amount) ?></td>
                <td><?= h($initialAmounts->type) ?></td>
                <td><?= h($initialAmounts->date) ?></td>
                <td><?= h($initialAmounts->association_id) ?></td>
                <td><?= h($initialAmounts->tract_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'InitialAmounts', 'action' => 'view', $initialAmounts->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'InitialAmounts', 'action' => 'edit', $initialAmounts->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['controller' => 'InitialAmounts', 'action' => 'delete', $initialAmounts->id], ['confirm' => __('Seguro de que desea borrar el monto inicial # {0}?', $initialAmounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>



