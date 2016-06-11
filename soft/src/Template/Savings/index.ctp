<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Saving'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="savings index large-9 medium-8 columns content">
    <h3><?= __('Savings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('amount') ?></th>
                <th><?= $this->Paginator->sort('state') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('association_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($savings as $saving): ?>
            <tr>
                <td><?= $this->Number->format($saving->id) ?></td>
                <td><?= $this->Number->format($saving->amount) ?></td>
                <td><?= $this->Number->format($saving->state) ?></td>
                <td><?= h($saving->date) ?></td>
                <td><?= $saving->has('association') ? $this->Html->link($saving->association->name, ['controller' => 'Associations', 'action' => 'view', $saving->association->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $saving->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $saving->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $saving->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saving->id)]) ?>
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
