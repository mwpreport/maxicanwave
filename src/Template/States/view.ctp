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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New State'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit State'), ['action' => 'edit', $state->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete State'), ['action' => 'delete', $state->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $state->name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List States'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= h($state->name) ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped">
										<tr>
											<th scope="row"><?= __('Name') ?></th>
											<td><?= h($state->name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('State Code') ?></th>
											<td><?= h($state->state_code) ?></td>
										</tr>
									</table>
		
		<div class="related">
			<?php if (!empty($state->cities)): ?>
			 <h4><?= __('Related Cities') ?></h4>
		   <table class="table table-striped table-bordered table-hover">
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
