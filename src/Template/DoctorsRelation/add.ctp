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
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Relations'), ['action' => 'index'], ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('Add Doctors Relation') ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<form id="newform" method="POST" action="<?= $this->Url->build(["controller" => "DoctorsRelation", "action" => "add"])?>">
										<div class="form-group mar-bottom-40">
											<div class="col-sm-6">
												<?php echo $this->Form->select('state_id', $states , ['id' => 'state_id', 'class' => 'form-control', 'onchange' => 'loadCitiesOption()', 'empty' => 'Select State']);?>  
											</div>
											<div class="col-sm-6">
												<?php echo $this->Form->select('city_id', [], ['id' => 'city_id', 'class' => 'form-control', 'onchange' => 'loadUsersOption()', 'empty' => 'Select City']);?>  
											</div>
										</div>
										<div class="form-group mar-bottom-40">
											<div class="col-sm-6 ">
											<?php echo $this->Form->select('user_id', [], ['id' => 'user_id', 'class' => 'form-control', 'onchange' => 'loadDoctorsOption()','empty' => 'Select MR']);?>
											</div>
											<div class="col-sm-6">
											<?php echo $this->Form->select('doctor_id', [], ['id' => 'doctor_id', 'class' => 'form-control','empty' => 'Select Doctors','multiple' => 'multiple']);?>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<div class="radio-blk">
													<label for="exampleInputClass" class="gray-txt">Class</label>
													<input type="radio" name="class" id="classA" value="1"><label for="classA"><span></span>A</label>
													<input type="radio" name="class" id="classB" value="2" checked="checked"><label for="classB"><span></span>B</label>
												</div>
											</div>
										</div>
										<div class="form-group pull-right">
											<div class="col-sm-12">
												<button type="submit" id="relationSubmit" class="common-btn blue-btn btn-125">Submit</button>
											</div>
										</div>
									</form>
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
	var state = $('#state_id').val();
	$.ajax({
		   url: '<?= $this->Url->build(["controller" => "Cities", "action" => "getCitiesOption"])?>',
		   dataType: "json",
		   data: "state="+state,
		   type: "POST",
		   success: function(json) {
			   $('#city_id').html(json.cities);
			   $('#user_id').html('<option value="">Select MR</option>');
			   $('#doctor_id').html('<option value="">Select Doctors</option>');
		   }
    });
}
function loadUsersOption()
{
	var city = $('#city_id').val();
	var user = $('#user_id').val();
	if(user =="")
	{
		$.ajax({
			   url: '<?= $this->Url->build(["controller" => "Users", "action" => "getUsersOption"])?>',
			   dataType: "json",
			   data: "city="+city,
			   type: "POST",
			   success: function(json) {
				   $('#user_id').html(json.user);
				   $('#doctor_id').html('<option value="">Select Doctors</option>');
			   }
		});
	}
	else
	loadDoctorsOption()
}
function loadDoctorsOption()
{
	var city = $('#city_id').val();
	var user = $('#user_id').val();
	$.ajax({
		   url: '<?= $this->Url->build(["controller" => "Doctors", "action" => "getDoctorsOption"])?>',
		   dataType: "json",
		   data: "city="+city+"&user="+user,
		   type: "POST",
		   success: function(json) {
				if(json.chemist_id!="")
					$('#doctor_id').html(json.doctor_id);
				else
					$('#doctor_id').html('<option value="">No Doctors Found</option>');
		   }
    });
	
}
</script>
