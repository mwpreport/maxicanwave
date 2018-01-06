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
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> Change Password'), ['action' => 'change-password'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= $user->firstname ?> <?= $user->lastname ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<?= $this->Form->create($user, array('id' => 'editform')) ?>
									<fieldset>
										<?php
											$yesno = ['1' => 'Yes', '0' => 'No'];
											$gender = ['1' => 'M', '0' => 'F'];
											echo $this->Form->control('username', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('email', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('firstname', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('lastname', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('avatar', ['class' => 'form-control mar-bottom-10']);
											echo $this->Form->control('gender', ['class' => 'form-control mar-bottom-10','type' => 'select','options' => $gender,'empty' => 'Select Gender']);
											echo $this->Form->control('qualification', ['class' => 'form-control mar-bottom-10']);
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
<script>
$("#editform").validate();
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
