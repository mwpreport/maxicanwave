<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpenseApproval $expenseApproval
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Expense Approvals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expenseApprovals form large-9 medium-8 columns content">
    <?= $this->Form->create($expenseApproval) ?>
    <fieldset>
        <legend><?= __('Add Expense Approval') ?></legend>
        <?php
            echo $this->Form->control('date', ['empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('lead_id');
            echo $this->Form->control('is_approved');
            echo $this->Form->control('is_rejected');
            echo $this->Form->control('dt');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
