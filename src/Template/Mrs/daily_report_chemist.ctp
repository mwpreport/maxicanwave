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
                        <h3>Daily Report Chemists of <?= ($date!="")?date("Y-m-d (l)", strtotime($date)):"" ?> <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport",'?' => ['date' => $reportDate]])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h3>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="daily-report-radio-cnt">
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20" id="workType_section_2">
								<form class="" id="ChemistAddForm" method="POST" >
								<input type="hidden" name="start_date" id="start_date" value="<?php echo $reportDate;?>">
								<input type="hidden" name="work_type_id" value="">
								
								<div class="row">
									<div class="col-sm-12 mar-bottom-20">
										<div class="form-group col-sm-4">
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
										<div class="form-group col-sm-4">
											<label for="chemist_id">Select Chemists</label>
											<select name="chemist_id" class="form-control required" id="chemist_id" aria-invalid="true">
											<option value="">Select Chemists</option>
												<?php
												foreach ($chemists as $chemist)
												{?>
												<option value="<?= $chemist->id?>"><?= $chemist->name?></option>
												<?php }	?>
											</select>  
										</div>
										<div class="form-group col-sm-4">
											<label>&nbsp;</label>
											<button type="submit" id="ChemistSubmit" class="btn blue-btn btn-block">Save</button>
										</div>
									</div>
									<hr>
									<div class="col-sm-12 mar-bottom-20">
									<?php 
									$html ="";
									if(count($WorkPlansC))
									{
										$html.='<h3 class="mar-top-10 mar-bottom-10">Reported Chemists</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Chemists Name</th><th>City</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
										$i = 1;
										foreach ($WorkPlansC as $WorkPlanC)
										{
											$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanC->chemist->name.'</td><td>'.$WorkPlanC->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanC->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
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
		$.magnificPopup.close();
	});
	
	$("#ChemistAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#ChemistAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	
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


	function doSubmit(form){ // add event
	   $.ajax({
		   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAddReport"])?>',
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
