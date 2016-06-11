<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Initial Amount'), ['action' => 'edit', $initialAmount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Initial Amount'), ['action' => 'delete', $initialAmount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initialAmount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Initial Amounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Initial Amount'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tracts'), ['controller' => 'Tracts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tract'), ['controller' => 'Tracts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="initialAmounts view large-9 medium-8 columns content">
    <h3><?= h($initialAmount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Association') ?></th>
            <td><?= $initialAmount->has('association') ? $this->Html->link($initialAmount->association->name, ['controller' => 'Associations', 'action' => 'view', $initialAmount->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tract') ?></th>
            <td><?= $initialAmount->has('tract') ? $this->Html->link($initialAmount->tract->id, ['controller' => 'Tracts', 'action' => 'view', $initialAmount->tract->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($initialAmount->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Amount') ?></th>
            <td><?= $this->Number->format($initialAmount->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($initialAmount->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($initialAmount->date) ?></td>
        </tr>
    </table>
</div>
