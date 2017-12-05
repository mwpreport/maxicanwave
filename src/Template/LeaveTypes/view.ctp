<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveType $leaveType
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul>
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Leave Type'), ['action' => 'add'], ['escape' => false]) ?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Leave Type'), ['action' => 'edit', $leaveType->id], ['escape' => false]) ?> </li>
			<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Leave Type'), ['action' => 'delete', $leaveType->id], ['escape' => false,'confirm' => __('Are you sure you want to delete "{0}"?', $leaveType->name)]) ?> </li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Leave Types'), ['action' => 'index'], ['escape' => false]) ?> </li>
		</ul>
	</div>
	<div class="leaveTypes view large-9 medium-8 columns content">
		<h3><?= h($leaveType->name) ?></h3>
		<table class="vertical-table">
			<tr>
				<th scope="row"><?= __('Name') ?></th>
				<td><?= h($leaveType->name) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Id') ?></th>
				<td><?= $this->Number->format($leaveType->id) ?></td>
			</tr>
		</table>
	</div>
</div>
