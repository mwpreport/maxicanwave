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
                ['action' => 'delete', $chemist->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chemist->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Chemists'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Chemists Relation'), ['controller' => 'ChemistsRelation', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Chemists Relation'), ['controller' => 'ChemistsRelation', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="chemists form large-9 medium-8 columns content">
    <?= $this->Form->create($chemist) ?>
    <fieldset>
        <legend><?= __('Edit Chemist') ?></legend>
        <?php
            echo $this->Form->control('code');
            echo $this->Form->control('name');
            echo $this->Form->control('contact_person');
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
