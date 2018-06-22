<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpenseApproval[]|\Cake\Collection\CollectionInterface $expenseApprovals
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Expense Approval'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expenseApprovals index large-9 medium-8 columns content">
    <h3><?= __('Expense Approvals') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lead_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_approved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_rejected') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($expenseApprovals as $expenseApproval): ?>
            <tr>
                <td><?= $this->Number->format($expenseApproval->id) ?></td>
                <td><?= h($expenseApproval->date) ?></td>
                <td><?= $expenseApproval->has('user') ? $this->Html->link($expenseApproval->user->firstname, ['controller' => 'Users', 'action' => 'view', $expenseApproval->user->id]) : '' ?></td>
                <td><?= $this->Number->format($expenseApproval->lead_id) ?></td>
                <td><?= $this->Number->format($expenseApproval->is_approved) ?></td>
                <td><?= $this->Number->format($expenseApproval->is_rejected) ?></td>
                <td><?= h($expenseApproval->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $expenseApproval->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expenseApproval->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $expenseApproval->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expenseApproval->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
