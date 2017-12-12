<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Chemist Selection</h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form id="chemistsListForm" method="POST" action="../chemists-relation/mrs_add/">
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
                            <select name="city" class="error form-control" id="city" onchange="loadChemists()" aria-invalid="true">
								<?php
								foreach ($cities as $citiy)
								{?>
								<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?> ><?= $citiy['city_name']?></option>
								<?php }	?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-6">
                            <select name="chemist_id" class="required form-control" id="chemist_id" aria-invalid="true">
                                <option value="">Select Chemist</option>
								<?php
								foreach ($chemists as $chemist)
								{?>
								<option value="<?= $chemist['id']?>"><?= $chemist['name']?></option>
								<?php }	?>
                            </select>  
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
					<th scope="col"><?= $this->Paginator->sort('chemist_id', 'Name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('city_id', 'Place') ?></th>
					<th scope="col" colspan="3" class="actions"><?= __('Options') ?></th>
				</tr>
			</thead>
			<!--<th>S.No</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th colspan="3">Options</th>-->
			<tbody>
				<?php $i=1; foreach ($chemistsRelation as $chemistsRelation): ?>
				<tr>
					<td><?= $this->Number->format($i) ?></td>
					<td><?= $chemistsRelation->has('chemist') ? $chemistsRelation->chemist->code : '' ?></td>
					<td><?= $chemistsRelation->has('chemist') ? $chemistsRelation->chemist->name : '' ?></td>
					<td><?= $chemistsRelation->has('chemist') ? $chemistsRelation->chemist->address.", ".$chemistsRelation->chemist->city->city_name.", ".$chemistsRelation->chemist->state->state_code." ".$chemistsRelation->chemist->pincode : '' ?></td>
					<td width="60"><a href="javascript:void(0)" onclick="loadProfile(<?= $chemistsRelation->chemist_id ?>);"><img src="../images/eye.png" width="29" height="18" alt="profile"></a></td>
					<td width="50"><a href="#ModalEdit" class="popup-modal" onclick="loadProfileForm(<?= $chemistsRelation->id ?>);"><img src="../images/edit@2x.png" width="18" height="18" alt="edit"></a></td>
					<td width="50"><?= $this->Form->postLink(__('<img src="../images/del@2x.png" width="14" height="18" alt="trash">'), ['controller' => 'ChemistsRelation','action' => 'mrsDelete', $chemistsRelation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?></td>
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
					<form class="" id="ModalEditForm" method="POST"  action="../chemists-relation/mrs_update/">
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Update Chemists</h4><hr /></div>
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
									<select name="city" class="error form-control" id="city" onchange="loadChemists()" aria-invalid="true">
										<?php
										foreach ($cities as $citiy)
										{?>
										<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?> ><?= $citiy['city_name']?></option>
										<?php }	?>
									</select>  
								</div>
							</div>
							<div class="form-group mar-bottom-40">
								<div class="col-sm-6">
									<select name="chemist_id" class="required form-control" id="chemist_id" aria-invalid="true">
										<option value="">Select Chemist</option>
										<?php
										foreach ($chemists as $chemist)
										{?>
										<option value="<?= $chemist['id']?>"><?= $chemist['name']?></option>
										<?php }	?>
									</select>  
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
function loadChemists(){
	var city = $('#city').val();
	$.ajax({
		   url: '../chemists/mrs_get_chemists/',
		   data: "city="+city,
		   type: "POST",
		   success: function(json) {
			   $('#chemist_id').html(json);
		   }
    });
}
function loadProfile(id){
	$.ajax({
		   url: '../chemists/mrs_get_chemist/',
		   data: "id="+id,
		   type: "POST",
		   success: function(json) {
			   $('#selectedProfile').html(json);
		   }
    });
}
function loadProfileForm(id){
	var chemists = $('#chemist_id').html();
	$.ajax({
		   url: '../chemists-relation/mrs_get_relation/',
		   dataType: "json",
		   data: "id="+id,
		   type: "POST",
		   success: function(json) {
			   $('#ModalEditForm #id').val(json.id);
			   $('#ModalEditForm #city').val(json.city);
			   $('#ModalEditForm #chemist_id').html(chemists+json.chemist);
		   }
    });
}
function addChemist(){
	$.ajax({
		   url: '../chemists-relation/mrs_add/',
		   dataType: "json",
		   data: $('#chemistsListForm').serialize(),
		   type: "POST",
		   success: function(json) {
			   location.reload();
		   }
    });
}
$("#chemistsListForm").validate();
$("#ModalEdit #ModalEditForm").validate();



</script>
