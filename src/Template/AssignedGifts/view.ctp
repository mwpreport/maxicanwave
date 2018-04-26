<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\State $state
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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit'), ['action' => 'edit', $assignedGift->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete'), ['action' => 'delete', $assignedGift->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Assigned Gifts'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title"><h2>Assigned to <?= h($assignedGift->user->code) ?></h2>
							<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
								<table class="vertical-table">
									<tr>
										<th scope="row"><?= __('Gift') ?></th>
										<td><?= $assignedGift->has('gift') ? $this->Html->link($assignedGift->gift->name, ['controller' => 'Gifts', 'action' => 'view', $assignedGift->gift->id]) : '' ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('User') ?></th>
										<td><?= $assignedGift->has('user') ? $this->Html->link($assignedGift->user->firstname, ['controller' => 'Users', 'action' => 'view', $assignedGift->user->id]) : '' ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('Id') ?></th>
										<td><?= $this->Number->format($assignedGift->id) ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('Count') ?></th>
										<td><?= $this->Number->format($assignedGift->count) ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('Dt') ?></th>
										<td><?= h($assignedGift->dt) ?></td>
									</tr>
								</table>
								</div>
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
