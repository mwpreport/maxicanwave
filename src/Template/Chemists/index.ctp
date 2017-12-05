<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chemist[]|\Cake\Collection\CollectionInterface $chemists
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Chemist'), ['action' => 'add'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="chemists index large-9 medium-8 columns content">
		<h3><?= __('Chemists') ?></h3>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th scope="col"><?= $this->Paginator->sort('id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('code') ?></th>
					<th scope="col"><?= $this->Paginator->sort('name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('pincode') ?></th>
					<th scope="col"><?= $this->Paginator->sort('is_approved') ?></th>
					<th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($chemists as $chemist): ?>
				<tr>
					<td><?= $this->Number->format($chemist->id) ?></td>
					<td><?= h($chemist->code) ?></td>
					<td><?= h($chemist->name) ?></td>
					<td><?= $chemist->has('state') ? $this->Html->link($chemist->state->name, ['controller' => 'States', 'action' => 'view', $chemist->state->id]) : '' ?></td>
					<td><?= $chemist->has('city') ? $this->Html->link($chemist->city->city_name, ['controller' => 'Cities', 'action' => 'view', $chemist->city->id]) : '' ?></td>
					<td><?= $this->Number->format($chemist->pincode) ?></td>
					<td><?= $this->Number->format($chemist->is_approved) ?></td>
					<td><?= $this->Number->format($chemist->is_active) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $chemist->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $chemist->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $chemist->id], ['confirm' => __('Are you sure you want to delete # "{0}"?', $chemist->name)]) ?>
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
