<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Box'), ['action' => 'edit', $box->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Box'), ['action' => 'delete', $box->id], ['confirm' => __('Are you sure you want to delete # {0}?', $box->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Boxes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Box'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="boxes view large-9 medium-8 columns content">
    <h3><?= h($box->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Association') ?></th>
            <td><?= $box->has('association') ? $this->Html->link($box->association->name, ['controller' => 'Associations', 'action' => 'view', $box->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($box->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Little Amount') ?></th>
            <td><?= $this->Number->format($box->little_amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Big Amount') ?></th>
            <td><?= $this->Number->format($box->big_amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($box->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Tract Id') ?></th>
            <td><?= $this->Number->format($box->tract_id) ?></td>
        </tr>
    </table>
</div>
