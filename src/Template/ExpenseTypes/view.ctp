<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpenseType $expenseType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expense Type'), ['action' => 'edit', $expenseType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expense Type'), ['action' => 'delete', $expenseType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expenseType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expense Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Daily Allowances'), ['controller' => 'DailyAllowances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Daily Allowance'), ['controller' => 'DailyAllowances', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expenseTypes view large-9 medium-8 columns content">
    <h3><?= h($expenseType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($expenseType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($expenseType->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Daily Allowances') ?></h4>
        <?php if (!empty($expenseType->daily_allowances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Expense Type Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Cost') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($expenseType->daily_allowances as $dailyAllowances): ?>
            <tr>
                <td><?= h($dailyAllowances->id) ?></td>
                <td><?= h($dailyAllowances->expense_type_id) ?></td>
                <td><?= h($dailyAllowances->role_id) ?></td>
                <td><?= h($dailyAllowances->cost) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DailyAllowances', 'action' => 'view', $dailyAllowances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DailyAllowances', 'action' => 'edit', $dailyAllowances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DailyAllowances', 'action' => 'delete', $dailyAllowances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyAllowances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
