<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OtherExpense $otherExpense
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Other Expense'), ['action' => 'edit', $otherExpense->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Other Expense'), ['action' => 'delete', $otherExpense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $otherExpense->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Other Expenses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Other Expense'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expenses'), ['controller' => 'Expenses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense'), ['controller' => 'Expenses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="otherExpenses view large-9 medium-8 columns content">
    <h3><?= h($otherExpense->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Expense') ?></th>
            <td><?= $otherExpense->has('expense') ? $this->Html->link($otherExpense->expense->id, ['controller' => 'Expenses', 'action' => 'view', $otherExpense->expense->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($otherExpense->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($otherExpense->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fare') ?></th>
            <td><?= $this->Number->format($otherExpense->fare) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($otherExpense->voucher_no) ?></td>
        </tr>
    </table>
</div>
