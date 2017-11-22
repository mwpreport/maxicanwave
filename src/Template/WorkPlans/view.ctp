<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WorkPlan $workPlan
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Work Plan'), ['action' => 'edit', $workPlan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Work Plan'), ['action' => 'delete', $workPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workPlan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Work Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Plan'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Types'), ['controller' => 'WorkTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Type'), ['controller' => 'WorkTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Doctors'), ['controller' => 'Doctors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Doctor'), ['controller' => 'Doctors', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workPlans view large-9 medium-8 columns content">
    <h3><?= h($workPlan->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $workPlan->has('user') ? $this->Html->link($workPlan->user->id, ['controller' => 'Users', 'action' => 'view', $workPlan->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Work Type') ?></th>
            <td><?= $workPlan->has('work_type') ? $this->Html->link($workPlan->work_type->name, ['controller' => 'WorkTypes', 'action' => 'view', $workPlan->work_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $workPlan->has('city') ? $this->Html->link($workPlan->city->id, ['controller' => 'Cities', 'action' => 'view', $workPlan->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Doctor') ?></th>
            <td><?= $workPlan->has('doctor') ? $this->Html->link($workPlan->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $workPlan->doctor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plan Reason') ?></th>
            <td><?= h($workPlan->plan_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($workPlan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Completed') ?></th>
            <td><?= $this->Number->format($workPlan->is_completed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($workPlan->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($workPlan->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($workPlan->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt') ?></th>
            <td><?= h($workPlan->dt) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Plan Details') ?></h4>
        <?= $this->Text->autoParagraph(h($workPlan->plan_details)); ?>
    </div>
</div>
