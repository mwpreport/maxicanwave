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
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Change password') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create("",array('id' => 'editform')) ?>
									<fieldset>
										<div class="input text required"><?= $this->Form->input('old_password',['type' => 'password', 'class' => 'form-control mar-bottom-10', 'label'=>'Old password'])?></div>
										<div class="input text required"><?= $this->Form->input('password1',['type'=>'password',  'class' => 'form-control mar-bottom-10', 'label'=>'Password']) ?></div>
										<div class="input text required"><?= $this->Form->input('password2',['type' => 'password', 'class' => 'form-control mar-bottom-10', 'label'=>'Repeat password'])?></div>
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
<script>
$("#newform").validate();
</script>
