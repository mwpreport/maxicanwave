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
                        <h2>Daily Report of <?= ($date!="")?date("Y-m-d (l)", strtotime($date)):"" ?></h2>
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
							<form class="" id="UnplannedAddForm" method="POST" >
							<input type="hidden" name="start_date" id="start_date" value="<?php echo $reportDate;?>">
							<input type="hidden" name="work_type_id" value="2">
								<div class="row">
									<div class="col-sm-12 mar-bottom-20">
										<div class="form-group col-sm-4">
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
										<div class="form-group col-sm-4">
											<label for="doctor_id">Select Doctor</label>
											<select name="doctor_id" class="form-control required" id="doctor_id" aria-invalid="true">
											<option value="">Select Doctors</option>
												<?php
												if(count($doctorsRelation)>0)
												foreach ($doctorsRelation as $doctor)
												{?>
												<option value="<?= $doctor['doctor_id']?>" data-spec="<?= $doctor->doctor->speciality->name?>"><?= $doctor->doctor->name?></option>
												<?php }	?>
											</select>  
										</div>
										<div class="form-group col-sm-4">
											<label for="work_with">Work With</label>
											<select name="work_with" class="form-control required" id="work_with" aria-invalid="true">
											<option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option> 
											</select>
										</div>
									</div>
									<div class="col-sm-12 mar-bottom-20">
									<a href="#UnplannedAdd" class="popup-modal btn blue-btn btn-block" onclick="$('#unplan_details').removeClass('hide')">Details</a>
									</div>
									<div class="mfp-hide white-popup-block large_popup" id="UnplannedAdd">
										<div class="popup-header">
											<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
											<div class="hr-title"><h4>Detail Reporting</h4><hr /></div>
										</div>
										<div class="popup-content">
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
															<ul>
															<?php
															foreach($samples as $sample)
															{ $bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;
																?>
																<li>
																<label class="col-sm-6"> <input type="checkbox" name="sample_id[]" id="sample_id_<?=$sample->id?>" value="<?=$sample->id?>" onclick="productClick(this)"> <?= $sample->name?></label>
																<label class="col-sm-6"> <input type="text" name="sample_qty[<?=$sample->id?>]" max="<?=$bal?>" class="required" id="sample_qty_<?=$sample->id?>" value="" disabled></label>
																</li>
															<?php $bal =0;}?>
															</ul>
														</div>
														<?php }?>
														<?php if(count($gifts)){?>
														<div class="form-group col-sm-6">
															<h4>Gifts :</h4>
															<ul>
															<?php
															$gift_array = array();
															foreach($gifts as $gift)
															{  $bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;
															?>
																<li>
																<label class="col-sm-6"> <input type="checkbox" name="gift_id[]" id="gift_id_<?=$gift->id?>" value="<?=$gift->id?>" onclick="giftClick(this)"> <?= $gift->name?></label>
																<label class="col-sm-6"> <input type="text" name="gift_qty[<?=$gift->id?>]" max="<?=$bal?>" class="required" id="gift_qty_<?=$gift->id?>" value="" disabled></label>
																</li>
															<?php $bal =0;}?>
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
																<input type="text" name="visit_time" value=""><br>
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
													<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="UnplannedSubmit" class="btn blue-btn btn-block">Save</button></div>
												</div>
											</div>
										</div>
									</div>
		

								</div>
							</form>

							</div>
							<hr>
							<div class="col-sm-12 mar-bottom-20" id="workType_section_2">
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
									<ul>
									<?php
									$samples_array = array();
									if($WorkPlanUD->samples!="")
									$samples_array = unserialize($WorkPlanUD->samples);
									foreach($samples as $sample)
									{ $bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;
									?>
										<li>
											<?php
											if (array_key_exists($sample->id, $samples_array)){
											$sample_product_id[$sample->id]= $sample->name;
											?>
											<label class="col-sm-6"> <input type="checkbox"  name="sample_id[]" class="samples_<?=$WorkPlanUD->id?>" id="sample_id_<?=$sample->id?>" value="<?=$sample->id?>" onclick="productClick(this)" checked> <?= $sample->name?></label>
											<label class="col-sm-6"> <input type="text" name="sample_qty[<?=$sample->id?>]" max="<?=($bal+$samples_array[$sample->id])?>" class="qty_txt required" id="sample_qty_<?=$sample->id?>" value="<?=$samples_array[$sample->id]?>"></label>
											<?php }else { ?>
											<label class="col-sm-6"> <input type="checkbox"  name="sample_id[]" class="samples_<?=$WorkPlanUD->id?>" id="sample_id_<?=$sample->id?>" value="<?=$sample->id?>" onclick="productClick(this)"> <?= $sample->name?></label>
											<label class="col-sm-6"> <input type="text" name="sample_qty[<?=$sample->id?>]" max="<?=$bal?>" class="qty_txt required" id="sample_qty_<?=$sample->id?>" value="" disabled></label>
											<?php }?>
										</li>
									<?php $bal =0;}?>
									</ul>
								</div>
								<?php }?>
								<?php if(count($gifts)){?>
								<div class="form-group col-sm-6">
									<h4>Gifts :</h4>
									<ul>
									<?php
									$gifts_array = array();
									if($WorkPlanUD->gifts!="")
									$gifts_array = unserialize($WorkPlanUD->gifts);
									foreach($gifts as $gift)
									{ $bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;
									?>
										<li>
											<?php
											if (array_key_exists($gift->id, $gifts_array)){
											$sample_product_id[$gift->id]= $gift->name;
											?>
											<label class="col-sm-6"> <input type="checkbox"  name="gift_id[]" class="gifts_<?=$WorkPlanUD->id?>" id="gift_id<?=$gift->id?>" value="<?=$gift->id?>" onclick="giftClick(this)" checked> <?= $gift->name?></label>
											<label class="col-sm-6"> <input type="text" name="gift_qty[<?=$gift->id?>]" max="<?=($bal+$gifts_array[$gift->id])?>" class="qty_txt required" id="gift_qty_<?=$gift->id?>" value="<?=$gifts_array[$gift->id]?>"></label>
											<?php }else { ?>
											<label class="col-sm-6"> <input type="checkbox"  name="gift_id[]" class="gifts_<?=$WorkPlanUD->id?>" id="gift_id<?=$gift->id?>" value="<?=$gift->id?>" onclick="giftClick(this)"> <?= $gift->name?></label>
											<label class="col-sm-6"> <input type="text" name="gift_qty[<?=$gift->id?>]" max="<?=$bal?>" class="qty_txt required" id="gift_qty_<?=$gift->id?>" value="" disabled></label>
											<?php $bal =0;}?>
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
										<input type="text" name="visit_time" value="<?= $WorkPlanUD->visit_time?>"><br>
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
  
	$("#doctor_id").change(function(e){
		var name = $("#doctor_id option:selected").text();
		var spec = $('#doctor_id option:selected').attr('data-spec');
		//add a new contact
		$("#doctor_name").html(name);
		$("#doctor_spec").html(spec);
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
		$(elem).closest("form").find('#sample_qty_'+id).prop('disabled', false);
		else
		{
		$(elem).closest("form").find('#sample_qty_'+id+"-error").addClass("hide");
		$(elem).closest("form").find('#sample_qty_'+id).val('');
		$(elem).closest("form").find('#sample_qty_'+id).prop('disabled', true);
		}
	}
	
	function giftClick(elem){
		var id=$(elem).val();
		if($(elem).prop("checked") == true)
		$(elem).closest("form").find('#gift_qty_'+id).prop('disabled', false);
		else
		{
		$(elem).closest("form").find('#gift_qty_'+id+"-error").addClass("hide");
		$(elem).closest("form").find('#gift_qty_'+id).val('');
		$(elem).closest("form").find('#gift_qty_'+id).prop('disabled', true);
		}
	}
	
	function productShow(id){
		var str = ""; var i=0;
		$('input[type="checkbox"].samples_'+id+':checked').each(function () {
		if(i>0) str += ", ";
		str += $(this).val();
		i++;
		});
		if(str != "")
		{$("#pdt_link_"+id).html(str);$("#pdt_val_"+id).val($("#samples_"+id).val());}
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


</script>
<?php echo $this->Html->script(['multiselect.js']); ?>        
<?= $this->fetch('script') ?>
<script type="text/javascript">
$('.multiselect-ui').multiselect({ });
</script>
