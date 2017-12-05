<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor[]|\Cake\Collection\CollectionInterface $doctors
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Doctor'), ['action' => 'add'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="doctors index large-9 medium-8 columns content">
		<h3><?= __('Doctors') ?></h3>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th scope="col"><?= $this->Paginator->sort('id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('speciality_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('qualification') ?></th>
					<th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('pincode') ?></th>
					<th scope="col"><?= $this->Paginator->sort('is_approved') ?></th>
					<th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($doctors as $doctor): ?>
				<tr>
					<td><?= $this->Number->format($doctor->id) ?></td>
					<td><?= h($doctor->name) ?></td>
					<td><?= $doctor->has('speciality') ? $this->Html->link($doctor->speciality->name, ['controller' => 'Specialities', 'action' => 'view', $doctor->speciality->id]) : '' ?></td>
					<td><?= h($doctor->qualification) ?></td>
					<td><?= $doctor->has('state') ? $this->Html->link($doctor->state->name, ['controller' => 'States', 'action' => 'view', $doctor->state->id]) : '' ?></td>
					<td><?= $doctor->has('city') ? $this->Html->link($doctor->city->city_name, ['controller' => 'Cities', 'action' => 'view', $doctor->city->id]) : '' ?></td>
					<td><?= $this->Number->format($doctor->pincode) ?></td>
					<td><?= $this->Number->format($doctor->is_approved) ?></td>
					<td><?= $this->Number->format($doctor->is_active) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $doctor->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $doctor->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $doctor->id], ['confirm' => __('Are you sure you want to delete "{0}"?', $doctor->name)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="paginator">
			<ul class="pagination">
				<?= $this->Paginator->first('<< ' . __('first')) ?>
				<?= $this->Paginator->prev('< ' . __('previous')) ?>
				<?= $this->Paginator->numbers() ?>
				<?= $this->Paginator->next(__('next') . ' >') ?>
				<?= $this->Paginator->last(__('last') . ' >>') ?>
			</ul>
			<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
		</div>
	</div>
</div>
