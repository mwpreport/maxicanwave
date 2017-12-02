<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DoctorsRelation $doctorsRelation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Doctors Relation'), ['action' => 'edit', $doctorsRelation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Doctors Relation'), ['action' => 'delete', $doctorsRelation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doctorsRelation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Doctors Relation'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Doctors Relation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Doctors'), ['controller' => 'Doctors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Doctor'), ['controller' => 'Doctors', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="doctorsRelation view large-9 medium-8 columns content">
    <h3><?= h($doctorsRelation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $doctorsRelation->has('user') ? $this->Html->link($doctorsRelation->user->id, ['controller' => 'Users', 'action' => 'view', $doctorsRelation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Doctor') ?></th>
            <td><?= $doctorsRelation->has('doctor') ? $this->Html->link($doctorsRelation->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $doctorsRelation->doctor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($doctorsRelation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class') ?></th>
            <td><?= $this->Number->format($doctorsRelation->class) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($doctorsRelation->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt') ?></th>
            <td><?= h($doctorsRelation->dt) ?></td>
        </tr>
    </table>
</div>
