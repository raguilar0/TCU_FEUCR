<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tract'), ['action' => 'edit', $tract->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tract'), ['action' => 'delete', $tract->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tract->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tracts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tract'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Amounts'), ['controller' => 'Amounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Amount'), ['controller' => 'Amounts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Boxes'), ['controller' => 'Boxes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Box'), ['controller' => 'Boxes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Initial Amounts'), ['controller' => 'InitialAmounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Initial Amount'), ['controller' => 'InitialAmounts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tracts view large-9 medium-8 columns content">
    <h3><?= h($tract->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tract->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Number') ?></th>
            <td><?= $this->Number->format($tract->number) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($tract->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Deadline') ?></th>
            <td><?= h($tract->deadline) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Amounts') ?></h4>
        <?php if (!empty($tract->amounts)): ?>
        <table cellpadding="0" cellspacing="0">
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
                    <?= $this->Html->link(__('View'), ['controller' => 'Amounts', 'action' => 'view', $amounts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Amounts', 'action' => 'edit', $amounts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Amounts', 'action' => 'delete', $amounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $amounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Boxes') ?></h4>
        <?php if (!empty($tract->boxes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Little Amount') ?></th>
                <th><?= __('Big Amount') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Association Id') ?></th>
                <th><?= __('Tract Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tract->boxes as $boxes): ?>
            <tr>
                <td><?= h($boxes->id) ?></td>
                <td><?= h($boxes->little_amount) ?></td>
                <td><?= h($boxes->big_amount) ?></td>
                <td><?= h($boxes->type) ?></td>
                <td><?= h($boxes->association_id) ?></td>
                <td><?= h($boxes->tract_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Boxes', 'action' => 'view', $boxes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Boxes', 'action' => 'edit', $boxes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Boxes', 'action' => 'delete', $boxes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $boxes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Initial Amounts') ?></h4>
        <?php if (!empty($tract->initial_amounts)): ?>
        <table cellpadding="0" cellspacing="0">
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
                    <?= $this->Html->link(__('View'), ['controller' => 'InitialAmounts', 'action' => 'view', $initialAmounts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InitialAmounts', 'action' => 'edit', $initialAmounts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InitialAmounts', 'action' => 'delete', $initialAmounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initialAmounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($tract->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Number') ?></th>
                <th><?= __('Provider') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Clarifications') ?></th>
                <th><?= __('Image Name') ?></th>
                <th><?= __('Detail') ?></th>
                <th><?= __('Kind') ?></th>
                <th><?= __('State') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Attendant') ?></th>
                <th><?= __('Association Id') ?></th>
                <th><?= __('Tract Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tract->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->id) ?></td>
                <td><?= h($invoices->number) ?></td>
                <td><?= h($invoices->provider) ?></td>
                <td><?= h($invoices->amount) ?></td>
                <td><?= h($invoices->clarifications) ?></td>
                <td><?= h($invoices->image_name) ?></td>
                <td><?= h($invoices->detail) ?></td>
                <td><?= h($invoices->kind) ?></td>
                <td><?= h($invoices->state) ?></td>
                <td><?= h($invoices->date) ?></td>
                <td><?= h($invoices->attendant) ?></td>
                <td><?= h($invoices->association_id) ?></td>
                <td><?= h($invoices->tract_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Warehouses') ?></h4>
        <?php if (!empty($tract->warehouses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Spent') ?></th>
                <th><?= __('Association Id') ?></th>
                <th><?= __('Detail') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Tract Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tract->warehouses as $warehouses): ?>
            <tr>
                <td><?= h($warehouses->id) ?></td>
                <td><?= h($warehouses->amount) ?></td>
                <td><?= h($warehouses->date) ?></td>
                <td><?= h($warehouses->spent) ?></td>
                <td><?= h($warehouses->association_id) ?></td>
                <td><?= h($warehouses->detail) ?></td>
                <td><?= h($warehouses->type) ?></td>
                <td><?= h($warehouses->tract_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Warehouses', 'action' => 'view', $warehouses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Warehouses', 'action' => 'edit', $warehouses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Warehouses', 'action' => 'delete', $warehouses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $warehouses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
