<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Saving'), ['action' => 'edit', $saving->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Saving'), ['action' => 'delete', $saving->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saving->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Savings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Saving'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="savings view large-9 medium-8 columns content">
    <h3><?= h($saving->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Association') ?></th>
            <td><?= $saving->has('association') ? $this->Html->link($saving->association->name, ['controller' => 'Associations', 'action' => 'view', $saving->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($saving->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Amount') ?></th>
            <td><?= $this->Number->format($saving->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $this->Number->format($saving->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($saving->date) ?></td>
        </tr>
    </table>
</div>
