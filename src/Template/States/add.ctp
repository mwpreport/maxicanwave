<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List States'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="states form large-9 medium-8 columns content">
		<?= $this->Form->create($state) ?>
		<fieldset>
			<legend><?= __('Add State') ?></legend>
			<?php
				echo $this->Form->control('name');
				echo $this->Form->control('state_code');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
