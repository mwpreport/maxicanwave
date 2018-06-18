<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense $expense
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expense'), ['action' => 'edit', $expense->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expense'), ['action' => 'delete', $expense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expense->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expenses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Plan Submit'), ['controller' => 'WorkPlanSubmit', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Plan Submit'), ['controller' => 'WorkPlanSubmit', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expense Types'), ['controller' => 'ExpenseTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense Type'), ['controller' => 'ExpenseTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Other Expenses'), ['controller' => 'OtherExpenses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Other Expense'), ['controller' => 'OtherExpenses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Travel Expenses'), ['controller' => 'TravelExpenses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Travel Expense'), ['controller' => 'TravelExpenses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expenses view large-9 medium-8 columns content">
    <h3><?= h($expense->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $expense->has('user') ? $this->Html->link($expense->user->firstname, ['controller' => 'Users', 'action' => 'view', $expense->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Work Plan Submit') ?></th>
            <td><?= $expense->has('work_plan_submit') ? $this->Html->link($expense->work_plan_submit->id, ['controller' => 'WorkPlanSubmit', 'action' => 'view', $expense->work_plan_submit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expense Type') ?></th>
            <td><?= $expense->has('expense_type') ? $this->Html->link($expense->expense_type->name, ['controller' => 'ExpenseTypes', 'action' => 'view', $expense->expense_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($expense->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Daily Allowance') ?></th>
            <td><?= $this->Number->format($expense->daily_allowance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expense Date') ?></th>
            <td><?= h($expense->expense_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($expense->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($expense->updated) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Other Expenses') ?></h4>
        <?php if (!empty($expense->other_expenses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Expense Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Fare') ?></th>
                <th scope="col"><?= __('Voucher No') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($expense->other_expenses as $otherExpenses): ?>
            <tr>
                <td><?= h($otherExpenses->id) ?></td>
                <td><?= h($otherExpenses->expense_id) ?></td>
                <td><?= h($otherExpenses->description) ?></td>
                <td><?= h($otherExpenses->fare) ?></td>
                <td><?= h($otherExpenses->voucher_no) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OtherExpenses', 'action' => 'view', $otherExpenses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OtherExpenses', 'action' => 'edit', $otherExpenses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OtherExpenses', 'action' => 'delete', $otherExpenses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $otherExpenses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Travel Expenses') ?></h4>
        <?php if (!empty($expense->travel_expenses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Expense Id') ?></th>
                <th scope="col"><?= __('City From') ?></th>
                <th scope="col"><?= __('City To') ?></th>
                <th scope="col"><?= __('Km') ?></th>
                <th scope="col"><?= __('Fare') ?></th>
                <th scope="col"><?= __('Travel Mode') ?></th>
                <th scope="col"><?= __('Started') ?></th>
                <th scope="col"><?= __('Reached') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($expense->travel_expenses as $travelExpenses): ?>
            <tr>
                <td><?= h($travelExpenses->id) ?></td>
                <td><?= h($travelExpenses->expense_id) ?></td>
                <td><?= h($travelExpenses->city_from) ?></td>
                <td><?= h($travelExpenses->city_to) ?></td>
                <td><?= h($travelExpenses->km) ?></td>
                <td><?= h($travelExpenses->fare) ?></td>
                <td><?= h($travelExpenses->travel_mode) ?></td>
                <td><?= h($travelExpenses->started) ?></td>
                <td><?= h($travelExpenses->reached) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TravelExpenses', 'action' => 'view', $travelExpenses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TravelExpenses', 'action' => 'edit', $travelExpenses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TravelExpenses', 'action' => 'delete', $travelExpenses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $travelExpenses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
