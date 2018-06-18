<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TravelExpense $travelExpense
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Travel Expense'), ['action' => 'edit', $travelExpense->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Travel Expense'), ['action' => 'delete', $travelExpense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $travelExpense->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Travel Expenses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Travel Expense'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expenses'), ['controller' => 'Expenses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expense'), ['controller' => 'Expenses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="travelExpenses view large-9 medium-8 columns content">
    <h3><?= h($travelExpense->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Expense') ?></th>
            <td><?= $travelExpense->has('expense') ? $this->Html->link($travelExpense->expense->id, ['controller' => 'Expenses', 'action' => 'view', $travelExpense->expense->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Travel Mode') ?></th>
            <td><?= h($travelExpense->travel_mode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($travelExpense->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City From') ?></th>
            <td><?= $this->Number->format($travelExpense->city_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City To') ?></th>
            <td><?= $this->Number->format($travelExpense->city_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Km') ?></th>
            <td><?= $this->Number->format($travelExpense->km) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fare') ?></th>
            <td><?= $this->Number->format($travelExpense->fare) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Started') ?></th>
            <td><?= h($travelExpense->started) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reached') ?></th>
            <td><?= h($travelExpense->reached) ?></td>
        </tr>
    </table>
</div>
