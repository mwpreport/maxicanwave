<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $doctor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $doctor->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Doctors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Specialities'), ['controller' => 'Specialities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Speciality'), ['controller' => 'Specialities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Doctors Relation'), ['controller' => 'DoctorsRelation', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Doctors Relation'), ['controller' => 'DoctorsRelation', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Work Plans'), ['controller' => 'WorkPlans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work Plan'), ['controller' => 'WorkPlans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Work Reports'), ['controller' => 'WorkReports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work Report'), ['controller' => 'WorkReports', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="doctors form large-9 medium-8 columns content">
    <?= $this->Form->create($doctor) ?>
    <fieldset>
        <legend><?= __('Edit Doctor') ?></legend>
        <?php
            echo $this->Form->control('code');
            echo $this->Form->control('name');
            echo $this->Form->control('speciality_id', ['options' => $specialities]);
            echo $this->Form->control('qualification');
            echo $this->Form->control('mobile');
            echo $this->Form->control('phone');
            echo $this->Form->control('address');
            echo $this->Form->control('state_id', ['options' => $states]);
            echo $this->Form->control('city_id', ['options' => $cities]);
            echo $this->Form->control('pincode');
            echo $this->Form->control('is_approved');
            echo $this->Form->control('is_active');
            echo $this->Form->control('is_deleted');
            echo $this->Form->control('last_updated');
            echo $this->Form->control('dt');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
