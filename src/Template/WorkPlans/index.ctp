<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WorkPlan[]|\Cake\Collection\CollectionInterface $workPlans
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Work Plan'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Work Types'), ['controller' => 'WorkTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work Type'), ['controller' => 'WorkTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Doctors'), ['controller' => 'Doctors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Doctor'), ['controller' => 'Doctors', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workPlans index large-9 medium-8 columns content">
    <h3><?= __('Work Plans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('doctor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plan_reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_completed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workPlans as $workPlan): ?>
            <tr>
                <td><?= $this->Number->format($workPlan->id) ?></td>
                <td><?= $workPlan->has('user') ? $this->Html->link($workPlan->user->id, ['controller' => 'Users', 'action' => 'view', $workPlan->user->id]) : '' ?></td>
                <td><?= $workPlan->has('work_type') ? $this->Html->link($workPlan->work_type->name, ['controller' => 'WorkTypes', 'action' => 'view', $workPlan->work_type->id]) : '' ?></td>
                <td><?= h($workPlan->start_date) ?></td>
                <td><?= h($workPlan->end_date) ?></td>
                <td><?= $workPlan->has('city') ? $this->Html->link($workPlan->city->city_name, ['controller' => 'Cities', 'action' => 'view', $workPlan->city->id]) : '' ?></td>
                <td><?= $workPlan->has('doctor') ? $this->Html->link($workPlan->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $workPlan->doctor->id]) : '' ?></td>
                <td><?= h($workPlan->plan_reason) ?></td>
                <td><?= $this->Number->format($workPlan->is_completed) ?></td>
                <td><?= $this->Number->format($workPlan->is_deleted) ?></td>
                <td><?= h($workPlan->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $workPlan->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $workPlan->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $workPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workPlan->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
