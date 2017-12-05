<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChemistsRelation[]|\Cake\Collection\CollectionInterface $chemistsRelation
 */
?>
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul class="side-nav">
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Relation'), ['action' => 'add'], ['escape' => false]) ?></li>
		</ul>
	</div>
	<div class="chemistsRelation index large-9 medium-8 columns content">
		<h3><?= __('Chemists Relation') ?></h3>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th scope="col"><?= $this->Paginator->sort('id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('chemist_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('class') ?></th>
					<th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
					<th scope="col"><?= $this->Paginator->sort('dt') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($chemistsRelation as $chemistsRelation): ?>
				<tr>
					<td><?= $this->Number->format($chemistsRelation->id) ?></td>
					<td><?= $chemistsRelation->has('user') ? $this->Html->link($chemistsRelation->user->id, ['controller' => 'Users', 'action' => 'view', $chemistsRelation->user->id]) : '' ?></td>
					<td><?= $chemistsRelation->has('chemist') ? $this->Html->link($chemistsRelation->chemist->name, ['controller' => 'Chemists', 'action' => 'view', $chemistsRelation->chemist->id]) : '' ?></td>
					<td><?= $this->Number->format($chemistsRelation->class) ?></td>
					<td><?= $this->Number->format($chemistsRelation->is_active) ?></td>
					<td><?= h($chemistsRelation->dt) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $chemistsRelation->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $chemistsRelation->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $chemistsRelation->id], ['confirm' => __('Are you sure you want to delete?')]) ?>
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
