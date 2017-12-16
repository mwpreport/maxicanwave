<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChemistsRelation $chemistsRelation
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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Relation'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Relation'), ['action' => 'edit', $chemistsRelation->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Relation'), ['action' => 'delete', $chemistsRelation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Relations'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h3><?= h($chemistsRelation->user->firstname ." - ". $chemistsRelation->chemist->name) ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped">
										<tr>
											<th scope="row"><?= __('User') ?></th>
											<td><?= $chemistsRelation->has('user') ? $this->Html->link($chemistsRelation->user->firstname, ['controller' => 'Users', 'action' => 'view', $chemistsRelation->user->id]) : '' ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Chemist') ?></th>
											<td><?= $chemistsRelation->has('chemist') ? $this->Html->link($chemistsRelation->chemist->name, ['controller' => 'Chemists', 'action' => 'view', $chemistsRelation->chemist->id]) : '' ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Is Active') ?></th>
											<td><?= $this->Number->format($chemistsRelation->is_active) ?></td>
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
