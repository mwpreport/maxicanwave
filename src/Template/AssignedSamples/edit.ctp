<?php
/**
 * @var \App\View\AppView $this
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
								<li><?= $this->Form->postLink(
										__('<i class="fa fa-trash" aria-hidden="true"></i> Delete '),
										['action' => 'delete', $assignedSample->id],
										['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $assignedSample->name)]
									)
								?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Assigned Samples'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Edit Assigned Sample') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($assignedSample, array('id' => 'editform')) ?>
									<fieldset>
										<?php
											echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('user_id', ['class' => 'form-control mar-bottom-10', 'options' => $users, 'empty' => true]).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('product_id', ['class' => 'form-control mar-bottom-10', 'options' => $products, 'empty' => true]).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('count', ['class' => 'form-control mar-bottom-10']).'</div></div>';
										?>
									</fieldset>
									<div class="form-group pull-right"> <div class="col-sm-12">
									<?= $this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125 pull-right mar-top-20']) ?>
									</div></div>
									<?= $this->Form->end() ?>
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
<script>$("#editform").validate();</script>
