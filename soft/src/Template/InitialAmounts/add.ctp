<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Initial Amounts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tracts'), ['controller' => 'Tracts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tract'), ['controller' => 'Tracts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="initialAmounts form large-9 medium-8 columns content">
    <?= $this->Form->create($initialAmount) ?>
    <fieldset>
        <legend><?= __('Add Initial Amount') ?></legend>
        <?php
            echo $this->Form->input('amount');
            echo $this->Form->input('type');
            echo $this->Form->input('date');
            echo $this->Form->input('association_id', ['options' => $associations]);
            echo $this->Form->input('tract_id', ['options' => $tracts]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
