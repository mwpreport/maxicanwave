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
										__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Stockist'),
										['action' => 'delete', $stockist->id],
										['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $stockist->name)]
									)
								?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Stockists'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Edit Stockist') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($stockist, array('id' => 'editform')) ?>
									<fieldset>
										<?php
											echo $this->Form->control('code', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('name', ['label' => 'Stockist Name', 'class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('owner', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('contact_person', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('email', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('mobile', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('phone', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('door_no', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('street', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('area', ['class' => 'form-control mar-bottom-10']);
											$yesno = ['1' => 'Yes', '0' => 'No'];
											echo $this->Form->control('state_id', ['class' => 'form-control mar-bottom-10', 'onchange' => 'loadCitiesOption()', 'options' => $states,'empty' => 'Select State']);
											echo $this->Form->control('city_id', ['class' => 'form-control mar-bottom-10','empty' => 'Select City']);
											echo $this->Form->control('pincode', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('dl_no', ['label' => 'DL.No', 'class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('gst_no', ['label' => 'GST.No', 'class' => 'form-control mar-bottom-10']);
											echo "<h4>Bank Account Details</h4>";
											echo $this->Form->control('bank_name', ['label' => 'Name of the Bank', 'class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('branch', ['label' => 'Branch Name', 'class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('ifsc', ['label' => 'IFSC Code', 'class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('account_holder', ['label' => 'Account Holder', 'class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('account_no', ['label' => 'Account.No', 'class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('account_type', ['label' => 'Type of Account', 'class' => 'form-control mar-bottom-10']);
											echo "<br>";
											echo $this->Form->control('is_approved', ['class' => 'form-control mar-bottom-10','type' => 'select','options' => $yesno]);
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
<script>$("#editform").validate();
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
