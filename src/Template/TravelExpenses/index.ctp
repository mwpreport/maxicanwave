<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TravelExpense[]|\Cake\Collection\CollectionInterface $travelExpenses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Travel Expense'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expenses'), ['controller' => 'Expenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expense'), ['controller' => 'Expenses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="travelExpenses index large-9 medium-8 columns content">
    <h3><?= __('Travel Expenses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expense_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('km') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fare') ?></th>
                <th scope="col"><?= $this->Paginator->sort('travel_mode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('started') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reached') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($travelExpenses as $travelExpense): ?>
            <tr>
                <td><?= $this->Number->format($travelExpense->id) ?></td>
                <td><?= $travelExpense->has('expense') ? $this->Html->link($travelExpense->expense->id, ['controller' => 'Expenses', 'action' => 'view', $travelExpense->expense->id]) : '' ?></td>
                <td><?= $this->Number->format($travelExpense->city_from) ?></td>
                <td><?= $this->Number->format($travelExpense->city_to) ?></td>
                <td><?= $this->Number->format($travelExpense->km) ?></td>
                <td><?= $this->Number->format($travelExpense->fare) ?></td>
                <td><?= h($travelExpense->travel_mode) ?></td>
                <td><?= h($travelExpense->started) ?></td>
                <td><?= h($travelExpense->reached) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $travelExpense->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $travelExpense->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $travelExpense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $travelExpense->id)]) ?>
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
