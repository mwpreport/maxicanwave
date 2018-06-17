<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OtherExpense $otherExpense
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $otherExpense->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $otherExpense->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Other Expenses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expenses'), ['controller' => 'Expenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expense'), ['controller' => 'Expenses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="otherExpenses form large-9 medium-8 columns content">
    <?= $this->Form->create($otherExpense) ?>
    <fieldset>
        <legend><?= __('Edit Other Expense') ?></legend>
        <?php
            echo $this->Form->control('expense_id', ['options' => $expenses]);
            echo $this->Form->control('description');
            echo $this->Form->control('fare');
            echo $this->Form->control('voucher_no');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
