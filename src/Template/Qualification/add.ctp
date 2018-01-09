<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Qualification'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="qualification form large-9 medium-8 columns content">
    <?= $this->Form->create($qualification) ?>
    <fieldset>
        <legend><?= __('Add Qualification') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
