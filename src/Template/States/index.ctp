<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State[]|\Cake\Collection\CollectionInterface $states
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New State'), ['action' => 'add'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="states content"><section><div class="white-wrapper">
		<h3><?= __('States') ?></h3>
		<table  class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th scope="col"><?= $this->Paginator->sort('id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('state_code') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($states as $state): ?>
				<tr>
					<td><?= $this->Number->format($state->id) ?></td>
					<td><?= h($state->name) ?></td>
					<td><?= h($state->state_code) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $state->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $state->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete "{0}"?', $state->name)]) ?>
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
	</div></section></div>
</div>
