<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tract->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tract->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tracts'), ['action' => 'index']) ?></li>
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
<div class="tracts form large-9 medium-8 columns content">
    <?= $this->Form->create($tract) ?>
    <fieldset>
        <legend><?= __('Edit Tract') ?></legend>
        <?php
            echo $this->Form->input('number');
            echo $this->Form->input('date');
            echo $this->Form->input('deadline');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
