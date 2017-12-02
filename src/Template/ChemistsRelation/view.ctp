<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChemistsRelation $chemistsRelation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Chemists Relation'), ['action' => 'edit', $chemistsRelation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Chemists Relation'), ['action' => 'delete', $chemistsRelation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chemistsRelation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Chemists Relation'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chemists Relation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Chemists'), ['controller' => 'Chemists', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chemist'), ['controller' => 'Chemists', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="chemistsRelation view large-9 medium-8 columns content">
    <h3><?= h($chemistsRelation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $chemistsRelation->has('user') ? $this->Html->link($chemistsRelation->user->id, ['controller' => 'Users', 'action' => 'view', $chemistsRelation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Chemist') ?></th>
            <td><?= $chemistsRelation->has('chemist') ? $this->Html->link($chemistsRelation->chemist->name, ['controller' => 'Chemists', 'action' => 'view', $chemistsRelation->chemist->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($chemistsRelation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class') ?></th>
            <td><?= $this->Number->format($chemistsRelation->class) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($chemistsRelation->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt') ?></th>
            <td><?= h($chemistsRelation->dt) ?></td>
        </tr>
    </table>
</div>
