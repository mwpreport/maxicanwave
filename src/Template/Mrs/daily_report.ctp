<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Daily Report</h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="daily-report-radio-cnt">
						<div class="col-md-12 mar-bottom-20">
							<div class="row">
							<?php $reportDate = ""; if($date!="") $reportDate = date("Y-m-d", strtotime($date));?>
							<form action="#" method="post" >
								<div class="form-group">
									<div class="col-sm-3">
										<h3 class="mar-top-10 mar-bottom-20">Select Date</h3>
									</div>
									<div class="col-sm-3">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" name="reportDate" id="reportDate" value="<?php echo $reportDate;?>">
										</div>
									</div>
									<!-- /.input group -->
								</div>
							</div>
						</form>
						</div>
						<?php if($date!=""){?>
						<div class="col-sm-12 mar-bottom-20">
							<ul>
								<li class="col-md-12"><h3 class="mar-top-20 mar-bottom-20">Type of Work</h3></li>
								<li class="col-md-3"><input type="radio" name="workType" id="workType_2" value="2"><label for="workType_2"><span></span>Field Work</label></li>
								<?php foreach ($workTypes as $workType){?>
									<li class="col-md-3"><input type="radio" name="workType" id="workType_<?php echo $workType->id?>" value="<?php echo $workType->id?>"><label for="workType_<?php echo $workType->id?>"><span></span><?php echo $workType->name;?></label></li>
								<?php $workTypePlans[$workType->id]=[];}?>
								<li class="col-md-3"><input type="radio" name="workType" id="workType_1" value="1"><label for="workType_1"><span></span>Leave</label></li>
							</ul>
							<div class="clearfix"></div><hr />

						</div>
						<?php }?>
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20 hide" id="workType_section_2">
							<form method="post" action="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField"])?>?date=<?php echo $reportDate;?>">
							<input type="hidden" value="<?php echo $reportDate;?>" name="date">
								<div class="col-md-12 mar-bottom-20">
								
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" name="SubmitField" id="w2SubmitSave">Submit</button>
												</div>
												<div class="col-sm-3">
													<a class="common-btn blue-btn margin-right-35 pull-right" href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewDailyReport",'?' => ['date' => $reportDate]])?>" target="blank"><b>View Reported Calls</b></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							
							</form>
							</div>
							<?php
							foreach ($WorkPlans as $WorkPlan)
							{
								$workTypePlans[$WorkPlan->work_type_id][] = $WorkPlan;
							}
							?>
							<?php foreach ($workTypes as $workType){?>
							<div class="col-sm-12 mar-bottom-20 hide" id="workType_section_<?php echo $workType->id?>">
								<div class="col-md-12 mar-bottom-20">
									<?php 
										$html = "";
										if(count($workTypePlans[$workType->id]))
										{
											$html.='<h3 class="mar-top-10 mar-bottom-10">Planned '.$workType->name.'</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width=""><input type="checkbox" class="check_all" onclick="toggleCheck(this)" value="1"></th><th>Work Type</th><th>City</th></thead><tbody>';
											foreach ($workTypePlans[$workType->id] as $workTypePlan)
											{
												$html.='<tr class="'.(($workTypePlan->is_reported)?"reported":"").' '.(($workTypePlan->is_missed)?"missed":"").'"><td><input class=" workplan_id_'.$workType->id.'" type="checkbox" '.(($workTypePlan->is_missed)?"disabled":"").' name="workplan_id['.$workTypePlan->id.']" value="'.$workTypePlan->id.'"></td><td>'.$workTypePlan->work_type->name.'</td><td>'.$workTypePlan->city->city_name.'</td></tr>';
											}
											$html.='</tbody></table>';
										}
									?>
									<?php if($html == ""){?>
									<div class="table-responsive">
										<p>No Planned <?php echo $workType->name?> on this date</p>
									</div>
									<?php }else {?>
									<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
									<input type="hidden" value="<?php echo $reportDate;?>" name="reportDate">
									<div class="table-responsive">
										<?php echo $html;?>
									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<input type="hidden" id="return" name="return" value="dailyReport" >
													<input type="submit" id="w<?php echo $workType->id?>SubmitSave" name="SubmitSave" class="hide" >
													<button class="common-btn blue-btn pull-left" value="w<?php echo $workType->id?>SubmitSave" type="button" name="" id="w<?php echo $workType->id?>ButtonSave">Save</button>
												</div>
												<div class="col-sm-3">
													<input type="submit" id="w<?php echo $workType->id?>SubmitMissed" name="SubmitMissed" class="hide" >
													<button class="common-btn blue-btn pull-left" value="w<?php echo $workType->id?>SubmitMissed" type="button" name="" id="w<?php echo $workType->id?>ButtonMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<input type="submit" id="w<?php echo $workType->id?>SubmitRemove" name="SubmitRemove" class="hide" >
													<button class="common-btn blue-btn pull-left" value="w<?php echo $workType->id?>SubmitRemove" type="button" name="" id="w<?php echo $workType->id?>ButtonRemove">Remove Visit List</button>
												</div>
											</div>
										</div>
									</div>
									</form>
									<script>
										$("#w<?php echo $workType->id?>ButtonSave,#w<?php echo $workType->id?>ButtonMissed,#w<?php echo $workType->id?>ButtonRemove").click(function(){
											var target_id = $(this).val();
											if ($('input[type="checkbox"].workplan_id_<?php echo $workType->id?>').is(':checked'))
											{
												$( "#"+target_id ).click();
											}
											else{
												alert("Please check a Plan");
											}
										});
									</script>
									<?php }?>
								</div>
								<div class="col-md-12 mar-bottom-20">
								<hr />
									<form class="workplanForm" id="<?php echo $workType->id?>AddForm" method="POST" >
										<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
										<input type="hidden" name="work_type_id" value="<?php echo $workType->id?>">
										<div class="row">
											<div class="form-group">
												<div class="col-sm-12 mar-bottom-20">
													<div class="col-md-3 col-sm-3 col-xs-3 form-group">
														<label for="city_id">City</label>
														<select name="city_id" class="form-control required" id="city_id" aria-invalid="true">
															<option value="">Select</option>
															<?php
															foreach ($cities as $citiy)
															{?>
															<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
															<?php }	?>
														</select>  
													</div>
													<div class="col-md-3 col-sm-3 col-xs-3"><label>&nbsp;</label>
														<button type="submit" class="common-btn blue-btn btn-block margin-right-35"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $workType->name?></button>
													</div>
													<div class="col-md-3 col-sm-3 col-xs-3"><label>&nbsp;</label>
														<a class="common-btn blue-btn margin-right-35 pull-right" href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewDailyReport",'?' => ['date' => $reportDate]])?>" target="blank"><b>View Reported Calls</b></a>
													</div>
												</div>
												<!-- /.input group -->
											</div>
										</div>
									</form>
								</div>
							</div>
							<script>
							$("#<?php echo $workType->id?>AddForm").validate({
								ignore: ":hidden",
								submitHandler: function (form) {
									doSubmit("#<?php echo $workType->id?>AddForm")
									return false; // required to block normal submit since you used ajax
								}
							});

							</script>
							<?php }?>
							<div class="col-sm-12 mar-bottom-20 hide" id="workType_section_1">
								<div class="col-md-12 mar-bottom-20">
									<?php 
										$html = "";
										if(isset($workTypePlans[1]))if(count($workTypePlans[1]))
										{
											$html.='<h3 class="mar-top-10 mar-bottom-10">Planned Leave</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width=""><input type="checkbox" name="check_all" value="1"></th><th>Work Type</th><th>On</th></thead><tbody>';
											foreach ($workTypePlans[1] as $workTypePlan)
											{
												$html.='<tr class="'.(($workTypePlan->is_reported)?"reported":"").' '.(($workTypePlan->is_missed)?"missed":"").' "><td><input type="checkbox" '.(($workTypePlan->is_missed)?"disabled":"").' name="workplan_id['.$workTypePlan->id.']" value="'.$workTypePlan->id.'"></td><td>'.$workTypePlan->work_type->name.'</td><td>'.$reportDate.'</td></tr>';
											}
											$html.='</tbody></table>';
										}
									?>
									<?php if($html == ""){?>
									<div class="table-responsive">
										<p>No Planned Leave on this date</p>
									</div>
									<?php }else {?>
									<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
									<input type="hidden" value="<?php echo $reportDate;?>" name="reportDate">
									<div class="table-responsive">
										<?php echo $html;?>
									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" value="w1SubmitSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" value="w1SubmitMissed">Missed</button>
												</div>
											</div>
										</div>
									</div>
									</form>
									<?php }?>
								</div>
								<div class="col-md-12 mar-bottom-20">
								<hr />
									<form class="workplanForm" id="LeaveAddForm" method="POST" >
										<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
										<input type="hidden" name="work_type_id" value="1">
										<input type="hidden" name="city_id" value="<?= $userCity?>">
										<div class="row">
											<div class="form-group">
												<div class="col-sm-12 mar-bottom-20">
													<div class="col-md-3 col-sm-3 col-xs-3 form-group">
														<label for="city_id">Type of Leave</label>
														<select name="plan_reason" class="form-control required" id="plan_reason" aria-invalid="true">
															<option value="">Select</option>
															<?php
															foreach ($leaveTypes as $leaveType)
															{?>
															<option value="<?= $leaveType['id']?>"><?= $leaveType['name']?></option>
															<?php }	?>
														</select>  
													</div>
													<div class="col-md-3 col-sm-3 col-xs-3 form-group">
														<label for="city_id">More Detials</label>
														<textarea class="form-control required" name="plan_details" id="plan_details" rows="3"></textarea>  
													</div>
													<div class="col-md-3 col-sm-3 col-xs-3 form-group">
														<label>&nbsp;</label>
														<button type="submit" class="common-btn blue-btn btn-block margin-right-35"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Leave</button>
													</div>
												</div>
												<!-- /.input group -->
											</div>
										</div>
									</form>
								</div>
							</div>

						</div>
						
						</div>
					<!--
					<hr>
					<table border=0 cellpadding="5" cellspacing="5">
					<tr class="reported"><td>Saved Reports</td></tr>
					<tr class="reported unplanned"><td>Saved Reports (Unplanned Doctors)</td></tr>
					</table>
					-->

            </div>
        </section>
		
    </div>
    <!-- /.content -->
</div>
<script>

	//Date for the calendar events (dummy data)
	var date = new Date(), y = date.getFullYear(), m = date.getMonth(), d = date.getDate();
	var startDate = new Date(y, m, 1);
	var endDate = new Date(y, m + 1, 0);

	//Date picker
	$('#reportDate').datepicker({
		autoclose: true, startDate: startDate, endDate: endDate
	});
	$('#missed_doctors_table [type="text"]').datepicker({
		autoclose: true, startDate: new Date(y, m, d + 1), endDate: endDate
	});

	$('#reportDate').on('changeDate', function (ev) {
		window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport"])?>?date="+moment(ev.date).format('YYYY-MM-DD'));
	});
	
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
	
	$("#UnplannedAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#UnplannedAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("#ChemistAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#ChemistAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("#StockistAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#StockistAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("#DoctorsMissedForm").validate({
		ignore: ":hidden"
		
	});
	$("#LeaveAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#LeaveAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("input[id^='workType_']").click(function(){
		if ($(this).is(':checked'))
		{
			$("div[id^='workType_section_']").addClass("hide");
			$("#workType_section_"+$(this).val()).removeClass("hide");
			$('input[type="checkbox"].workplan_id').prop('checked', false);
		}
	});
	
	$("#w2SubmitMissed").click(function(){
		$('#DoctorsMissedForm')[0].reset();
		if ($('input[type="checkbox"].workplan_id').is(':checked'))
		{
			var yourArray = [];
			$('input[type="checkbox"].workplan_id:checked').each(function(){
				$('#missed_'+$(this).val()).show();
				$('#m_workplan_id_'+$(this).val()).prop('checked', true);
			});
			$('#DoctorsMissedLink').click();
		}
		else{
			alert("Please check a Doctor");
		}
	});
	
	$("input[id^='m_cancel_plan_']").click(function(){
		if ($(this).is(':checked'))
		{
			$("#alt_date_"+$(this).val()).addClass("hide");
			$("#alt_date_"+$(this).val()+"-error").addClass("hide");
		}
		else
		{
			$("#alt_date_"+$(this).val()).removeClass("hide");
			$("#alt_date_"+$(this).val()+"-error").removeClass("hide");
		}
	});
  
	function reset_form(){
		$('#StockistAddForm, #ChemistAddForm, #UnplannedAddForm')[0].reset();
	}
	function reset_missed_form(){
		$("tr[id^='missed_']").hide();
		$('#DoctorsMissedForm')[0].reset();
		$('#DoctorsMissedForm input[type="checkbox"]').prop('checked', false);
	}
	
	function toggleCheck(elem)
	{
		if($(elem).prop("checked") == true)
		$(elem).closest("form").find("input:checkbox").prop('checked', true);
		else
		$(elem).closest("form").find("input:checkbox").prop('checked', false);
	}
	
	function productClick(elem){
		var id=$(elem).val();
		if($(elem).prop("checked") == true)
		$(elem).closest("form").find('#product_qty_'+id).prop('disabled', false);
		else
		{
		$(elem).closest("form").find('#product_qty_'+id+"-error").addClass("hide");
		$(elem).closest("form").find('#product_qty_'+id).val('');
		$(elem).closest("form").find('#product_qty_'+id).prop('disabled', true);
		}
	}
	
	function productShow(id){
		var str = ""; var i=0;
		$('input[type="checkbox"].products_'+id+':checked').each(function () {
		if(i>0) str += ", ";
		str += $(this).val();
		i++;
		});
		if(str != "")
		{$("#pdt_link_"+id).html(str);$("#pdt_val_"+id).val($("#products_"+id).val());}
		else
		{$("#pdt_link_"+id).html("Select Products");}
	}

	function loadDoctors(id){
		var city_id = $('#'+id+' #city_id').val();
		var start_date = $('#'+id+' #start_date').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetDoctors"])?>',
			   data: "city_id="+city_id+"&start_date="+start_date,
			   type: "POST",
			   success: function(json) {
				   $('#doctor_id').html(json);
			   }
		});
	}

	function loadChemists(id){
		var city_id = $('#'+id+' #city_id').val();
		var start_date = $('#'+id+' #start_date').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetChemists"])?>',
			   data: "city_id="+city_id+"&start_date="+start_date,
			   type: "POST",
			   success: function(json) {
				   $('#chemist_id').html(json);
			   }
		});
	}

	function loadStockists(id){
		var city_id = $('#'+id+' #city_id').val();
		var start_date = $('#'+id+' #start_date').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetStockists"])?>',
			   data: "city_id="+city_id+"&start_date="+start_date,
			   type: "POST",
			   success: function(json) {
				   $('#stockist_id').html(json);
			   }
		});
	}

	function doSubmit(form){ // add event
	   $.ajax({
		   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAddReport"])?>',
		   dataType: "json",
		   data: $(form).serialize()+"&action=add",
		   type: "POST",
		   success: function(json) {
			   if(json.status == 1)
			   {	
					window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport"])?>/?date=<?php echo $reportDate;?>");			   
					$.magnificPopup.close();
			   }
			   else
			   {
					alert(json.msg);
			   }
		   }
	   });
	}
	
	function doDelete(eventID){  // delete event 
		if (confirm("Are you sure on deleting this?"))
		{
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsDeleteReport"])?>',
			   dataType: "json",
			   data: 'action=delete&id='+eventID,
			   type: "POST",
			   success: function(json) {
				   if(json.status == 1)
					{
						window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport"])?>/?date=<?php echo $reportDate;?>");			   
					}
				   else
						alert(json.msg);
			   }
		   });
		}
	}


</script>
