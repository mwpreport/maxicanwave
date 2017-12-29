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
										__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Relation'),
										['action' => 'delete', $doctorsRelation->id],
										['escape' => false, 'confirm' => __('Are you sure you want to delete?')]
									)
								?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Relations'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Edit Doctors Relation') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($doctorsRelation, array('id' => 'editform')) ?>
									<fieldset>
										<?php
											$yesno = ['1' => 'Yes', '0' => 'No'];
											$AorB = ['1' => 'A', '0' => 'B'];
											echo $this->Form->control('user_id', ['class' => 'form-control mar-bottom-10'], ['options' => $users]);
											echo $this->Form->control('doctor_id', ['class' => 'form-control mar-bottom-10'], ['options' => $doctors]);
											echo $this->Form->control('class', ['class' => 'form-control mar-bottom-10','type' => 'select','options' => $AorB]);
											echo $this->Form->control('is_active', ['class' => 'form-control mar-bottom-10','type' => 'select','options' => $yesno]);
										?>
									</fieldset>
									<?= $this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125 pull-right mar-top-20']); ?>
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
<script>$("#editform").validate();</script>
