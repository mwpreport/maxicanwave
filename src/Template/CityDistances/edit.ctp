<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CityDistance $cityDistance
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
										__('<i class="fa fa-trash" aria-hidden="true"></i> Delete City Distance'),
										['action' => 'delete', $cityDistance->id],
										['escape' => false, 'confirm' => __('Are you sure you want to delete distance from "{0}" to "{1}"?', $cityDistance->cities_to->city_name, $cityDistance->cities_to->city_name)]
									)
								?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List City Distances'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Edit City Distance') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($cityDistance, array('id' => 'newform')) ?>
									<fieldset>
										<?php
                    echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('city_from', ['class' => 'form-control', 'options' => $cities,'empty' => 'Select', 'disabled' => 'disabled']).'</div>';
                    echo '<div class="col-sm-4">'.$this->Form->control('city_to', ['class' => 'form-control',  'options' => $cities,'empty' => 'Select', 'disabled' => 'disabled']).'</div>';
                    echo '<div class="col-sm-4">'.$this->Form->control('km', ['class' => 'form-control']).'</div></div>';
										?>
									</fieldset>
									<div class="form-group pull-right">
										<div class="col-sm-12">
											<?= $this->Form->button(__('Submit'), ['class' => 'common-btn blue-btn btn-125 pull-right mar-top-20']); ?>
											</div>
										</div>
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
