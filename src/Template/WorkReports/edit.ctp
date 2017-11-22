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
                ['action' => 'delete', $workReport->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $workReport->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Work Reports'), ['action' => 'index']) ?></li>
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
<div class="workReports form large-9 medium-8 columns content">
    <?= $this->Form->create($workReport) ?>
    <fieldset>
        <legend><?= __('Edit Work Report') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('work_type_id', ['options' => $workTypes]);
            echo $this->Form->control('plan_id');
            echo $this->Form->control('strart_date');
            echo $this->Form->control('city_id', ['options' => $cities]);
            echo $this->Form->control('doctor_id', ['options' => $doctors]);
            echo $this->Form->control('report_details');
            echo $this->Form->control('is_missed');
            echo $this->Form->control('is_completed');
            echo $this->Form->control('is_deleted');
            echo $this->Form->control('dt');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
