<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveType $leaveType
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Form->postLink(
					__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Leave Type'),
					['action' => 'delete', $leaveType->id],
					['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $leaveType->name)]
				)
			?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Leave Types'), ['action' => 'index'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="leaveTypes form large-9 medium-8 columns content">
		<?= $this->Form->create($leaveType) ?>
		<fieldset>
			<legend><?= __('Edit Leave Type') ?></legend>
			<?php
				echo $this->Form->control('name');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>
