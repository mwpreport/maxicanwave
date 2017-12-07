<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChemistsRelation $chemistsRelation
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul>
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Relation'), ['action' => 'add'], ['escape' => false]) ?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Relation'), ['action' => 'edit', $chemistsRelation->id], ['escape' => false]) ?> </li>
			<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Relation'), ['action' => 'delete', $chemistsRelation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?> </li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Relations'), ['action' => 'index'], ['escape' => false]) ?> </li>
		</ul>
	</div>
	<div class="chemistsRelation view large-9 medium-8 columns content">
		<h3><?= h($chemistsRelation->id) ?></h3>
		<table class="vertical-table">
			<tr>
				<th scope="row"><?= __('User') ?></th>
				<td><?= $chemistsRelation->has('user') ? $this->Html->link($chemistsRelation->user->firstname, ['controller' => 'Users', 'action' => 'view', $chemistsRelation->user->id]) : '' ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Chemist') ?></th>
				<td><?= $chemistsRelation->has('chemist') ? $this->Html->link($chemistsRelation->chemist->name, ['controller' => 'Chemists', 'action' => 'view', $chemistsRelation->chemist->id]) : '' ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Id') ?></th>
				<td><?= $this->Number->format($chemistsRelation->id) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Class') ?></th>
				<td><?= $this->Number->format($chemistsRelation->class) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Is Active') ?></th>
				<td><?= $this->Number->format($chemistsRelation->is_active) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Dt') ?></th>
				<td><?= h($chemistsRelation->dt) ?></td>
			</tr>
		</table>
	</div>
</div>
