<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense $expense
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Expenses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Work Plan Submit'), ['controller' => 'WorkPlanSubmit', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work Plan Submit'), ['controller' => 'WorkPlanSubmit', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expense Types'), ['controller' => 'ExpenseTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expense Type'), ['controller' => 'ExpenseTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Other Expenses'), ['controller' => 'OtherExpenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Other Expense'), ['controller' => 'OtherExpenses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Travel Expenses'), ['controller' => 'TravelExpenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Travel Expense'), ['controller' => 'TravelExpenses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expenses form large-9 medium-8 columns content">
    <?= $this->Form->create($expense) ?>
    <fieldset>
        <legend><?= __('Add Expense') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('work_plan_submit_id', ['options' => $workPlanSubmit]);
            echo $this->Form->control('expense_date');
            echo $this->Form->control('expense_type_id', ['options' => $expenseTypes]);
            echo $this->Form->control('daily_allowance');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
