<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Qualification $qualification
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Qualification'), ['action' => 'edit', $qualification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Qualification'), ['action' => 'delete', $qualification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $qualification->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Qualifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Qualification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Doctors'), ['controller' => 'Doctors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Doctor'), ['controller' => 'Doctors', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="qualifications view large-9 medium-8 columns content">
    <h3><?= h($qualification->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($qualification->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($qualification->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Doctors') ?></h4>
        <?php if (!empty($qualification->doctors)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Speciality Id') ?></th>
                <th scope="col"><?= __('Qualification Id') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Dow') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Clinic Name') ?></th>
                <th scope="col"><?= __('Door No') ?></th>
                <th scope="col"><?= __('Street') ?></th>
                <th scope="col"><?= __('Local Area') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Pincode') ?></th>
                <th scope="col"><?= __('Is Approved') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col"><?= __('Dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($qualification->doctors as $doctors): ?>
            <tr>
                <td><?= h($doctors->id) ?></td>
                <td><?= h($doctors->code) ?></td>
                <td><?= h($doctors->name) ?></td>
                <td><?= h($doctors->speciality_id) ?></td>
                <td><?= h($doctors->qualification_id) ?></td>
                <td><?= h($doctors->mobile) ?></td>
                <td><?= h($doctors->phone) ?></td>
                <td><?= h($doctors->email) ?></td>
                <td><?= h($doctors->dob) ?></td>
                <td><?= h($doctors->dow) ?></td>
                <td><?= h($doctors->address) ?></td>
                <td><?= h($doctors->clinic_name) ?></td>
                <td><?= h($doctors->door_no) ?></td>
                <td><?= h($doctors->street) ?></td>
                <td><?= h($doctors->local_area) ?></td>
                <td><?= h($doctors->state_id) ?></td>
                <td><?= h($doctors->city_id) ?></td>
                <td><?= h($doctors->pincode) ?></td>
                <td><?= h($doctors->is_approved) ?></td>
                <td><?= h($doctors->is_active) ?></td>
                <td><?= h($doctors->is_deleted) ?></td>
                <td><?= h($doctors->last_updated) ?></td>
                <td><?= h($doctors->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Doctors', 'action' => 'view', $doctors->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Doctors', 'action' => 'edit', $doctors->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Doctors', 'action' => 'delete', $doctors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doctors->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
