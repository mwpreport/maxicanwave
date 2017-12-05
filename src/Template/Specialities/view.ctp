<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speciality $speciality
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul>
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Speciality'), ['action' => 'add'], ['escape' => false]) ?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Speciality'), ['action' => 'edit', $speciality->id], ['escape' => false]) ?> </li>
			<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Speciality'), ['action' => 'delete', $speciality->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $speciality->name)]) ?> </li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Specialities'), ['action' => 'index'], ['escape' => false]) ?> </li>
		</ul>
	</div>

	<div class="specialities view large-9 medium-8 columns content">
		<h3><?= h($speciality->name) ?></h3>
		<table class="vertical-table">
			<tr>
				<th scope="row"><?= __('Name') ?></th>
				<td><?= h($speciality->name) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Code') ?></th>
				<td><?= h($speciality->code) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Id') ?></th>
				<td><?= $this->Number->format($speciality->id) ?></td>
			</tr>
		</table>
		<div class="related">
			<h4><?= __('Related Doctors') ?></h4>
			<?php if (!empty($speciality->doctors)): ?>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th scope="col"><?= __('Id') ?></th>
					<th scope="col"><?= __('Code') ?></th>
					<th scope="col"><?= __('Name') ?></th>
					<th scope="col"><?= __('Speciality Id') ?></th>
					<th scope="col"><?= __('Qualification') ?></th>
					<th scope="col"><?= __('Mobile') ?></th>
					<th scope="col"><?= __('Phone') ?></th>
					<th scope="col"><?= __('Address') ?></th>
					<th scope="col"><?= __('State Id') ?></th>
					<th scope="col"><?= __('City Id') ?></th>
					<th scope="col"><?= __('Pincode') ?></th>
					<th scope="col"><?= __('Is Approved') ?></th>
					<th scope="col"><?= __('Is Active') ?></th>
					<th scope="col"><?= __('Is Deleted') ?></th>
					<th scope="col"><?= __('Last Updated') ?></th>
					<th scope="col"><?= __('Dt') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
				<?php foreach ($speciality->doctors as $doctors): ?>
				<tr>
					<td><?= h($doctors->id) ?></td>
					<td><?= h($doctors->code) ?></td>
					<td><?= h($doctors->name) ?></td>
					<td><?= h($doctors->speciality_id) ?></td>
					<td><?= h($doctors->qualification) ?></td>
					<td><?= h($doctors->mobile) ?></td>
					<td><?= h($doctors->phone) ?></td>
					<td><?= h($doctors->address) ?></td>
					<td><?= h($doctors->state_id) ?></td>
					<td><?= h($doctors->city_id) ?></td>
					<td><?= h($doctors->pincode) ?></td>
					<td><?= h($doctors->is_approved) ?></td>
					<td><?= h($doctors->is_active) ?></td>
					<td><?= h($doctors->is_deleted) ?></td>
					<td><?= h($doctors->last_updated) ?></td>
					<td><?= h($doctors->dt) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['controller' => 'Doctors', 'action' => 'view', $doctors->id]) ?>
						<?= $this->Html->link(__('Edit'), ['controller' => 'Doctors', 'action' => 'edit', $doctors->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['controller' => 'Doctors', 'action' => 'delete', $doctors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doctors->id)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>
	</div>
</div>
