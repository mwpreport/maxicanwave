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
                ['action' => 'delete', $workType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $workType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Work Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Work Plans'), ['controller' => 'WorkPlans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work Plan'), ['controller' => 'WorkPlans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Work Reports'), ['controller' => 'WorkReports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work Report'), ['controller' => 'WorkReports', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($workType) ?>
    <fieldset>
        <legend><?= __('Edit Work Type') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('color');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
