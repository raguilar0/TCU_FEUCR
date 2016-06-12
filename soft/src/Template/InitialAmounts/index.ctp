<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Initial Amount'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tracts'), ['controller' => 'Tracts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tract'), ['controller' => 'Tracts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="initialAmounts index large-9 medium-8 columns content">
    <h3><?= __('Initial Amounts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('amount') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('association_id') ?></th>
                <th><?= $this->Paginator->sort('tract_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($initialAmounts as $initialAmount): ?>
            <tr>
                <td><?= $this->Number->format($initialAmount->id) ?></td>
                <td><?= $this->Number->format($initialAmount->amount) ?></td>
                <td><?= $this->Number->format($initialAmount->type) ?></td>
                <td><?= h($initialAmount->date) ?></td>
                <td><?= $initialAmount->has('association') ? $this->Html->link($initialAmount->association->name, ['controller' => 'Associations', 'action' => 'view', $initialAmount->association->id]) : '' ?></td>
                <td><?= $initialAmount->has('tract') ? $this->Html->link($initialAmount->tract->id, ['controller' => 'Tracts', 'action' => 'view', $initialAmount->tract->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $initialAmount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $initialAmount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $initialAmount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initialAmount->id)]) ?>
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
