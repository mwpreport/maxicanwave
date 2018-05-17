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
                        <h2>Daily Report of <?= ($date!="")?date("Y-m-d (l)", strtotime($date)):"" ?> <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField",'?' => ['date' => $reportDate]])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
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
										 <div class="col-sm-6"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewDailyReport",'?' => ['date' => $reportDate]])?>" class="btn blue-btn btn-block margin-right-35" target="blank"><b>View Reported Calls</b></a></div>
										 <div class="col-sm-6"><button class="btn blue-btn btn-block margin-right-35 pull-right" type="submit">Final Submit</a></div>
									</div>
									<!-- /.input group -->
								</div>
							</form>
							</div>
						</div>
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20" id="workType_section_2">
							<h3 class="mar-top-10 mar-bottom-10">Add Un-Planned Doctors</h3>
								<div class="row">
									<div class="col-sm-12 mar-bottom-20">
										<form class="" id="UnplannedAddFormSelect" method="POST">
										<input type="hidden" name="start_date" id="start_date" value="<?php echo $reportDate;?>">
										<div class="form-group col-sm-3">
											<label for="city_id_select">City</label>
											<select name="city_id_select" onchange="loadDoctors(this.form.id)" class="form-control required" id="city_id_select" aria-invalid="true">
												<option value="">Select</option>
												<?php
												foreach ($cities as $citiy)
												{?>
												<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
												<?php }	?>
											</select>  
										</div>
										<div class="form-group col-sm-3">
											<label for="doctor_id_select">Select Doctor</label>
											<select name="doctor_id_select" class="form-control required" id="doctor_id_select" aria-invalid="true">
											<option value="">Select Doctors</option>
												<?php
												if(count($doctorsRelation)>0)
												foreach ($doctorsRelation as $doctor)
												{?>
												<option value="<?= $doctor['doctor_id']?>" data-spec="<?= $doctor->doctor->speciality->name?>"><?= $doctor->doctor->name?></option>
												<?php }	?>
											</select>  
										</div>
										<div class="form-group col-sm-3">
											<label for="work_with_select">Work With</label>
											<select name="work_with_select" class="form-control required" id="work_with_select" aria-invalid="true">
											<option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option> 
											</select>
										</div>
										<div class="form-group col-sm-3">
											<label>&nbsp;</label>
											<button type="submit" class="btn blue-btn btn-block">Details</button>
										</div>
										</form>
									</div>
									<!--<a href="#UnplannedAdd" id="UnplannedAddLink" class="popup-modal btn blue-btn btn-block">&nbsp;</a>-->

									<div class="mfp-hide white-popup-block large_popup" id="UnplannedAdd">
										<div class="popup-content">
											<div class="popup-header">
												<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
												<div class="hr-title"><h4>Detail Reporting</h4><hr /></div>
											</div>
											<form class="" id="UnplannedAddForm" method="POST" >
											<input type="hidden" name="start_date" id="start_date" value="<?php echo $reportDate;?>">
											<input type="hidden" name="work_type_id" id="work_type_id" value="2">
											<input type="hidden" name="city_id" id="city_id" value="<?=$userCity?>">
											<input type="hidden" name="doctor_id" id="doctor_id" value="">
											<input type="hidden" name="work_with" id="work_with" value="Alone">
											<div class="popup-body">
												<div class="row">
													<div class="col-sm-12 mar-bottom-20">
														<div class="form-group col-sm-6">
															<label>Doctor Name : <span id="doctor_name"></span></label>
														</div>
														<div class="form-group col-sm-6">
															<label>Doctor Speciality : <span id="doctor_spec"></span></label>
														</div>
														<div class="form-group col-sm-6">
															<label>Products To be detailed :</label>
															<select name="products[]" class="multiselect-ui form-control required" id="products" aria-invalid="true" multiple="multiple">
															<?php
															foreach($products as $product)
															echo '<option value="'.$product->id.'">'.$product->name.'</option>';
															?>
															</select>
														</div>
													</div>
													<div class="col-sm-12 mar-bottom-20">
														<?php if(count($samples)){?>
														<div class="form-group col-sm-6">
															<h4>Samples :</h4>
															<ul id="ud_samples">
															<?php 
															$sample_limit = (count($samples)<3)? count($samples) : 3;
															for($i=0; $i< $sample_limit; $i++){ ?>
																<li>
																<label class="col-sm-6">
																	<select name="sample_id[]" id="sample_id_<?=$i?>" class="sample_id" onchange="productClick('ud_samples','<?=$i?>')">
																	<option value="">Select</option>
																	<?php
																	$bal =0;
																	foreach($samples as $sample)
																	{ $bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;?>
																	<option value="<?=$sample->id?>" data-bal="<?=$bal?>"><?=$sample->name?></option>
																	<?php }?>
																	</select>
																</label>
																<label class="col-sm-6"> <input type="text" name="sample_qty[]" max="" class="sample_qty required" id="sample_qty_<?=$i?>" value="" disabled></label>
																</li>
															<?php }?>
															</ul>
														</div>
														<?php }?>
														<?php if(count($gifts)){?>
														<div class="form-group col-sm-6">
															<h4>Gifts :</h4>
															<ul id="ud_gifts">
															<?php
															$gift_limit = (count($gifts)<3)? count($gifts) : 3;
															for($i=0; $i< $gift_limit; $i++){ ?>
																<li>
																<label class="col-sm-6">
																	<select name="gift_id[]" id="gift_id_<?=$i?>" class="gift_id" onchange="giftClick('ud_gifts','<?=$i?>')">
																	<option value="">Select</option>
																	<?php
																	$bal =0;
																	foreach($gifts as $gift)
																	{ $bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;?>
																	<option value="<?=$gift->id?>" data-bal="<?=$bal?>"><?=$gift->name?></option>
																	<?php }?>
																	</select>
																</label>
																<label class="col-sm-6"> <input type="text" name="gift_qty[]" max="" class="gift_qty required" id="gift_qty_<?=$i?>" value="" disabled></label>
																</li>
															<?php }?>
															</ul>
														</div>
														<?php }?>
														<div class="form-group col-sm-12">
															<div class="form-group col-sm-6">
																<label class="col-sm-6">Discussion</label>
																<textarea name="discussion"></textarea>
															</div>
															<div class="form-group col-sm-6">
																<div class="col-sm-6">
																<label>Visit Time</label>
																<input type="text" name="visit_time" class="time" value=""><br>
																</div>
																<div class="col-sm-6">
																<label>Doctor Business</label>
																<input type="text" name="business" value="">
																</div>
															</div>
														</div>
													</div>
													<input type="hidden" id="return" name="return" value="dailyReportField" >
													<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
													<div class="col-md-6 col-sm-6 col-xs-6"><button type="submit" id="UnplannedSubmit" class="btn blue-btn btn-block">Save</button></div>
												</div>
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="col-sm-12 mar-bottom-20">
								<div class="col-md-12 mar-bottom-20">
									<?php if(count($WorkPlansUD)<1){?>
									<div class="table-responsive">
										<p>No Unplanned Doctors on this date</p>
									</div>
									<?php }else {?>
									<div class="table-responsive">
										<?php 
											$html ="";
											if(count($WorkPlansUD))
											{
												$html.='<h3 class="mar-top-10 mar-bottom-10">Un-Planned Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Class</th><th>Spec</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Gifts</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
												$i = 1;
												foreach ($WorkPlansUD as $WorkPlanUD)
												{
													$products_array = array(); $samples_array = array(); $gifts_array = array();
													if($WorkPlanUD->products!="")
													$products_array = unserialize($WorkPlanUD->products);
													if($WorkPlanUD->samples!="")
													$samples_array = unserialize($WorkPlanUD->samples);
													if($WorkPlanUD->gifts!="")
													$gifts_array = unserialize($WorkPlanUD->gifts);
													$detail_products =array(); $sample_products =array(); $gift_products =array();
													foreach($products as $product)
													if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
													foreach($samples as $sample)
													if (array_key_exists($sample->id, $samples_array)) $sample_products[]= $sample->name;
													foreach($gifts as $gift)
													if (array_key_exists($gift->id, $gifts_array)) $gift_products[]= $gift->name;
													$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanUD->doctor->name.'</td><td>'.$class[$WorkPlanUD->doctor->class].'</td><td>'.$WorkPlanUD->doctor->speciality->code.'</td><td>'.$WorkPlanUD->city->city_name.'</td><td>'.$WorkPlanUD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.((count($gift_products)>0)?implode(", ",$gift_products):"").'</td><td>'.$WorkPlanUD->visit_time.'</td><td>'.$WorkPlanUD->business.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanUD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
												$i++;
												}
												$html.='</tbody></table>';
											}
											if($html!="") echo $html;
										?>

									</div>
									<div class="clearfix"></div>
									<?php }?>
								</div>
							
							</form>
							</div>
						</div>
						
						</div>

            </div>
        </section>
		<!-- pop starts here -->
		<?php
		if(count($WorkPlansUD))
		{
			foreach ($WorkPlansUD as $WorkPlanUD)
			{?>
			<div class="mfp-hide white-popup-block large_popup doctor_product" id="doctor_product_<?=$WorkPlanUD->id?>">
				<div class="popup-content">
					<form class="" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>" class="ProductForm" method="POST" id="doctor_product_<?=$WorkPlanUD->id?>Form" >
					<input type="hidden" name="reportDate" value="<?php echo $reportDate;?>">
					<input type="hidden" name="workplan_id[<?=$WorkPlanUD->id?>]" value="<?=$WorkPlanUD->id?>">
					<div class="popup-header">
						<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
						<div class="hr-title"><h4>Detail Reporting</h4><hr /></div>
					</div>
					<div class="popup-body">
						<div class="row">
							<div class="col-sm-12 mar-bottom-20">
								<div class="form-group col-sm-6">
									<label>Doctor Name : <?= $WorkPlanUD->doctor->name?></label>
								</div>
								<div class="form-group col-sm-6">
									<label>Doctor Speciality : <?= $WorkPlanUD->doctor->speciality->name?></label>
								</div>
								<div class="form-group col-sm-6">
									<label>Products To be detailed :</label>
									<select name="products[]" class="multiselect-ui form-control required" id="products" aria-invalid="true" multiple="multiple">
									<?php
									$products_array = array();
									if($WorkPlanUD->products!="")
									$products_array = unserialize($WorkPlanUD->products);
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
									<ul id="ud_samples_<?=$WorkPlanUD->id?>">
									<?php 
									$samples_array = array();
									if($WorkPlanUD->samples!="")
									$samples_array = unserialize($WorkPlanUD->samples);
									$sample_limit = (count($samples)<3)? count($samples) : 3;
									for($i=0; $i< $sample_limit; $i++){ ?>
										<li>
										<label class="col-sm-6">
											<select name="sample_id[]" id="sample_id_<?=$i?>" class="sample_id" onchange="productClick('ud_samples_<?=$WorkPlanUD->id?>','<?=$i?>')">
											<option value="">Select</option>
											<?php
											$bal =0;
											foreach($samples as $sample)
											{ $bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;?>
											<option value="<?=$sample->id?>" <?=(array_key_exists($sample->id, $samples_array))?"selected":""?> data-bal="<?=(array_key_exists($sample->id, $samples_array))?($bal+$samples_array[$sample->id]):$bal?>"><?=$sample->name?></option>
											<?php }?>
											</select>
										</label>
										<label class="col-sm-6"> <input type="text" name="sample_qty[]" class="required" id="sample_qty_<?=$i?>" max="" value="<?=(array_key_exists($sample->id, $samples_array))?$samples_array[$sample->id]:""?>" <?=(array_key_exists($sample->id, $samples_array))?"disabled":""?>></label>
										</li>
									<?php }?>
									</ul>
								</div>
								<?php }?>
								<?php if(count($gifts)){?>
								<div class="form-group col-sm-6">
									<h4>Gifts :</h4>
									<ul id="ud_gifts_<?=$WorkPlanUD->id?>">
									<?php 
									$gifts_array = array();
									if($WorkPlanUD->gifts!="")
									$gifts_array = unserialize($WorkPlanUD->gifts);
									$gift_limit = (count($gifts)<3)? count($gifts) : 3;
									for($i=0; $i< $gift_limit; $i++){ ?>
										<li>
										<label class="col-sm-6">
											<select name="gift_id[]" id="gift_id_<?=$i?>" class="gift_id" onchange="giftClick('ud_gifts_<?=$WorkPlanUD->id?>','<?=$i?>')">
											<option value="">Select</option>
											<?php
											$bal =0;
											foreach($gifts as $gift)
											{ $bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;?>
											<option value="<?=$gift->id?>" <?=(array_key_exists($gift->id, $gifts_array))?"selected":""?> data-bal="<?=(array_key_exists($gift->id, $gifts_array))?($bal+$gifts_array[$gift->id]):$bal?>"><?=$gift->name?></option>
											<?php }?>
											</select>
										</label>
										<label class="col-sm-6"> <input type="text" name="gift_qty[]" class="required" id="gift_qty_<?=$i?>" max="" value="<?=(array_key_exists($gift->id, $gifts_array))?$gifts_array[$gift->id]:""?>" <?=(array_key_exists($gift->id, $gifts_array))?"disabled":""?>></label>
										</li>
									<?php }?>
									</ul>
								</div>
								<?php }?>
								<div class="form-group col-sm-12">
									<div class="form-group col-sm-6">
										<label class="col-sm-6">Discussion</label>
										<textarea name="discussion"><?= $WorkPlanUD->discussion?></textarea>
									</div>
									<div class="form-group col-sm-6">
										<div class="col-sm-6">
										<label>Visit Time</label>
										<input type="text" name="visit_time" class="time" value="<?= $WorkPlanUD->visit_time?>"><br>
										</div>
										<div class="col-sm-6">
										<label>Doctor Business</label>
										<input type="text" name="business" value="<?= $WorkPlanUD->business?>">
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
				$("#doctor_product_<?=$WorkPlanUD->id?>Form").validate({
					ignore: ":hidden"
				});
			</script>
			</div>
			<?php }
		}?>
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
	
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		reset_form();
		$.magnificPopup.close();
	});
	
	$("#UnplannedAddFormSelect").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			//$('#UnplannedAddLink').click();
			if ($('#UnplannedAdd').length) {
				$.magnificPopup.open({
					items: {
						src: '#UnplannedAdd' 
					},
					type: 'inline'
				});
			}
			return false; // required to block normal submit since you used ajax
		}
	});
	$("#UnplannedAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#UnplannedAddForm")
			return false; // required to block normal submit since you used ajax
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
  
	$("#doctor_id_select").change(function(e){
		var val = $("#doctor_id_select").val();
		var name = $("#doctor_id_select option:selected").text();
		var spec = $('#doctor_id_select option:selected').attr('data-spec');
		$("#doctor_id").val(val);
		$("#doctor_name").html(name);
		$("#doctor_spec").html(spec);
	});
	$("#city_id_select").change(function(e){
		var val = $("#city_id_select").val();
		$("#city_id").val(val);
	});
	$("#work_with_select").change(function(e){
		var val = $("#work_with_select").val();
		$("#work_with").val(val);
	});
	
	function reset_form(){
		$('#UnplannedAddForm')[0].reset();
		$('#UnplannedAddForm .multiselect-ui').multiselect('refresh');
		$('#UnplannedAddForm .sample_qty, #UnplannedAddForm .gift_qty').prop('disabled', true).attr('max', '');
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
	
	function loadDoctors(id){
		var city_id = $('#'+id+' #city_id_select').val();
		var start_date = $('#'+id+' #start_date').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetDoctors"])?>',
			   data: "city_id="+city_id+"&start_date="+start_date,
			   type: "POST",
			   success: function(json) {
				   $('#doctor_id_select').html(json);
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
