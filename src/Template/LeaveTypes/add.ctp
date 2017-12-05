<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveType $leaveType
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Leave Types'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="leaveTypes form large-9 medium-8 columns content">
		<?= $this->Form->create($leaveType) ?>
		<fieldset>
			<legend><?= __('Add Leave Type') ?></legend>
			<?php
				echo $this->Form->control('name');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
