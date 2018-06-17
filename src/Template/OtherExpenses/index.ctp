<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OtherExpense[]|\Cake\Collection\CollectionInterface $otherExpenses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Other Expense'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expenses'), ['controller' => 'Expenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expense'), ['controller' => 'Expenses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="otherExpenses index large-9 medium-8 columns content">
    <h3><?= __('Other Expenses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expense_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fare') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($otherExpenses as $otherExpense): ?>
            <tr>
                <td><?= $this->Number->format($otherExpense->id) ?></td>
                <td><?= $otherExpense->has('expense') ? $this->Html->link($otherExpense->expense->id, ['controller' => 'Expenses', 'action' => 'view', $otherExpense->expense->id]) : '' ?></td>
                <td><?= h($otherExpense->description) ?></td>
                <td><?= $this->Number->format($otherExpense->fare) ?></td>
                <td><?= $this->Number->format($otherExpense->voucher_no) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $otherExpense->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $otherExpense->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $otherExpense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $otherExpense->id)]) ?>
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
