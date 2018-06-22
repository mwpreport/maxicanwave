<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpenseApproval $expenseApproval
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expense Approval'), ['action' => 'edit', $expenseApproval->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expense Approval'), ['action' => 'delete', $expenseApproval->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expenseApproval->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expense Approvals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense Approval'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expenseApprovals view large-9 medium-8 columns content">
    <h3><?= h($expenseApproval->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $expenseApproval->has('user') ? $this->Html->link($expenseApproval->user->firstname, ['controller' => 'Users', 'action' => 'view', $expenseApproval->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($expenseApproval->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lead Id') ?></th>
            <td><?= $this->Number->format($expenseApproval->lead_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Approved') ?></th>
            <td><?= $this->Number->format($expenseApproval->is_approved) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Rejected') ?></th>
            <td><?= $this->Number->format($expenseApproval->is_rejected) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($expenseApproval->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt') ?></th>
            <td><?= h($expenseApproval->dt) ?></td>
        </tr>
    </table>
</div>
