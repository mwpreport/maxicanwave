<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chemist $chemist
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul>
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Chemist'), ['action' => 'add'], ['escape' => false]) ?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Chemist'), ['action' => 'edit', $chemist->id], ['escape' => false]) ?> </li>
			<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Chemist'), ['action' => 'delete', $chemist->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $chemist->name)]) ?> </li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Chemists'), ['action' => 'index'], ['escape' => false]) ?> </li>
		</ul>
	</div>
	<div class="chemists view large-9 medium-8 columns content">
		<h3><?= h($chemist->name) ?></h3>
		<table class="vertical-table">
			<tr>
				<th scope="row"><?= __('Code') ?></th>
				<td><?= h($chemist->code) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Name') ?></th>
				<td><?= h($chemist->name) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Contact Person') ?></th>
				<td><?= h($chemist->contact_person) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('State') ?></th>
				<td><?= $chemist->has('state') ? $this->Html->link($chemist->state->name, ['controller' => 'States', 'action' => 'view', $chemist->state->id]) : '' ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('City') ?></th>
				<td><?= $chemist->has('city') ? $this->Html->link($chemist->city->city_name, ['controller' => 'Cities', 'action' => 'view', $chemist->city->id]) : '' ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Id') ?></th>
				<td><?= $this->Number->format($chemist->id) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Mobile') ?></th>
				<td><?= $this->Number->format($chemist->mobile) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Phone') ?></th>
				<td><?= $this->Number->format($chemist->phone) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Pincode') ?></th>
				<td><?= $this->Number->format($chemist->pincode) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Is Approved') ?></th>
				<td><?= $this->Number->format($chemist->is_approved) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Is Active') ?></th>
				<td><?= $this->Number->format($chemist->is_active) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Is Deleted') ?></th>
				<td><?= $this->Number->format($chemist->is_deleted) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Last Updated') ?></th>
				<td><?= h($chemist->last_updated) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Dt') ?></th>
				<td><?= h($chemist->dt) ?></td>
			</tr>
		</table>
		<div class="row">
			<h4><?= __('Address') ?></h4>
			<?= $this->Text->autoParagraph(h($chemist->address)); ?>
		</div>
		<div class="related">
			<h4><?= __('Related Chemists Relation') ?></h4>
			<?php if (!empty($chemist->chemists_relation)): ?>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th scope="col"><?= __('Id') ?></th>
					<th scope="col"><?= __('User Id') ?></th>
					<th scope="col"><?= __('Chemist Id') ?></th>
					<th scope="col"><?= __('Class') ?></th>
					<th scope="col"><?= __('Is Active') ?></th>
					<th scope="col"><?= __('Dt') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
				<?php foreach ($chemist->chemists_relation as $chemistsRelation): ?>
				<tr>
					<td><?= h($chemistsRelation->id) ?></td>
					<td><?= h($chemistsRelation->user_id) ?></td>
					<td><?= h($chemistsRelation->chemist_id) ?></td>
					<td><?= h($chemistsRelation->class) ?></td>
					<td><?= h($chemistsRelation->is_active) ?></td>
					<td><?= h($chemistsRelation->dt) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['controller' => 'ChemistsRelation', 'action' => 'view', $chemistsRelation->id]) ?>
						<?= $this->Html->link(__('Edit'), ['controller' => 'ChemistsRelation', 'action' => 'edit', $chemistsRelation->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['controller' => 'ChemistsRelation', 'action' => 'delete', $chemistsRelation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chemistsRelation->id)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>
	</div>
</div>
