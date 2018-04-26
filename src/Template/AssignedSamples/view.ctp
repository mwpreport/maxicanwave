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
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit'), ['action' => 'edit', $assignedSample->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete'), ['action' => 'delete', $assignedSample->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Assigned Samples'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title"><h2>Assigned to <?= h($assignedSample->user->code) ?></h2>
							<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
								<table class="vertical-table">
									<tr>
										<th scope="row"><?= __('Product') ?></th>
										<td><?= $assignedSample->has('product') ? $this->Html->link($assignedSample->product->name, ['controller' => 'Products', 'action' => 'view', $assignedSample->product->id]) : '' ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('User') ?></th>
										<td><?= $assignedSample->has('user') ? $this->Html->link($assignedSample->user->firstname, ['controller' => 'Users', 'action' => 'view', $assignedSample->user->id]) : '' ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('Id') ?></th>
										<td><?= $this->Number->format($assignedSample->id) ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('Count') ?></th>
										<td><?= $this->Number->format($assignedSample->count) ?></td>
									</tr>
									<tr>
										<th scope="row"><?= __('Dt') ?></th>
										<td><?= h($assignedSample->dt) ?></td>
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
