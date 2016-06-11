<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tract'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Amounts'), ['controller' => 'Amounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Amount'), ['controller' => 'Amounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Boxes'), ['controller' => 'Boxes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Box'), ['controller' => 'Boxes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Initial Amounts'), ['controller' => 'InitialAmounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Initial Amount'), ['controller' => 'InitialAmounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tracts index large-9 medium-8 columns content">
    <h3><?= __('Tracts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('number') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('deadline') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
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
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tract->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tract->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tract->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tract->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
