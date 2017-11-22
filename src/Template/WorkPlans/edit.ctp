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
                ['action' => 'delete', $workPlan->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $workPlan->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Work Plans'), ['action' => 'index']) ?></li>
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
<div class="workPlans form large-9 medium-8 columns content">
    <?= $this->Form->create($workPlan) ?>
    <fieldset>
        <legend><?= __('Edit Work Plan') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('work_type_id', ['options' => $workTypes]);
            echo $this->Form->control('start_date');
            echo $this->Form->control('end_date');
            echo $this->Form->control('city_id', ['options' => $cities]);
            echo $this->Form->control('doctor_id', ['options' => $doctors]);
            echo $this->Form->control('plan_reason');
            echo $this->Form->control('plan_details');
            echo $this->Form->control('is_completed');
            echo $this->Form->control('is_deleted');
            echo $this->Form->control('dt');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
