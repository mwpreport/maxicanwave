<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WorkReport[]|\Cake\Collection\CollectionInterface $workReports
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Work Report'), ['action' => 'add']) ?></li>
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
<div class="workReports index large-9 medium-8 columns content">
    <h3><?= __('Work Reports') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plan_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('strart_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('doctor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_missed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_completed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workReports as $workReport): ?>
            <tr>
                <td><?= $this->Number->format($workReport->id) ?></td>
                <td><?= $workReport->has('user') ? $this->Html->link($workReport->user->id, ['controller' => 'Users', 'action' => 'view', $workReport->user->id]) : '' ?></td>
                <td><?= $workReport->has('work_type') ? $this->Html->link($workReport->work_type->name, ['controller' => 'WorkTypes', 'action' => 'view', $workReport->work_type->id]) : '' ?></td>
                <td><?= h($workReport->plan_id) ?></td>
                <td><?= h($workReport->strart_date) ?></td>
                <td><?= $workReport->has('city') ? $this->Html->link($workReport->city->id, ['controller' => 'Cities', 'action' => 'view', $workReport->city->id]) : '' ?></td>
                <td><?= $workReport->has('doctor') ? $this->Html->link($workReport->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $workReport->doctor->id]) : '' ?></td>
                <td><?= $this->Number->format($workReport->is_missed) ?></td>
                <td><?= $this->Number->format($workReport->is_completed) ?></td>
                <td><?= $this->Number->format($workReport->is_deleted) ?></td>
                <td><?= h($workReport->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $workReport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $workReport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $workReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workReport->id)]) ?>
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
