<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DoctorsRelation $doctorsRelation
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul>
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Relation'), ['action' => 'add'], ['escape' => false]) ?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Relation'), ['action' => 'edit', $doctorsRelation->id], ['escape' => false]) ?> </li>
			<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Relation'), ['action' => 'delete', $doctorsRelation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?> </li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Relations'), ['action' => 'index'], ['escape' => false]) ?> </li>
		</ul>
	</div>
	<div class="doctorsRelation view large-9 medium-8 columns content">
		<h3><?= h($doctorsRelation->id) ?></h3>
		<table class="vertical-table">
			<tr>
				<th scope="row"><?= __('User') ?></th>
				<td><?= $doctorsRelation->has('user') ? $this->Html->link($doctorsRelation->user->firstname, ['controller' => 'Users', 'action' => 'view', $doctorsRelation->user->id]) : '' ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Doctor') ?></th>
				<td><?= $doctorsRelation->has('doctor') ? $this->Html->link($doctorsRelation->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $doctorsRelation->doctor->id]) : '' ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Id') ?></th>
				<td><?= $this->Number->format($doctorsRelation->id) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Class') ?></th>
				<td><?= $this->Number->format($doctorsRelation->class) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Is Active') ?></th>
				<td><?= $this->Number->format($doctorsRelation->is_active) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Dt') ?></th>
				<td><?= h($doctorsRelation->dt) ?></td>
			</tr>
		</table>
	</div>
</div>
