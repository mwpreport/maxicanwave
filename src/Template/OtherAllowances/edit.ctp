<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OtherAllowance $otherAllowance
 */
?>
<div class="content-wrapper">
		<!-- Main content -->
		<section>
			<div class="content">
				<div class="white-wrapper no-padding-top">
					<div class="row">
						<div class="event-button-cont">
							<ul class="side-nav">
                <li><?= $this->Form->postLink(
										__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Other Allowance'),
										['action' => 'delete', $otherAllowance->id],
										['escape' => false, 'confirm' => __('Are you sure you want to delete {0} other allowance?', $otherAllowance->name)]
									)
								?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Other Allowances'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Edit Other Allowance') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($otherAllowance, array('id' => 'newform')) ?>
									<fieldset>
										<?php
                    echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('name', ['class' => 'form-control']).'</div>
                    <div class="col-sm-4">'.$this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125 pull-left mar-top-22']). '</div></div>';
										?>
									</fieldset>

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
<style>
.mar-top-22{margin-top:22px}
</style>
