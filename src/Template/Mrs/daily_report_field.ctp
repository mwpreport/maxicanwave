<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
						<?php $reportDate = ($date!="")?date("Y-m-d", strtotime($date)):"";?>
                        <h2>Daily Report of <?= ($date!="")?date("Y-m-d (l)", strtotime($date)):"" ?> <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport",'?' => ['date' => $reportDate]])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="daily-report-radio-cnt">
						<div class="col-md-12 mar-bottom-20">
							<div class="row">
							<form action="<?php echo $this->Url->build(["controller" => "Mrs","action" => "finalSubmitReport",'?' => ['date' => $reportDate]])?>" method="post" >
								<div class="form-group">
									<div class="col-sm-6">
									 <input type="hidden" class="form-control pull-right" name="reportDate" id="reportDate" value="<?php echo $reportDate;?>">
									 <div class="col-sm-6"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewReportedCalls",'?' => ['date' => $reportDate]])?>" class="btn blue-btn btn-block margin-right-35 iframe-popup-link" ><b>View Reported Calls</b></a></div>
									 <div class="col-sm-6"><button class="btn blue-btn btn-block margin-right-35 pull-right" type="submit">Final Submit</a></div>
									</div>
									<!-- /.input group -->
								</div>
							</div>
						</form>
						</div>
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20" id="workType_section_2">
							<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
							<input type="hidden" value="<?php echo $reportDate;?>" name="reportDate">
								<div class="col-md-12 mar-bottom-20">
									<?php if(count($WorkPlansD)<1){?>
									<div class="table-responsive">
										<p>No Planned Doctors on this date</p>
									</div>
									<?php }else {?>
									<div class="table-responsive">
										<h3 class="mar-top-10 mar-bottom-10">Planned Doctors</h3>
										<table id="doctors_table" class="table table-striped table-bordered table-hover">
											<thead><tr><th width=""><input type="checkbox" class="check_all" onclick="toggleCheck(this)" value="1"></th><th>Doctor Name</th><th>Class</th><th>Spe</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Gifts</th><th>Visit Time</th><th>Business</th></tr></thead>
											<tbody>
										<?php
										$work_with = '<select name="work_with[%s]"><option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option></select>';
										foreach ($WorkPlansD as $WorkPlanD)
										{
											
											$work_with_selected = str_replace("<option>".$WorkPlanD->work_with."</option>","<option selected>".$WorkPlanD->work_with."</option>",$work_with);
											$products_array = array(); $samples_array = array(); $gifts_array = array();
											if($WorkPlanD->products!="")
											$products_array = unserialize($WorkPlanD->products);
											if($WorkPlanD->samples!="")
											$samples_array = unserialize($WorkPlanD->samples);
											if($WorkPlanD->gifts!="")
											$gifts_array = unserialize($WorkPlanD->gifts);
											$detail_products =array(); $sample_products =array(); $gift_products =array();
											foreach($products as $product)
											if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
											foreach($samples as $sample)
											if (array_key_exists($sample->id, $samples_array)) $sample_products[]= $sample->name;
											foreach($gifts as $gift)
											if (array_key_exists($gift->id, $gifts_array)) $gift_products[]= $gift->name;
											?>
											<tr class="<?=(($WorkPlanD->is_reported)?"reported":"")?> <?=(($WorkPlanD->is_missed)?"missed":"")?>">
											<td>
												<input type="checkbox" class="workplan_id" name="workplan_id[<?=$WorkPlanD->id?>]" value="<?=$WorkPlanD->id?>">
											</td>
											<td><?php if($WorkPlanD->is_missed) {echo $WorkPlanD->doctor->name;}else{?><a href="#doctor_product_<?=$WorkPlanD->id?>" id="pdt_link_<?=$WorkPlanD->id?>" class="popup-modal"><?=$WorkPlanD->doctor->name?></a><?php }?></td>
											<td><?=$class[$WorkPlanD->doctor->class]?></td>
											<td><?=$WorkPlanD->doctor->speciality->code?></td>
											<td><?=$WorkPlanD->city->city_name?></td>
											<td><?=str_replace("%s",$WorkPlanD->id,$work_with_selected)?></td>
											<td><?php if(count($detail_products)>0) echo  implode(", ",$detail_products);?></td>
											<td><?php if(count($sample_products)>0) echo  implode(", ",$sample_products);?></td>
											<td><?php if(count($gift_products)>0) echo  implode(", ",$gift_products);?></td>
											<td><?=$WorkPlanD->visit_time?></td>
											<td><?=$WorkPlanD->business?></td>
											</tr>
										<?php }?>
										</tbody></table>

									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<input type="hidden" id="return" name="return" value="dailyReportField" >
													<input type="submit" id="w2SubmitSave" name="SubmitSave" class="hide" >
													<button class="common-btn blue-btn pull-left" value="w2SubmitSave" type="button" name="" id="w2ButtonSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="button" name="SubmitMissed" id="w2SubmitMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<input type="submit" id="w2SubmitRemove" name="SubmitRemove" class="hide" >
													<button class="common-btn blue-btn pull-left" value="w2SubmitRemove" type="button" name="" id="w2ButtonRemove">Remove Visit List</button>
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
													<a  href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "UnplannedDoctors",'?' => ['date' => $reportDate]])?>" class="common-btn blue-btn pull-left iframe-popup-link"><i class="fa fa-plus-circle" aria-hidden="true"></i> Unplanned Doctors</a>
												</div>
												<div class="col-sm-3">
													<a  href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportChemist",'?' => ['date' => $reportDate]])?>" class="common-btn blue-btn pull-left iframe-popup-link"><i class="fa fa-plus-circle" aria-hidden="true"></i> Chemists</a>
												</div>
												<div class="col-sm-3">
													<a  href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportStockist",'?' => ['date' => $reportDate]])?>" class="common-btn blue-btn pull-right iframe-popup-link"><i class="fa fa-plus-circle" aria-hidden="true"></i> Stockists</a>
												</div>
												<div class="col-sm-3">
													<a  href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportPgo",'?' => ['date' => $reportDate]])?>" class="common-btn blue-btn pull-right iframe-popup-link"><i class="fa fa-plus-circle" aria-hidden="true"></i> Non-Listed Doctors</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>
						
						</div>

            </div>
        </section>
		<?php if($date!=""){?>
		<!-- pop starts here -->
		<div class="mfp-hide white-popup-block small_popup" id="DoctorsMissed">
			<div class="popup-content">
				<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportMissed"])?>" id="DoctorsMissedForm">
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="2">
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss" onclick="reset_missed_form()"><span>&times;</span></button>
					<div class="hr-title"><h4>Missed Calls</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<?php
						$html = "";
						if(count($WorkPlansD))
						{
							$is_missed = '<select name="missed_reason[%s]" class="form-control required"><option value="">Select</option><option>Doctor Refused Appointment</option><option>Doctor on Leave</option><option>Doctor not in Station</option><option>Plan Changed</option><option>Meeting / CME</option><option>Others</option></select>';
							$html.='<table id="missed_doctors_table" class="table table-striped table-bordered"><thead><tr><th>Doctor Name</th><th>Reason</th><th>Date</th></tr></thead><tbody>';
							foreach ($WorkPlansD as $WorkPlanD)
							{
								$html.='<tr style="display:none" id="missed_'.$WorkPlanD->id.'"><td><input type="checkbox" class="hide" id="m_workplan_id_'.$WorkPlanD->id.'" name="m_workplan_id['.$WorkPlanD->id.']" value="'.$WorkPlanD->id.'"><h4>'.$WorkPlanD->doctor->name.'</h4></td><td>'.str_replace("%s",$WorkPlanD->id,$is_missed).'<br><label><input type="checkbox" id="m_cancel_plan_'.$WorkPlanD->id.'" name="m_cancel_plan['.$WorkPlanD->id.']" value="'.$WorkPlanD->id.'"> Check if you cannot plan this month</label></td><td><input class="form-control required" type="text" id="alt_date_'.$WorkPlanD->id.'" name="alt_date['.$WorkPlanD->id.']"></td></tr>';
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
						<?php }?>
					</div>
					<div class="row">
						<input type="hidden" id="return" name="return" value="dailyReportField" >
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" onclick="reset_missed_form()" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="SubmitMissed" name="SubmitMissed" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<a href="#DoctorsMissed" id="DoctorsMissedLink" class="hide popup-modal">Missed Doctors</a>
		
		<?php
		if(count($WorkPlansD))
		{
			foreach ($WorkPlansD as $WorkPlanD)
			{?>
			<div class="mfp-hide white-popup-block large_popup doctor_product" id="doctor_product_<?=$WorkPlanD->id?>">
				<div class="popup-content">
					<form action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>" class="doctor_product_from" method="POST" id="doctor_product_<?=$WorkPlanD->id?>Form" >
					<input type="hidden" name="reportDate" value="<?php echo $reportDate;?>">
					<input type="hidden" name="workplan_id[<?=$WorkPlanD->id?>]" value="<?=$WorkPlanD->id?>">
					<div class="popup-header">
						<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
						<div class="hr-title"><h4>Detail Reporting</h4><hr /></div>
					</div>
					<div class="popup-body">
						<div class="row">
							<div class="col-sm-12 mar-bottom-20">
								<div class="form-group col-sm-6">
									<label>Doctor Name : <?= $WorkPlanD->doctor->name?></label>
								</div>
								<div class="form-group col-sm-6">
									<label>Doctor Speciality : <?= $WorkPlanD->doctor->speciality->name?></label>
								</div>
								<div class="form-group col-sm-6">
									<label>Products To be detailed :</label>
									<select name="products[]" class="multiselect-ui form-control required" id="products" aria-invalid="true" multiple="multiple">
									<?php
									$products_array = array();
									if($WorkPlanD->products!="")
									$products_array = unserialize($WorkPlanD->products);
									foreach($products as $product){
										echo '<option value="'.$product->id.'"'. (in_array($product->id, $products_array)?"selected":"") .'>'.$product->name.'</option>';
									}
									?>
									</select>
								</div>
							</div>
							<div class="col-sm-12 mar-bottom-20">
								<?php if(count($samples)){?>
								<div class="form-group col-sm-6">
									<h4>Samples :</h4>
									<ul id="d_samples_<?=$WorkPlanD->id?>">
									<?php 
									$samples_array = array();
									if($WorkPlanD->samples!="")
									$samples_array = unserialize($WorkPlanD->samples);
									$sample_limit = (count($samples)<3)? count($samples) : 3;
									for($i=0; $i< $sample_limit; $i++){ ?>
										<li>
										<label class="col-sm-6">
											<select name="sample_id[]" id="sample_id_<?=$i?>" class="sample_id" onchange="productClick('d_samples_<?=$WorkPlanD->id?>','<?=$i?>')">
											<option value="">Select</option>
											<?php
											$bal =0; $sample_id = ""; $sample_qty = ""; $sample_bal = "";
											foreach($samples as $sample)
											{ 
												$bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;
												$exists = false;
												if(empty($sample_id) && array_key_exists($sample->id, $samples_array)) {$exists=true; $sample_id = $sample->id; $sample_qty = $samples_array[$sample->id]; $sample_bal = $bal+$samples_array[$sample->id];}
											?>
											<option value="<?=$sample->id?>" <?=($exists)?"selected":""?> data-bal="<?=($exists)?$sample_bal:$bal?>"><?=$sample->name?></option>
											<?php if($exists) unset($samples_array[$sample_id]);}?>
											</select>
										</label>
										<label class="col-sm-6"> <input type="text" name="sample_qty[]" class="sample_qty required" id="sample_qty_<?=$i?>" max="<?=$sample_bal?>" value="<?=(!empty($sample_qty))?$sample_qty:""?>" <?=(empty($sample_qty))?"disabled":""?>></label>
										</li>
									<?php }?>
									</ul>
								</div>
								<?php }?>
								<?php if(count($gifts)){?>
								<div class="form-group col-sm-6">
									<h4>Gifts :</h4>
									<ul id="d_gifts_<?=$WorkPlanD->id?>">
									<?php 
									$gifts_array = array();
									if($WorkPlanD->gifts!="")
									$gifts_array = unserialize($WorkPlanD->gifts);
									$gift_limit = (count($gifts)<3)? count($gifts) : 3;
									for($i=0; $i< $gift_limit; $i++){ ?>
										<li>
										<label class="col-sm-6">
											<select name="gift_id[]" id="gift_id_<?=$i?>" class="gift_id" onchange="giftClick('d_gifts_<?=$WorkPlanD->id?>','<?=$i?>')">
											<option value="">Select</option>
											<?php
											$bal =0; $gift_id = ""; $gift_qty = ""; $gift_bal = "";
											foreach($gifts as $gift)
											{ 
												$bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;
												$exists = false;
												if(empty($gift_id) && array_key_exists($gift->id, $gifts_array)) {$exists=true; $gift_id = $gift->id; $gift_qty = $gifts_array[$gift->id]; $gift_bal = $bal+$gifts_array[$sample->id];}
											?>
											<option value="<?=$gift->id?>" <?=($exists)?"selected":""?> data-bal="<?=($exists)?$gift_bal:$bal?>"><?=$gift->name?></option>
											<?php if($exists) unset($gifts_array[$gift_id]);}?>
											</select>
										</label>
										<label class="col-sm-6"> <input type="text" name="gift_qty[]" class="gift_qty required" id="gift_qty_<?=$i?>" max="<?=$gift_bal?>" value="<?=(!empty($gift_qty))?$gift_qty:""?>" <?=(empty($gift_qty))?"disabled":""?>></label>
										</li>
									<?php }?>
									</ul>
								</div>
								<?php }?>
								<div class="form-group col-sm-12">
									<div class="form-group col-sm-6">
										<label class="col-sm-6">Discussion</label>
										<textarea name="discussion"><?= $WorkPlanD->discussion?></textarea>
									</div>
									<div class="form-group col-sm-6">
										<div class="col-sm-6">
										<label>Visit Time</label>
										<input type="text" name="visit_time"  placeholder="HH:MM" class="time" value="<?= $WorkPlanD->visit_time?>"><br>
										</div>
										<div class="col-sm-6">
										<label>Doctor Business</label>
										<input type="text" name="business" value="<?= $WorkPlanD->business?>">
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" id="return" name="return" value="dailyReportField" >
							<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
							<div class="col-md-6 col-sm-6 col-xs-6"><button type="submit" name="SubmitSave" class="btn blue-btn btn-block">Save</button></div>
						</div>
					</div>
					</form>
					</div>
			<script>
				$("#doctor_product_<?=$WorkPlanD->id?>Form").validate({
					ignore: ":hidden"
				});
			</script>
			</div>
			<?php }
		}?>
		<?php }?>
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
		window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField"])?>?date="+moment(ev.date).format('YYYY-MM-DD'));
	});
	
	$('.popup-modal').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});
	$('.ajax-popup-link').magnificPopup({
		type: 'ajax',
		preloader: false,
		modal: true
	});
	$('.iframe-popup-link').magnificPopup({
		type: 'iframe',
		modal: true,
		iframe: {
			markup: '<div class="mfp-iframe-scaler">'+
					'<div class="close"><button type="button" class="close popup-modal-dismiss"><span>&times;</span></button></div>'+
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
					'</div>'
		  },
		callbacks: {
		  close: function(){
			window.location.replace("");
		  }}
	});
	
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		reset_form();
		$.magnificPopup.close();
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
	
	$("#w2ButtonSave,#w2ButtonRemove").click(function(){
		var target_id = $(this).val();
		if ($('input[type="checkbox"].workplan_id').is(':checked'))
		{
			$( "#"+target_id ).click();
		}
		else{
			alert("Please check a Doctor");
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
		if($('.doctor_product_from').length > 0){
			$('.doctor_product_from')[0].reset();
			$('.doctor_product_from .multiselect-ui').multiselect('refresh');
		}
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
	
	function productClick(ul,id){
		var product = $("#"+ul + " #sample_id_" + id).val();
		var bal = $("#"+ul + " #sample_id_" + id).find(':selected').data('bal');
		var exits = false; var error = false;
		if(product == "")
		error = true;
		
		$( "#"+ul + " .sample_id" ).each(function( index ) { if(index != id && product != "" && product == $( this ).val()) exits = true; })
		if(exits)
		{alert("This Sample is already selected"); $("#"+ul + " #sample_id_" + id).val(""); error = true;}
		if(error)
		{
			$("#"+ul + " #sample_qty_" + id+"-error").addClass("hide");
			$("#"+ul + " #sample_qty_" + id).val('').prop('disabled', true).attr('max', '');
			return;
		}
		
		$("#"+ul + " #sample_qty_" + id).prop('disabled', false).attr('max', bal); return;
	}
	
	function giftClick(ul,id){
		var gift = $("#"+ul + " #gift_id_" + id).val();
		var bal = $("#"+ul + " #gift_id_" + id).find(':selected').data('bal');
		var exits = false; var error = false;
		
		if(gift == "")
		error = true;
		
		$( "#"+ul + " .gift_id" ).each(function( index ) { if(index != id && gift != "" && gift == $( this ).val()) exits = true;})
		if(exits)
		{alert("This Gift is already selected"); $("#"+ul + " #gift_id_" + id).val(""); error = true;}
		if(error)
		{
			$("#"+ul + " #gift_qty_" + id+"-error").addClass("hide");
			$("#"+ul + " #gift_qty_" + id).val('').prop('disabled', true).attr('max', '');
			return;
		}
		
		$("#"+ul + " #gift_qty_" + id).prop('disabled', false).attr('max', bal); return;
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
					window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField"])?>/?date=<?php echo $reportDate;?>");			   
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
						window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField"])?>/?date=<?php echo $reportDate;?>");			   
					}
				   else
						alert(json.msg);
			   }
		   });
		}
	}

	$('.time').mask('99:99');
</script>
<?php echo $this->Html->script(['multiselect.js']); ?>        
<?= $this->fetch('script') ?>
<script type="text/javascript">
$('.multiselect-ui').multiselect({ });
</script>
