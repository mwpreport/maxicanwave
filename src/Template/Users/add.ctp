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
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Users'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Add User') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($user, array('id' => 'newform')) ?>
									<fieldset>
										<?php
											$yesno = ['1' => 'Yes', '0' => 'No'];
											$gender = ['1' => 'M', '0' => 'F'];
											echo $this->Form->control('username', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('email', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('password', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('firstname', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('lastname', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('role_id', ['class' => 'form-control mar-bottom-10', 'onchange' => 'loadLeadOptions()', 'options' => $roles, 'empty' => 'Select Role']);
											echo $this->Form->control('lead_id', ['class' => 'form-control mar-bottom-10', 'options' => [], 'empty' => 'Select Lead']);
											echo $this->Form->control('state_id', ['class' => 'form-control mar-bottom-10', 'onchange' => 'loadCitiesOption()', 'options' => $states,'default' => $state_id,'empty' => 'Select State']);
											echo $this->Form->control('city_id', ['label' => 'MR Headquarters', 'class' => 'form-control mar-bottom-10', 'options' => $cities,'empty' => 'Select City']);
											echo $this->Form->control('gender', ['class' => 'form-control mar-bottom-10','type' => 'select','options' => $gender,'empty' => 'Select Gender']);
											echo $this->Form->control('qualification', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('is_active', ['class' => 'form-control mar-bottom-10','type' => 'select','options' => $yesno]);
										?>
									</fieldset>
									<input type="hidden" name="is_approved" value="1">
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
function loadCitiesOption(){
	var state = $('#state-id').val();
	$.ajax({
		   url: '<?php echo $this->Url->build(["controller" => "Cities","action" => "getCitiesOption"])?>',
		   dataType: "json",
		   data: "state="+state,
		   type: "POST",
		   success: function(json) {
			   $('#city-id').html(json.cities);
		   }
    });
}
function loadLeadOptions(){
	var role = $('#role-id').val();
	$.ajax({
		   url: '<?php echo $this->Url->build(["controller" => "Users","action" => "getLeadsOption"])?>',
		   dataType: "json",
		   data: "role="+role,
		   type: "POST",
		   success: function(json) {
			   $('#lead-id').html(json.leads);
		   }
    });
}
</script>
