<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="ajax-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
						<?php $reportDate = ($date!="")?date("Y-m-d", strtotime($date)):"";?>
                        <h3>Daily Report Non-Listed Doctors of <?= ($date!="")?date("Y-m-d (l)", strtotime($date)):"" ?> <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport",'?' => ['date' => $reportDate]])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h3>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                
				<div id="report_section">
					<div class="col-sm-12 mar-bottom-20" id="workType_section_2">
					<form class="" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAddPgoReport"])?>" id="PGOAddForm" method="POST" >
					<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
					<input type="hidden" name="work_type_id" value="">
						<div class="row">
							<div class="col-sm-12 mar-bottom-20">
								<div class="form-group col-sm-3">
									<label for="city_id">Doctor Name</label>
									<input type="text" name="name" id="name" class="form-control required">
								</div>
								<div class="form-group col-sm-3">
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
								<div class="form-group col-sm-3">
									<label for="speciality_id">Speciality</label>
									<select name="speciality_id" class="form-control required" id="speciality_id" aria-invalid="true">
										<option value="">Select</option>
										<?php
										foreach ($specialities as $speciality)
										{?>
										<option value="<?= $speciality['id']?>" ><?= $speciality['name']?></option>
										<?php }	?>
									</select>  
								</div>
								<div class="form-group col-sm-3">
									<label for="work_with">Work With</label>
									<select name="work_with" class="form-control required" id="work_with" aria-invalid="true">
										<option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option> 
									</select>
								</div>
							</div>
								<div class="form-group col-sm-6 popup-content">
									<label>Products To be detailed :</label>
									<select name="products[]" class="multiselect-ui form-control required" id="products" aria-invalid="true" multiple="multiple">
									<?php 
									foreach($products as $product)
									echo '<option value="'.$product->id.'">'.$product->name.'</option>';
									?>
									</select>
								</div>
							<div class="col-sm-12 mar-bottom-20">
								<?php if(count($samples)){?>
								<div class="form-group col-sm-6">
									<h4>Samples :</h4>
									<ul id="pd_samples">
									<?php 
									$sample_limit = (count($samples)<3)? count($samples) : 3;
									for($i=0; $i< $sample_limit; $i++){ ?>
										<li>
										<label class="col-sm-6">
											<select name="sample_id[]" id="sample_id_<?=$i?>" class="sample_id" onchange="productClick('pd_samples','<?=$i?>')">
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
									<ul id="pd_gifts">
									<?php
									$gift_limit = (count($gifts)<3)? count($gifts) : 3;
									for($i=0; $i< $gift_limit; $i++){ ?>
										<li>
										<label class="col-sm-6">
											<select name="gift_id[]" id="gift_id_<?=$i?>" class="gift_id" onchange="giftClick('pd_gifts','<?=$i?>')">
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
										<input type="text" name="visit_time"  placeholder="HH:MM" class="time" value=""><br>
										</div>
										<div class="col-sm-6">
										<label>Doctor Business</label>
										<input type="text" name="business" value="">
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-6 pull-right"> <button type="submit" id="PGOSubmit" class="btn blue-btn btn-block">Save</button></div>
							</div>
							<hr>
							<div class="col-sm-12 mar-bottom-20">
							<?php 
							$html ="";
							if(count($WorkPlansPD))
							{
								$html.='<h3 class="mar-top-10 mar-bottom-10">Reported Non-Listed Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Spec</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Gifts</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
								$i = 1;
								foreach ($WorkPlansPD as $WorkPlanPD)
								{
									
									$products_array = array(); $samples_array = array(); $gifts_array = array();
									if($WorkPlanPD->products!="")
									$products_array = unserialize($WorkPlanPD->products);
									if($WorkPlanPD->samples!="")
									$samples_array = unserialize($WorkPlanPD->samples);
									if($WorkPlanPD->gifts!="")
									$gifts_array = unserialize($WorkPlanPD->gifts);
									$detail_products =array(); $sample_products =array(); $gift_products =array();
									foreach($products as $product)
									if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
									foreach($samples as $sample)
									if (array_key_exists($sample->id, $samples_array)) $sample_products[]= $sample->name;
									foreach($gifts as $gift)
									if (array_key_exists($gift->id, $gifts_array)) $gift_products[]= $gift->name;
									$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanPD->pg_other->name.'</td><td>'.$WorkPlanPD->pg_other->speciality->code.'</td><td>'.$WorkPlanPD->city->city_name.'</td><td>'.$WorkPlanPD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.((count($gift_products)>0)?implode(", ",$gift_products):"").'</td><td>'.$WorkPlanPD->visit_time.'</td><td>'.$WorkPlanPD->business.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanPD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
								$i++;
								}
								$html.='</tbody></table>';
							}
							if($html!="") echo $html;
							?>
							</div>
						</div>
					</form>
					</div>
				</div>
						

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
	
	  
	function reset_form(){
		//$('#StockistAddForm, #ChemistAddForm')[0].reset();
		$('#PGOAddForm')[0].reset();
		$('#PGOAddForm .multiselect-ui').multiselect('refresh');
		$('#PGOAddForm .sample_qty, #PGOAddForm .gift_qty').prop('disabled', true).attr('max', '');

	}
	
	$("#PGOAddForm").validate({
		ignore: ":hidden"
	});
	
		
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
		   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAddPgoReport"])?>',
		   dataType: "json",
		   data: $(form).serialize()+"&action=add",
		   type: "POST",
		   success: function(json) {
			   if(json.status == 1)
			   {	
					window.location.replace("");			   
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
						window.location.replace("");			   
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
