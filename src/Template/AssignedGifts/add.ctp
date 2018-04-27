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
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Assigned Gifts'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('New Assignment') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($assignedGift, array('id' => 'newform')) ?>
									<fieldset>
										<?php
											echo $this->Form->control('user_id', ['class' => 'form-control mar-bottom-10', 'options' => $users, 'empty' => true]);
											echo $this->Form->control('gift_id', ['class' => 'form-control mar-bottom-10', 'options' => $gifts, 'empty' => true]);
											echo $this->Form->control('count', ['class' => 'form-control mar-bottom-10']);
										?>
									</fieldset>
									<?= $this->Form->button(__('Submit')) ?>
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
