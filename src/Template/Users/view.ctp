<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
		<!-- Main content -->
		<section>
			<div class="content">
				<div class="white-wrapper no-padding-top">
					<div class="row">
						<div class="event-button-cont">
							<ul class="side-nav">
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New User'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit User'), ['action' => 'edit', $user->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete User'), ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $user->name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Users'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h3><?= h($user->username) ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped">
										<tr>
											<th scope="row"><?= __('Id') ?></th>
											<td><?= $this->Number->format($user->id) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Username') ?></th>
											<td><?= h($user->username) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Email') ?></th>
											<td><?= h($user->email) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Firstname') ?></th>
											<td><?= h($user->firstname) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Lastname') ?></th>
											<td><?= h($user->lastname) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Role') ?></th>
											<td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('State') ?></th>
											<td><?= $user->has('state') ? $this->Html->link($user->state->name, ['controller' => 'States', 'action' => 'view', $user->state->id]) : '' ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('City') ?></th>
											<td><?= $user->has('city') ? $this->Html->link($user->city->city_name, ['controller' => 'Cities', 'action' => 'view', $user->city->id]) : '' ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Gender') ?></th>
											<td><?= h($user->gender) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Qualification') ?></th>
											<td><?= $this->Number->format($user->qualification) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Is Approved') ?></th>
											<td><?= ($user->is_approved == 1) ? "Yes" : "No" ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Is Active') ?></th>
											<td><?= ($user->is_active == 1) ? "Yes" : "No" ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Last Updated') ?></th>
											<td><?= h($user->last_updated) ?></td>
										</tr>
									</table>
						</div>
						<div class="clearfix"></div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div> 
		</section>
		<!-- /.content -->
</div>
<!-- /.content-wrapper -->
