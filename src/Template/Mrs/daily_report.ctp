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
					<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
						<div class="col-md-6 mar-bottom-20">
							<div class="row">
								<div class="form-group">
									<div class="col-sm-3">
										<h3 class="mar-top-10 mar-bottom-20">Select Date</h3>
									</div>
									<div class="col-sm-9">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<?php $reportDate = ""; if($date!="") $reportDate = date("Y-m-d", strtotime($date));?>
											<input type="text" class="form-control pull-right" name="reportDate" id="reportDate" value="<?php echo $reportDate;?>">
										</div>
									</div>
									<!-- /.input group -->
								</div>
							</div>
						</div>
						<div class="col-sm-12 mar-bottom-20">
							<div class="table-responsive" id="report_section">
							<?= $html?>
							</div>
						</div>
						<div class="clearfix"></div>
						<?php if($date!=""){?>
						<div class="center-button-container">
							<div class="row">
								<div class="form-group  mar-top-30">
									<div class="col-sm-3">
										<button class="common-btn blue-btn pull-left" type="submit" id="ReportSubmit">Save</button>
									</div>
								</div>
								<hr>
								<div class="form-group  mar-top-10">
									<div class="col-sm-3">
										<a  href="#UnplannedAdd" class="popup-modal common-btn blue-btn pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Unplanned Doctors</a>
									</div>
									<div class="col-sm-3">
										<a  href="#ChemistAdd" class="popup-modal common-btn blue-btn pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Chemists</a>
									</div>
									<div class="col-sm-3">
										<a  href="#StockistAdd" class="popup-modal common-btn blue-btn pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Stockists</a>
									</div>
								</div>
							</div>
						</div>
						<?php }?>
					</form>
					<hr>
					<table border=0 cellpadding="5" cellspacing="5">
					<tr class="reported"><td>Saved Reports</td></tr>
					<tr class="reported unplanned"><td>Saved Reports (Unplanned Doctors)</td></tr>
					</table>
                </div>

            </div>
        </section>
		<?php if($date!=""){?>
		<!-- pop starts here -->
		<div class="mfp-hide white-popup-block small_popup" id="UnplannedAdd">
			<div class="popup-content">
				<form class="" id="UnplannedAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="2">
				<input type="hidden" id="reported_doctors" value="<?php echo serialize($reported_doctors)?>">
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss add-form"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Doctors</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">City</label>
								<select name="city_id" onchange="loadDoctors(this.value)" class="form-control required" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group">
								<label for="doctor_id">Select Doctor</label>
								<select name="doctor_id[]" class="form-control required" id="doctor_id" aria-invalid="true" multiple="multiple">
									<?php
									if(count($doctorsRelation)>0)
									foreach ($doctorsRelation as $doctor)
									{?>
									<option value="<?= $doctor['doctor_id']?>"><?= $doctor->doctor->name?></option>
									<?php }	?>
								</select>  
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="UnplannedSubmit" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block small_popup" id="ChemistAdd">
			<div class="popup-content">
				<form class="" id="ChemistAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				<input type="hidden" id="reported_chemists" value="<?php echo serialize($reported_chemists)?>">
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Chemists</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">City</label>
								<select name="city_id" onchange="loadChemists(this.value)" class="form-control required" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group">
								<label for="chemist_id">Select Chemists</label>
								<select name="chemist_id[]" class="form-control required" id="chemist_id" aria-invalid="true" multiple="multiple">
									<?php
									foreach ($chemists as $chemist)
									{?>
									<option value="<?= $chemist->id?>"><?= $chemist->name?></option>
									<?php }	?>
								</select>  
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="ChemistSubmit" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block small_popup" id="StockistAdd">
			<div class="popup-content">
				<form class="" id="StockistAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				<input type="hidden" id="reported_stockists" value="<?php echo serialize($reported_stockists)?>">
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Stockists</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">City</label>
								<select name="city_id" class="form-control required" onchange="loadStockists(this.value)" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group">
								<label for="stockit_id">Select Stockists</label>
								<select name="stockist_id[]" class="form-control required" id="stockist_id" aria-invalid="true" multiple="multiple">
									<?php
									foreach ($stockists as $stockist)
									{?>
									<option value="<?= $stockist->id?>"><?= $stockist->name?></option>
									<?php }	?>
								</select>  
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="StockistSubmit" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<?php }?>


    </div>
    <!-- /.content -->
</div>
<script>

	//Date for the calendar events (dummy data)
	var date = new Date(), y = date.getFullYear(), m = date.getMonth();
	var startDate = new Date(y, m, 1);
	var endDate = new Date(y, m + 1, 0);

	//Date picker
	$('#reportDate').datepicker({
		autoclose: true, startDate: startDate, endDate: endDate
	});

	$('#reportDate').on('changeDate', function (ev) {
		window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport"])?>/?date="+moment(ev.date).format('YYYY-MM-DD'));
		/*$.ajax({
			   url: '../work-plans/mrsGetReports/',
			   dataType: "json",
			   data: "date="+moment(ev.date).format('YYYY-MM-DD'),
			   type: "POST",
			   success: function(json) {
				   $("#report_section").html(json.html);
			   }
		   });
		*/
		
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

	
	function reset_form(){
		$('#StockistAddForm, #ChemistAddForm, #UnplannedAddForm')[0].reset();
	}
	
	function productShow(id){
		var str = ""; var i=0;
		$("#products_"+id+" option:selected").each(function () {
		if(i>0) str += ", ";
		str += $(this).text();
		i++;
		});
		if(str != "")
		{$("#pdt_link_"+id).html(str);$("#pdt_val_"+id).val($("#products_"+id).val());}
		else
		{$("#pdt_link_"+id).html("Select Products");}
	}

	function loadDoctors(city){
		var r_doctors = $('#reported_doctors').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetDoctors"])?>',
			   data: "city="+city+"&r_doctors="+r_doctors,
			   type: "POST",
			   success: function(json) {
				   $('#doctor_id').html(json);
			   }
		});
	}

	function loadChemists(city){
		var r_chemists = $('#reported_chemists').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetChemists"])?>',
			   data: "city="+city+"&r_chemists="+r_chemists,
			   type: "POST",
			   success: function(json) {
				   $('#chemist_id').html(json);
			   }
		});
	}

	function loadStockists(city){
		var r_stockists = $('#reported_stockists').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetStockists"])?>',
			   data: "city="+city+"&r_stockists="+r_stockists,
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
