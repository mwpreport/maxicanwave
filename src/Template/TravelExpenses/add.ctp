<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TravelExpense $travelExpense
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Travel Expenses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expenses'), ['controller' => 'Expenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expense'), ['controller' => 'Expenses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="travelExpenses form large-9 medium-8 columns content">
    <?= $this->Form->create($travelExpense) ?>
    <fieldset>
        <legend><?= __('Add Travel Expense') ?></legend>
        <?php
            echo $this->Form->control('expense_id', ['options' => $expenses]);
            echo $this->Form->control('city_from');
            echo $this->Form->control('city_to');
            echo $this->Form->control('km');
            echo $this->Form->control('fare');
            echo $this->Form->control('travel_mode');
            echo $this->Form->control('started');
            echo $this->Form->control('reached');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
