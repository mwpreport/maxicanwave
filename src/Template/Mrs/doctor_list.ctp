<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Doctor Selection</h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form id="doctorsListForm" method="POST" action="../doctors-relation/mrs_add/">
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-6">
                            <select name="state" class="error form-control" id="state" aria-invalid="true">
								<?php
								foreach ($states as $state)
								{?>
								<option value="<?= $state['id']?>"><?= $state['name']?></option>
								<?php }	?>

                            </select>  
                        </div>
                        <div class="col-sm-6">
                            <select name="city" class="error form-control" id="city" onchange="loadDoctors()" aria-invalid="true">
								<?php
								foreach ($cities as $citiy)
								{?>
								<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?> ><?= $citiy['city_name']?></option>
								<?php }	?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-6 ">
                            <select name="speciality" class="error form-control" id="speciality" onchange="loadDoctors()" aria-invalid="true">
                                <option value="">Select Speciality</option>
								<?php
								foreach ($specialities as $speciality)
								{?>
								<option value="<?= $speciality['id']?>"><?= $speciality['name']?></option>
								<?php }	?>
                            </select>  
                        </div>
                        <div class="col-sm-6">
                            <select name="doctor_id" class="required form-control" id="doctor_id" aria-invalid="true">
                                <option value="">Select Doctor</option>
								<?php
								foreach ($doctors as $doctor)
								{?>
								<option value="<?= $doctor['id']?>"><?= $doctor['name']?></option>
								<?php }	?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="radio-blk">
                                <label for="exampleInputClass" class="gray-txt">Class</label>
								<?php
								foreach ($doctorTypes as $doctorType)
								{?>
                                <input type="radio" name="class" id="class<?=$doctorType['id']?>" value="<?=$doctorType['id']?>" <?php if($doctorType['id']==2) echo "checked";?>><label for="class<?=$doctorType['id']?>"><span></span><?=$doctorType['name']?></label>
								<?php }	?>
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
        </section>
        <section>
            <div class="white-wrapper mar-top-20 hide">
                <p class="text-center">There is no selection you have searched</p>
            </div>
        </section>
        <section>
            <div class="white-wrapper mar-top-20">
                <div class="col-md-12">
                    <div class="row">
                        <div class="profile-dr-selection">
                            <ul id="selectedProfile">
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-xs-12">
                    <div class="white-wrapper mar-top-20">
                        <!-- /.box-header -->
                        <div class="table-responsive">
                            <table  class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
					<th scope="col"><?= $this->Paginator->sort('code', 'ID') ?></th>
					<th scope="col"><?= $this->Paginator->sort('doctor_id', 'Name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('speciality_id','Speciality') ?></th>
					<th scope="col"><?= $this->Paginator->sort('class') ?></th>
					<th scope="col"><?= $this->Paginator->sort('city_id', 'Place') ?></th>
					<th scope="col" colspan="3" class="actions"><?= __('Options') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($doctorsRelation as $doctorsRelation): ?>
				<tr>
					<td><?= $this->Number->format($i) ?></td>
					<td><?= $doctorsRelation->has('doctor') ? $doctorsRelation->doctor->code : '' ?></td>
					<td><?= $doctorsRelation->has('doctor') ? $doctorsRelation->doctor->name : '' ?></td>
					<td><?= $doctorsRelation->has('doctor') ? $doctorsRelation->doctor->speciality->name : '' ?></td>
					<td><?= $doctorsRelation->has('doctor') ? $doctorsRelation->doctor->city->city_name : '' ?></td>
					<td><?= $doctorsRelation->has('doctor_type') ? $doctorsRelation->doctor_type->name : '' ?></td>
					<td width="60"><a href="javascript:void(0)" onclick="loadProfile(<?= $doctorsRelation->doctor_id ?>);"><img src="../images/eye.png" width="29" height="18" alt="profile"></a></td>
					<td width="50"><a href="#ModalEdit" class="popup-modal" onclick="loadProfileForm(<?= $doctorsRelation->id ?>);"><img src="../images/edit@2x.png" width="18" height="18" alt="edit"></a></td>
					<td width="50"><?= $this->Form->postLink(__('<img src="../images/del@2x.png" width="14" height="18" alt="trash">'), ['controller' => 'DoctorsRelation','action' => 'mrsDelete', $doctorsRelation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?></td>
				</tr>
				<?php $i++; endforeach; ?>
			</tbody>
		</table>
		<div class="paginator">
			<ul class="pagination">
				<?= $this->Paginator->first('<< ' . __('first')) ?>
				<?= $this->Paginator->prev('< ' . __('previous')) ?>
				<?= $this->Paginator->numbers() ?>
				<?= $this->Paginator->next(__('next') . ' >') ?>
				<?= $this->Paginator->last(__('last') . ' >>') ?>
			</ul>
			<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
		</div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
    </div>
    <!-- /.content -->
</div>
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="ModalEdit">
                <div class="popup-content">
					<form class="" id="ModalEditForm" method="POST"  action="../doctors-relation/mrs_update/">
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Update Doctors</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
							<div class="form-group mar-bottom-40">
								<div class="col-sm-6">
									<select name="state" class="error form-control" id="state" aria-invalid="true">
										<?php
										foreach ($states as $state)
										{?>
										<option value="<?= $state['id']?>"><?= $state['name']?></option>
										<?php }	?>

									</select>  
								</div>
								<div class="col-sm-6">
									<select name="city" class="error form-control" id="city" onchange="loadDoctors()" aria-invalid="true">
										<?php
										foreach ($cities as $citiy)
										{?>
										<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?> ><?= $citiy['city_name']?></option>
										<?php }	?>
									</select>  
								</div>
							</div>
							<div class="form-group mar-bottom-40">
								<div class="col-sm-6 ">
									<select name="speciality" class="error form-control" id="speciality" onchange="loadDoctors()" aria-invalid="true">
										<option value="">Select Speciality</option>
										<?php
										foreach ($specialities as $speciality)
										{?>
										<option value="<?= $speciality['id']?>"><?= $speciality['name']?></option>
										<?php }	?>
									</select>  
								</div>
								<div class="col-sm-6">
									<select name="doctor_id" class="required form-control" id="doctor_id" aria-invalid="true">
										<option value="">Select Doctor</option>
										<?php
										foreach ($doctors as $doctor)
										{?>
										<option value="<?= $doctor['id']?>"><?= $doctor['name']?></option>
										<?php }	?>
									</select>  
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="radio-blk">
										<label for="exampleInputClass" class="gray-txt">Class</label>
										<?php
										foreach ($doctorTypes as $doctorType)
										{?>
										<input type="radio" name="class" id="class<?=$doctorType['id']?>" value="<?=$doctorType['id']?>" <?php if($doctorType['id']==2) echo "checked";?>><label for="class<?=$doctorType['id']?>"><span></span><?=$doctorType['name']?></label>
										<?php }	?>
									</div>
								</div>
							</div>
							<input type="hidden" name="id" class="form-control" id="id">
                            <div class="col-md-4 col-sm-4 col-xs-4"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
                            <div class="col-md-4 col-sm-4 col-xs-4"> <button type="submit" id="updateSubmit" class="btn blue-btn btn-block">Save</button></div>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            <!-- pop ends here -->
        <script>
            $('.popup-modal').magnificPopup({
                type: 'inline',
                preloader: false,
                modal: true
            });
            $(document).on('click', '.popup-modal-dismiss', function (e) {
                e.preventDefault();
                reset_form();
                $.magnificPopup.close();
            });
        </script>

<script>
function loadDoctors(){
	var city = $('#city').val();
	var speciality = $('#speciality').val();
	$.ajax({
		   url: '../doctors/mrs_get_doctors/',
		   data: "city="+city+"&speciality="+speciality,
		   type: "POST",
		   success: function(json) {
			   $('#doctor_id').html(json);
		   }
    });
}
function loadProfile(id){
	$.ajax({
		   url: '../doctors/mrs_get_doctor/',
		   data: "id="+id,
		   type: "POST",
		   success: function(json) {
			   $('#selectedProfile').html(json);
		   }
    });
}
function loadProfileForm(id){
	var doctors = $('#doctor_id').html();
	$.ajax({
		   url: '../doctors-relation/mrs_get_relation/',
		   dataType: "json",
		   data: "id="+id,
		   type: "POST",
		   success: function(json) {
			   $('#ModalEditForm #id').val(json.id);
			   $('#ModalEditForm #city').val(json.city);
			   $('#ModalEditForm #speciality').val(json.speciality);
			   $('#ModalEditForm #doctor_id').html(doctors+json.doctor);
			   $('#ModalEditForm radio').prop("checked", false);
			   $('#ModalEditForm #class'+json.class).prop("checked", true);
		   }
    });
}
function addDoctor(){
	$.ajax({
		   url: '../doctors-relation/mrs_add/',
		   dataType: "json",
		   data: $('#doctorsListForm').serialize(),
		   type: "POST",
		   success: function(json) {
			   location.reload();
		   }
    });
}
$("#doctorsListForm").validate();
$("#ModalEdit #ModalEditForm").validate();



</script>
