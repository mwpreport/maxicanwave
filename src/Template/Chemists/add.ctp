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
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Chemists'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Add Chemist') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($chemist, array('id' => 'newform')) ?>
									<fieldset>
										<?php
											echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('name', ['label' => 'Pharmacy Name', 'class' => 'form-control']).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('contact_person', ['class' => 'form-control']).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('mobile', ['class' => 'form-control']).'</div></div>';
											echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('phone', ['class' => 'form-control']).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('door_no', ['class' => 'form-control']).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('street', ['class' => 'form-control']).'</div></div>';
											echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('area', ['class' => 'form-control']).'</div>';
											$yesno = ['1' => 'Yes', '0' => 'No'];
											echo '<div class="col-sm-4">'.$this->Form->control('state_id', ['class' => 'form-control', 'onchange' => 'loadCitiesOption()', 'options' => $states,'empty' => 'Select State']).'</div>';
											echo '<div class="col-sm-4">'.$this->Form->control('city_id', ['class' => 'form-control','empty' => 'Select City']).'</div></div>';
											echo '<div class="form-group mar-bottom-10"><div class="col-sm-4">'.$this->Form->control('pincode', ['class' => 'form-control']).'</div></div>';
										?>
									</fieldset>
									<div class="form-group pull-right"> <div class="col-sm-12">
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
<script>$("#newform").validate();
function loadCitiesOption(){
	var state = $('#state-id').val();
	$.ajax({
		   url: '../cities/get_cities_option/',
		   dataType: "json",
		   data: "state="+state,
		   type: "POST",
		   success: function(json) {
			   $('#city-id').html(json.cities);
		   }
    });
}
</script>
