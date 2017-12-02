<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Doctor'), ['action' => 'edit', $doctor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Doctor'), ['action' => 'delete', $doctor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doctor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Doctors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Doctor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Specialities'), ['controller' => 'Specialities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Speciality'), ['controller' => 'Specialities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Doctors Relation'), ['controller' => 'DoctorsRelation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Doctors Relation'), ['controller' => 'DoctorsRelation', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Plans'), ['controller' => 'WorkPlans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Plan'), ['controller' => 'WorkPlans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Work Reports'), ['controller' => 'WorkReports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work Report'), ['controller' => 'WorkReports', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="doctors view large-9 medium-8 columns content">
    <h3><?= h($doctor->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($doctor->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Speciality') ?></th>
            <td><?= $doctor->has('speciality') ? $this->Html->link($doctor->speciality->name, ['controller' => 'Specialities', 'action' => 'view', $doctor->speciality->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qualification') ?></th>
            <td><?= h($doctor->qualification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $doctor->has('state') ? $this->Html->link($doctor->state->name, ['controller' => 'States', 'action' => 'view', $doctor->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $doctor->has('city') ? $this->Html->link($doctor->city->city_name, ['controller' => 'Cities', 'action' => 'view', $doctor->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($doctor->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= $this->Number->format($doctor->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= $this->Number->format($doctor->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pincode') ?></th>
            <td><?= $this->Number->format($doctor->pincode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Approved') ?></th>
            <td><?= $this->Number->format($doctor->is_approved) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($doctor->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($doctor->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($doctor->last_updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt') ?></th>
            <td><?= h($doctor->dt) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($doctor->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Doctors Relation') ?></h4>
        <?php if (!empty($doctor->doctors_relation)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Doctor Id') ?></th>
                <th scope="col"><?= __('Class') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Dt') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($doctor->doctors_relation as $doctorsRelation): ?>
            <tr>
                <td><?= h($doctorsRelation->id) ?></td>
                <td><?= h($doctorsRelation->user_id) ?></td>
                <td><?= h($doctorsRelation->doctor_id) ?></td>
                <td><?= h($doctorsRelation->class) ?></td>
                <td><?= h($doctorsRelation->is_active) ?></td>
                <td><?= h($doctorsRelation->dt) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DoctorsRelation', 'action' => 'view', $doctorsRelation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DoctorsRelation', 'action' => 'edit', $doctorsRelation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DoctorsRelation', 'action' => 'delete', $doctorsRelation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doctorsRelation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Work Plans') ?></h4>
        <?php if (!empty($doctor->work_plans)): ?>
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
            <?php foreach ($doctor->work_plans as $workPlans): ?>
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
        <?php if (!empty($doctor->work_reports)): ?>
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
            <?php foreach ($doctor->work_reports as $workReports): ?>
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
