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
                ['action' => 'delete', $chemistsRelation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chemistsRelation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Chemists Relation'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Chemists'), ['controller' => 'Chemists', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Chemist'), ['controller' => 'Chemists', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="chemistsRelation form large-9 medium-8 columns content">
    <?= $this->Form->create($chemistsRelation) ?>
    <fieldset>
        <legend><?= __('Edit Chemists Relation') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('chemist_id', ['options' => $chemists]);
            echo $this->Form->control('class');
            echo $this->Form->control('is_active');
            echo $this->Form->control('dt');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
