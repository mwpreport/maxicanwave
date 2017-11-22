<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit City'), ['action' => 'edit', $city->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete City'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Chemists'), ['controller' => 'Chemists', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chemist'), ['controller' => 'Chemists', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Doctors'), ['controller' => 'Doctors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Doctor'), ['controller' => 'Doctors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Plans'), ['controller' => 'WorkPlans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Plan'), ['controller' => 'WorkPlans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Reports'), ['controller' => 'WorkReports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Report'), ['controller' => 'WorkReports', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cities view large-9 medium-8 columns content">
    <h3><?= h($city->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $city->has('state') ? $this->Html->link($city->state->name, ['controller' => 'States', 'action' => 'view', $city->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City Name') ?></th>
            <td><?= h($city->city_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($city->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Chemists') ?></h4>
        <?php if (!empty($city->chemists)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Contact Person') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Address') ?></th>
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
            <?php foreach ($city->chemists as $chemists): ?>
            <tr>
                <td><?= h($chemists->id) ?></td>
                <td><?= h($chemists->code) ?></td>
                <td><?= h($chemists->name) ?></td>
                <td><?= h($chemists->contact_person) ?></td>
                <td><?= h($chemists->mobile) ?></td>
                <td><?= h($chemists->phone) ?></td>
                <td><?= h($chemists->address) ?></td>
                <td><?= h($chemists->state_id) ?></td>
                <td><?= h($chemists->city_id) ?></td>
                <td><?= h($chemists->pincode) ?></td>
                <td><?= h($chemists->is_approved) ?></td>
                <td><?= h($chemists->is_active) ?></td>
                <td><?= h($chemists->is_deleted) ?></td>
                <td><?= h($chemists->last_updated) ?></td>
                <td><?= h($chemists->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Chemists', 'action' => 'view', $chemists->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Chemists', 'action' => 'edit', $chemists->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Chemists', 'action' => 'delete', $chemists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chemists->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Doctors') ?></h4>
        <?php if (!empty($city->doctors)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Speciality Id') ?></th>
                <th scope="col"><?= __('Qualification') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Address') ?></th>
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
            <?php foreach ($city->doctors as $doctors): ?>
            <tr>
                <td><?= h($doctors->id) ?></td>
                <td><?= h($doctors->code) ?></td>
                <td><?= h($doctors->name) ?></td>
                <td><?= h($doctors->speciality_id) ?></td>
                <td><?= h($doctors->qualification) ?></td>
                <td><?= h($doctors->mobile) ?></td>
                <td><?= h($doctors->phone) ?></td>
                <td><?= h($doctors->address) ?></td>
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
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($city->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Role') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Avatar') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Qualification') ?></th>
                <th scope="col"><?= __('Is Approved') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Last Logon') ?></th>
                <th scope="col"><?= __('Dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->status) ?></td>
                <td><?= h($users->role) ?></td>
                <td><?= h($users->firstname) ?></td>
                <td><?= h($users->lastname) ?></td>
                <td><?= h($users->state_id) ?></td>
                <td><?= h($users->city_id) ?></td>
                <td><?= h($users->avatar) ?></td>
                <td><?= h($users->gender) ?></td>
                <td><?= h($users->qualification) ?></td>
                <td><?= h($users->is_approved) ?></td>
                <td><?= h($users->is_active) ?></td>
                <td><?= h($users->is_deleted) ?></td>
                <td><?= h($users->last_logon) ?></td>
                <td><?= h($users->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Work Plans') ?></h4>
        <?php if (!empty($city->work_plans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Work Type Id') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Doctor Id') ?></th>
                <th scope="col"><?= __('Plan Reason') ?></th>
                <th scope="col"><?= __('Plan Details') ?></th>
                <th scope="col"><?= __('Is Completed') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->work_plans as $workPlans): ?>
            <tr>
                <td><?= h($workPlans->id) ?></td>
                <td><?= h($workPlans->user_id) ?></td>
                <td><?= h($workPlans->work_type_id) ?></td>
                <td><?= h($workPlans->start_date) ?></td>
                <td><?= h($workPlans->end_date) ?></td>
                <td><?= h($workPlans->city_id) ?></td>
                <td><?= h($workPlans->doctor_id) ?></td>
                <td><?= h($workPlans->plan_reason) ?></td>
                <td><?= h($workPlans->plan_details) ?></td>
                <td><?= h($workPlans->is_completed) ?></td>
                <td><?= h($workPlans->is_deleted) ?></td>
                <td><?= h($workPlans->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WorkPlans', 'action' => 'view', $workPlans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WorkPlans', 'action' => 'edit', $workPlans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WorkPlans', 'action' => 'delete', $workPlans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workPlans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Work Reports') ?></h4>
        <?php if (!empty($city->work_reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Work Type Id') ?></th>
                <th scope="col"><?= __('Plan Id') ?></th>
                <th scope="col"><?= __('Strart Date') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Doctor Id') ?></th>
                <th scope="col"><?= __('Report Details') ?></th>
                <th scope="col"><?= __('Is Missed') ?></th>
                <th scope="col"><?= __('Is Completed') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->work_reports as $workReports): ?>
            <tr>
                <td><?= h($workReports->id) ?></td>
                <td><?= h($workReports->user_id) ?></td>
                <td><?= h($workReports->work_type_id) ?></td>
                <td><?= h($workReports->plan_id) ?></td>
                <td><?= h($workReports->strart_date) ?></td>
                <td><?= h($workReports->city_id) ?></td>
                <td><?= h($workReports->doctor_id) ?></td>
                <td><?= h($workReports->report_details) ?></td>
                <td><?= h($workReports->is_missed) ?></td>
                <td><?= h($workReports->is_completed) ?></td>
                <td><?= h($workReports->is_deleted) ?></td>
                <td><?= h($workReports->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WorkReports', 'action' => 'view', $workReports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WorkReports', 'action' => 'edit', $workReports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WorkReports', 'action' => 'delete', $workReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workReports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
