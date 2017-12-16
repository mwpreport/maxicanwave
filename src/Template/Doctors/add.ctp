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
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Doctors'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Add Doctor') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($doctor, array('id' => 'newform')) ?>
									<fieldset>
										<?php
											echo $this->Form->control('code', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('name', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('speciality_id', ['class' => 'form-control mar-bottom-10'], ['options' => $specialities]);
											echo $this->Form->control('qualification', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('mobile', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('phone', ['class' => 'form-control mar-bottom-10']);
										?>
											<div class="input required"><label for="address">Address</label><textarea class="form-control mar-bottom-10" name="address" required="required" id="address" rows="5"></textarea></div>
										<?php
											echo $this->Form->control('state_id', ['class' => 'form-control mar-bottom-10'], ['options' => $states]);
											echo $this->Form->control('city_id', ['class' => 'form-control mar-bottom-10'], ['options' => $cities]);
											echo $this->Form->control('pincode', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('is_approved', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('is_active', ['class' => 'form-control mar-bottom-10']);
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
<script>$("#newform").validate();</script>
