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
				<?php
				
				?>
                <div class="clearfix"></div>
                <div class="daily-report-radio-cnt">
						<div class="col-md-12 mar-bottom-20">
							<div class="row">
							<?php $reportDate = ""; if($date!="") $reportDate = date("Y-m-d", strtotime($date));?>
							<form action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "finalSaveDailyReport",'?' => ['date' => $reportDate]])?>" method="post" >
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
									<div class="col-sm-6">
									 <div class="col-sm-6"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewDailyReport",'?' => ['date' => $reportDate]])?>" class="btn btn-block margin-right-35"><b>View Reported Calls</b></a></div>
									 <div class="col-sm-6"><button class="btn blue-btn btn-block margin-right-35 pull-right" type="submit">Final Submit</a></div>
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
								<li class="col-md-3"><input type="radio" name="workType" id="workType_2" value="2"><label for="workType_2"><span></span>Field</label></li>
								<?php foreach ($workTypes as $workType){?>
									<li class="col-md-3"><input type="radio" name="workType" id="workType_<?php echo $workType->id?>" value="<?php echo $workType->id?>"><label for="workType_<?php echo $workType->id?>"><span></span><?php echo $workType->name;?></label></li>
								<?php $workTypePlans[$workType->id]=[];}?>
							</ul>
							<div class="clearfix"></div><hr />
						</div>
						<?php }?>
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20 hide" id="workType_section_2">
							<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
								<div class="col-md-12 mar-bottom-20">
									<?php
									$html = "";
									if(count($WorkPlansD))
									{
										$work_with = '<select name="work_with[%s]"><option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option></select>';
										$is_missed = '<select name="missed_reason[%s]"><option value="">No</option><option>Doctor Refused Appointment</option><option>Doctor on Leave</option><option>Doctor not in Station</option><option>Plan Changed</option><option>Meeting / CME</option><option>Others</option></select>';
										$product_popup = '<div class="mfp-hide white-popup-block small_popup doctor_product" id="doctor_product_%s">
										<div class="popup-content">
											<div class="popup-header">
												<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
												<div class="hr-title"><h4>Select Products Given as samples</h4><hr /></div>
											</div>
											<div class="popup-body">
												<div class="row">
													<div class="col-sm-12 mar-bottom-20">
														<div class="radio-blk">
														<select name="products[%s]" multiple="" id="products_%s"  onchange="productShow(%s)">%products</select>
														</div>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss pull-right">OK</button></div>
												</div>
											</div>
										</div>';

										$html.='<h3 class="mar-top-10 mar-bottom-10">Planned Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width=""><input type="checkbox" name="check_all" value="1"></th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th></tr></thead><tbody>';
										foreach ($WorkPlansD as $WorkPlanD)
										{
											
											$work_with_selected = str_replace("<option>".$WorkPlanD->work_with."</option>","<option selected>".$WorkPlanD->work_with."</option>",$work_with);
											$is_missed_selected = str_replace("<option>".$WorkPlanD->missed_reason."</option>","<option selected>".$WorkPlanD->missed_reason."</option>",$is_missed);;
											$products_array = array();
											if($WorkPlanD->products!="")
											$products_array = unserialize($WorkPlanD->products);

											$sample_products =array();$product_options="";
											foreach($products as $product)
											{
												if (in_array($product->id, $products_array))
												{
													$product_options.='<option value="'.$product->id.'" selected>'.$product->name.'</option>';
													$sample_products[$product->id]= $product->name;
												}
												else
												$product_options.='<option value="'.$product->id.'">'.$product->name.'</option>';
													
											}
											if(count($sample_products)>0) {$pdt_lnk_text = implode(", ",$sample_products); $pdt_val_text=implode(",",array_keys($sample_products));}
											else {$pdt_lnk_text = "Select Products"; $pdt_val_text="";}
											$product_popup_selected = str_replace("%products",$product_options,$product_popup);
											$html.='<tr class="'.(($WorkPlanD->is_reported)?"reported":"").' '.(($WorkPlanD->is_unplanned)?"unplanned":"").'"><td><input type="checkbox" name="workplan_id['.$WorkPlanD->id.']" value="1"></td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>'.str_replace("%s",$WorkPlanD->id,$work_with_selected).'</td><td><a href="#doctor_product_'.$WorkPlanD->id.'" id="pdt_link_'.$WorkPlanD->id.'" class="popup-modal">'.$pdt_lnk_text.'</a><input type="hidden" id="pdt_val_'.$WorkPlanD->id.'" name=pdt_val['.$WorkPlanD->id.'] value="'.$pdt_val_text.'">'.str_replace("%s",$WorkPlanD->id,$product_popup_selected).'</td></tr>';
										}
										$html.='</tbody></table>';
									}
									?>
									<?php if($html == ""){?>
									<div class="table-responsive">
										<p>No Planned Doctors on this date</p>
									</div>
									<?php }else {?>
									<div class="table-responsive">
										<?php echo $html;?>
									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" id="ReportSubmitSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" id="ReportSubmitMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" id="ReportSubmitRemove">Remove Visit List</button>
												</div>
											</div>
										</div>
									</div>
									<?php }?>
								</div>
							
								<div class="col-md-12 mar-bottom-20">
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
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
												<div class="col-sm-3">
													<a  href="#PGOthers" class="popup-modal common-btn blue-btn pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> PG & Others</a>
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
											$html.='<h3 class="mar-top-10 mar-bottom-10">Planned '.$workType->name.'</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width=""><input type="checkbox" name="check_all" value="1"></th><th>Work Type</th><th>City</th></thead><tbody>';
											foreach ($workTypePlans[$workType->id] as $workTypePlan)
											{
												$html.='<tr class="'.(($workTypePlan->is_reported)?"reported":"").' "><td><input type="checkbox" name="workplan_id['.$workTypePlan->id.']" value="1"></td><td>'.$workTypePlan->work_type->name.'</td><td>'.$workTypePlan->city->city_name.'</td></tr>';
											}
											$html.='</tbody></table>';
										}
									?>
									<?php if($html == ""){?>
									<div class="table-responsive">
										<p>No Planned <?php echo $workType->name?> on this date</p>
									</div>
									<?php }else {?>
									<div class="table-responsive">
										<?php echo $html;?>
									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" id="ReportSubmitSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" id="ReportSubmitMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" id="ReportSubmitRemove">Remove Visit List</button>
												</div>
											</div>
										</div>
									</div>
									<?php }?>
								</div>
								<div class="col-md-12 mar-bottom-20">
								<hr />
									<form class="workplanForm" id="<?php echo $workType->name?>AddForm" method="POST" >
										<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
										<input type="hidden" name="work_type_id" value="<?php echo $workType->id?>">
										<div class="row">
											<div class="form-group">
												<div class="col-sm-12 mar-bottom-20">
													<div class="col-md-6 col-sm-6 col-xs-6 form-group">
														<label for="city_id">City</label>
														<select name="city_id" onchange="loadChemists(this.form.id)" class="form-control required" id="city_id" aria-invalid="true">
															<option value="">Select</option>
															<?php
															foreach ($cities as $citiy)
															{?>
															<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
															<?php }	?>
														</select>  
													</div>
													<div class="col-md-3 col-sm-3 col-xs-3">
														<label>&nbsp;</label>
														<button type="submit" class="btn blue-btn btn-block margin-right-35">Add <?php echo $workType->name?></button>
													</div>
												</div>
												<!-- /.input group -->
											</div>
										</div>
									</form>
								</div>
							</div>
							<?php }?>
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
		<?php if($date!=""){?>
		<!-- pop starts here -->
		<div class="mfp-hide white-popup-block small_popup" id="UnplannedAdd">
			<div class="popup-content">
				<form class="" id="UnplannedAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="2">
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss add-form"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Doctors</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">City</label>
								<select name="city_id" onchange="loadDoctors(this.form.id)" class="form-control required" id="city_id" aria-invalid="true">
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
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Chemists</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">City</label>
								<select name="city_id" onchange="loadChemists(this.form.id)" class="form-control required" id="city_id" aria-invalid="true">
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
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Stockists</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">City</label>
								<select name="city_id" class="form-control required" onchange="loadStockists(this.form.id)" id="city_id" aria-invalid="true">
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
		<div class="mfp-hide white-popup-block small_popup" id="PGOthers">
			<div class="popup-content">
				<form class="" id="StockistAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add PG & Others</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">Doctor Name</label>
								<input type="text" name="name" id="name" class="form-control required">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group">
								<label for="city_id">City</label>
								<select name="city_id" class="form-control required" onchange="loadStockists(this.form.id)" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group">
								<label for="stockit_id">Select Speciality</label>
								<select name="city_id" class="form-control required" onchange="loadStockists(this.form.id)" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($specialities as $speciality)
									{?>
									<option value="<?= $speciality['id']?>" ><?= $speciality['city_name']?></option>
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

	$("input[id^='workType_']").click(function(){
		if ($(this).is(':checked'))
		{
			$("div[id^='workType_section_']").addClass("hide");
			$("#workType_section_"+$(this).val()).removeClass("hide");
			//alert($(this).val());
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
