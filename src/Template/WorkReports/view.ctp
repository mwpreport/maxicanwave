<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WorkReport $workReport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Work Report'), ['action' => 'edit', $workReport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Work Report'), ['action' => 'delete', $workReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workReport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Work Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Report'), ['action' => 'add']) ?> </li>
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
<div class="workReports view large-9 medium-8 columns content">
    <h3><?= h($workReport->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $workReport->has('user') ? $this->Html->link($workReport->user->id, ['controller' => 'Users', 'action' => 'view', $workReport->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Work Type') ?></th>
            <td><?= $workReport->has('work_type') ? $this->Html->link($workReport->work_type->name, ['controller' => 'WorkTypes', 'action' => 'view', $workReport->work_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $workReport->has('city') ? $this->Html->link($workReport->city->id, ['controller' => 'Cities', 'action' => 'view', $workReport->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Doctor') ?></th>
            <td><?= $workReport->has('doctor') ? $this->Html->link($workReport->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $workReport->doctor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($workReport->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Missed') ?></th>
            <td><?= $this->Number->format($workReport->is_missed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Completed') ?></th>
            <td><?= $this->Number->format($workReport->is_completed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($workReport->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plan Id') ?></th>
            <td><?= h($workReport->plan_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Strart Date') ?></th>
            <td><?= h($workReport->strart_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt') ?></th>
            <td><?= h($workReport->dt) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Report Details') ?></h4>
        <?= $this->Text->autoParagraph(h($workReport->report_details)); ?>
    </div>
</div>
