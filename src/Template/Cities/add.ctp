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
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Cities'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Add City') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($city, array('id' => 'newform')) ?>
									<fieldset>
										<?php
											echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('state_id', ['class' => 'form-control']).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('city_name', ['class' => 'form-control']).'</div></div>';
										?>
									</fieldset>
									<div class="form-group mar-bottom-10"> <div class="col-sm-8">
									<?= $this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125 pull-right mar-top-20']); ?>
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
<script>$("#newform").validate();</script>
