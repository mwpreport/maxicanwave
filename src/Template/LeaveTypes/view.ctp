<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveType $leaveType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Leave Type'), ['action' => 'edit', $leaveType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Leave Type'), ['action' => 'delete', $leaveType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Leave Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Leave Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="leaveTypes view large-9 medium-8 columns content">
    <h3><?= h($leaveType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($leaveType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($leaveType->id) ?></td>
        </tr>
    </table>
</div>
