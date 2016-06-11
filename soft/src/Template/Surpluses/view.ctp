<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Surplus'), ['action' => 'edit', $surplus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Surplus'), ['action' => 'delete', $surplus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surplus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Surpluses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Surplus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="surpluses view large-9 medium-8 columns content">
    <h3><?= h($surplus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Detail') ?></th>
            <td><?= h($surplus->detail) ?></td>
        </tr>
        <tr>
            <th><?= __('Association') ?></th>
            <td><?= $surplus->has('association') ? $this->Html->link($surplus->association->name, ['controller' => 'Associations', 'action' => 'view', $surplus->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($surplus->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Amount') ?></th>
            <td><?= $this->Number->format($surplus->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($surplus->date) ?></td>
        </tr>
    </table>
</div>
