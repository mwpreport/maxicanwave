<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clas $clas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clas'), ['action' => 'edit', $clas->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clas'), ['action' => 'delete', $clas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clas->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Class'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clas'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="class view large-9 medium-8 columns content">
    <h3><?= h($clas->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($clas->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clas->id) ?></td>
        </tr>
    </table>
</div>
