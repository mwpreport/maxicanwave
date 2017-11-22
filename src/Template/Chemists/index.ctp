<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chemist[]|\Cake\Collection\CollectionInterface $chemists
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Chemist'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Chemists Relation'), ['controller' => 'ChemistsRelation', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Chemists Relation'), ['controller' => 'ChemistsRelation', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="chemists index large-9 medium-8 columns content">
    <h3><?= __('Chemists') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contact_person') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pincode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_approved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chemists as $chemist): ?>
            <tr>
                <td><?= $this->Number->format($chemist->id) ?></td>
                <td><?= h($chemist->code) ?></td>
                <td><?= h($chemist->name) ?></td>
                <td><?= h($chemist->contact_person) ?></td>
                <td><?= $this->Number->format($chemist->mobile) ?></td>
                <td><?= $this->Number->format($chemist->phone) ?></td>
                <td><?= $this->Number->format($chemist->address) ?></td>
                <td><?= $chemist->has('state') ? $this->Html->link($chemist->state->name, ['controller' => 'States', 'action' => 'view', $chemist->state->id]) : '' ?></td>
                <td><?= $chemist->has('city') ? $this->Html->link($chemist->city->id, ['controller' => 'Cities', 'action' => 'view', $chemist->city->id]) : '' ?></td>
                <td><?= $this->Number->format($chemist->pincode) ?></td>
                <td><?= $this->Number->format($chemist->is_approved) ?></td>
                <td><?= $this->Number->format($chemist->is_active) ?></td>
                <td><?= $this->Number->format($chemist->is_deleted) ?></td>
                <td><?= h($chemist->last_updated) ?></td>
                <td><?= h($chemist->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $chemist->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $chemist->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $chemist->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chemist->id)]) ?>
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
