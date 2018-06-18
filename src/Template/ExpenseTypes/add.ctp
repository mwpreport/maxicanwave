<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpenseType $expenseType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Expense Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Daily Allowances'), ['controller' => 'DailyAllowances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Daily Allowance'), ['controller' => 'DailyAllowances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expenseTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($expenseType) ?>
    <fieldset>
        <legend><?= __('Add Expense Type') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
