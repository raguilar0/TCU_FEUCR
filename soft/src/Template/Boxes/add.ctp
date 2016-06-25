<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Boxes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="boxes form large-9 medium-8 columns content">
    <?= $this->Form->create($box) ?>
    <fieldset>
        <legend><?= __('Add Box') ?></legend>
        <?php
            echo $this->Form->input('little_amount');
            echo $this->Form->input('big_amount');
            echo $this->Form->input('type');
            echo $this->Form->input('association_id', ['options' => $associations]);
            echo $this->Form->input('tract_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
