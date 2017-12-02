<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WorkType $workType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Work Type'), ['action' => 'edit', $workType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Work Type'), ['action' => 'delete', $workType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Work Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Plans'), ['controller' => 'WorkPlans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Plan'), ['controller' => 'WorkPlans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Reports'), ['controller' => 'WorkReports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Report'), ['controller' => 'WorkReports', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workTypes view large-9 medium-8 columns content">
    <h3><?= h($workType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($workType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= h($workType->color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($workType->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Work Plans') ?></h4>
        <?php if (!empty($workType->work_plans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Work Type Id') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Doctor Id') ?></th>
                <th scope="col"><?= __('Plan Reason') ?></th>
                <th scope="col"><?= __('Plan Details') ?></th>
                <th scope="col"><?= __('Is Completed') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workType->work_plans as $workPlans): ?>
            <tr>
                <td><?= h($workPlans->id) ?></td>
                <td><?= h($workPlans->user_id) ?></td>
                <td><?= h($workPlans->work_type_id) ?></td>
                <td><?= h($workPlans->start_date) ?></td>
                <td><?= h($workPlans->end_date) ?></td>
                <td><?= h($workPlans->city_id) ?></td>
                <td><?= h($workPlans->doctor_id) ?></td>
                <td><?= h($workPlans->plan_reason) ?></td>
                <td><?= h($workPlans->plan_details) ?></td>
                <td><?= h($workPlans->is_completed) ?></td>
                <td><?= h($workPlans->is_deleted) ?></td>
                <td><?= h($workPlans->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WorkPlans', 'action' => 'view', $workPlans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WorkPlans', 'action' => 'edit', $workPlans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WorkPlans', 'action' => 'delete', $workPlans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workPlans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Work Reports') ?></h4>
        <?php if (!empty($workType->work_reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Work Type Id') ?></th>
                <th scope="col"><?= __('Plan Id') ?></th>
                <th scope="col"><?= __('Strart Date') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Doctor Id') ?></th>
                <th scope="col"><?= __('Report Details') ?></th>
                <th scope="col"><?= __('Is Missed') ?></th>
                <th scope="col"><?= __('Is Completed') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workType->work_reports as $workReports): ?>
            <tr>
                <td><?= h($workReports->id) ?></td>
                <td><?= h($workReports->user_id) ?></td>
                <td><?= h($workReports->work_type_id) ?></td>
                <td><?= h($workReports->plan_id) ?></td>
                <td><?= h($workReports->strart_date) ?></td>
                <td><?= h($workReports->city_id) ?></td>
                <td><?= h($workReports->doctor_id) ?></td>
                <td><?= h($workReports->report_details) ?></td>
                <td><?= h($workReports->is_missed) ?></td>
                <td><?= h($workReports->is_completed) ?></td>
                <td><?= h($workReports->is_deleted) ?></td>
                <td><?= h($workReports->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WorkReports', 'action' => 'view', $workReports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WorkReports', 'action' => 'edit', $workReports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WorkReports', 'action' => 'delete', $workReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workReports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
