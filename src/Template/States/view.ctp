<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="event-button-cont">
		<ul>
			<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New State'), ['action' => 'add'], ['escape' => false]) ?></li>
			<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit State'), ['action' => 'edit', $state->id], ['escape' => false]) ?> </li>
			<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete State'), ['action' => 'delete', $state->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $state->name)]) ?> </li>
			<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List States'), ['action' => 'index'], ['escape' => false]) ?> </li>
		</ul>
	</div>

	<div class="states view large-9 medium-8 columns content">
		<h3><?= h($state->name) ?></h3>
		<table class="vertical-table">
			<tr>
				<th scope="row"><?= __('Name') ?></th>
				<td><?= h($state->name) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('State Code') ?></th>
				<td><?= h($state->state_code) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Id') ?></th>
				<td><?= $this->Number->format($state->id) ?></td>
			</tr>
		</table>
		<div class="related">
			<?php if (!empty($state->chemists)): ?>
			<h4><?= __('Related Chemists') ?></h4>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th scope="col"><?= __('Id') ?></th>
					<th scope="col"><?= __('Code') ?></th>
					<th scope="col"><?= __('Name') ?></th>
					<th scope="col"><?= __('Contact Person') ?></th>
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
				<?php foreach ($state->chemists as $chemists): ?>
				<tr>
					<td><?= h($chemists->id) ?></td>
					<td><?= h($chemists->code) ?></td>
					<td><?= h($chemists->name) ?></td>
					<td><?= h($chemists->contact_person) ?></td>
					<td><?= h($chemists->mobile) ?></td>
					<td><?= h($chemists->phone) ?></td>
					<td><?= h($chemists->address) ?></td>
					<td><?= h($chemists->state_id) ?></td>
					<td><?= h($chemists->city_id) ?></td>
					<td><?= h($chemists->pincode) ?></td>
					<td><?= h($chemists->is_approved) ?></td>
					<td><?= h($chemists->is_active) ?></td>
					<td><?= h($chemists->is_deleted) ?></td>
					<td><?= h($chemists->last_updated) ?></td>
					<td><?= h($chemists->dt) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['controller' => 'Chemists', 'action' => 'view', $chemists->id]) ?>
						<?= $this->Html->link(__('Edit'), ['controller' => 'Chemists', 'action' => 'edit', $chemists->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['controller' => 'Chemists', 'action' => 'delete', $chemists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chemists->id)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>
		<div class="related">
			<?php if (!empty($state->cities)): ?>
			 <h4><?= __('Related Cities') ?></h4>
		   <table cellpadding="0" cellspacing="0">
				<tr>
					<th scope="col"><?= __('Id') ?></th>
					<th scope="col"><?= __('State Id') ?></th>
					<th scope="col"><?= __('City Name') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
				<?php foreach ($state->cities as $cities): ?>
				<tr>
					<td><?= h($cities->id) ?></td>
					<td><?= h($cities->state_id) ?></td>
					<td><?= h($cities->city_name) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['controller' => 'Cities', 'action' => 'view', $cities->id]) ?>
						<?= $this->Html->link(__('Edit'), ['controller' => 'Cities', 'action' => 'edit', $cities->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['controller' => 'Cities', 'action' => 'delete', $cities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cities->id)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>
		<div class="related">
			<?php if (!empty($state->doctors)): ?>
			<h4><?= __('Related Doctors') ?></h4>
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
				<?php foreach ($state->doctors as $doctors): ?>
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
		<div class="related">
			<?php if (!empty($state->users)): ?>
			<h4><?= __('Related Users') ?></h4>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th scope="col"><?= __('Id') ?></th>
					<th scope="col"><?= __('Username') ?></th>
					<th scope="col"><?= __('Email') ?></th>
					<th scope="col"><?= __('Password') ?></th>
					<th scope="col"><?= __('Status') ?></th>
					<th scope="col"><?= __('Role') ?></th>
					<th scope="col"><?= __('Firstname') ?></th>
					<th scope="col"><?= __('Lastname') ?></th>
					<th scope="col"><?= __('State Id') ?></th>
					<th scope="col"><?= __('City Id') ?></th>
					<th scope="col"><?= __('Avatar') ?></th>
					<th scope="col"><?= __('Gender') ?></th>
					<th scope="col"><?= __('Qualification') ?></th>
					<th scope="col"><?= __('Is Approved') ?></th>
					<th scope="col"><?= __('Is Active') ?></th>
					<th scope="col"><?= __('Is Deleted') ?></th>
					<th scope="col"><?= __('Last Logon') ?></th>
					<th scope="col"><?= __('Dt') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
				<?php foreach ($state->users as $users): ?>
				<tr>
					<td><?= h($users->id) ?></td>
					<td><?= h($users->username) ?></td>
					<td><?= h($users->email) ?></td>
					<td><?= h($users->password) ?></td>
					<td><?= h($users->status) ?></td>
					<td><?= h($users->role) ?></td>
					<td><?= h($users->firstname) ?></td>
					<td><?= h($users->lastname) ?></td>
					<td><?= h($users->state_id) ?></td>
					<td><?= h($users->city_id) ?></td>
					<td><?= h($users->avatar) ?></td>
					<td><?= h($users->gender) ?></td>
					<td><?= h($users->qualification) ?></td>
					<td><?= h($users->is_approved) ?></td>
					<td><?= h($users->is_active) ?></td>
					<td><?= h($users->is_deleted) ?></td>
					<td><?= h($users->last_logon) ?></td>
					<td><?= h($users->dt) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
						<?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>
	</div>

</div>
