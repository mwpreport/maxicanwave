<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
				<?php if(1==1){?>
				<form id="finalSubmitFrom" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "finalSaveDailyReport"])?>" method="post">
                <div class="col-md-12">
                    <div class="hr-title">
						<?php $reportDate = ($date!="")?date("Y-m-d", strtotime($date)):"";?>
                        <h2>Final Submit for Daily Report of <?= ($date!="")?date("Y-m-d (l)", strtotime($date)):"" ?> <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField",'?' => ['date' => $reportDate]])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="daily-report-radio-cnt">
					<div class="table-responsive" id="report_section">
						<?php
						$html = "";
			if(count($WorkPlansD))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">Field Work</h3><table id="doctors_table" class="doctors_table table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Class</th><th>Spec</th><th>City</th><th>Work With</th><th>Visit Time</th><th>Business</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansD as $WorkPlanD)
				{
					
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

					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanD->id.']" value="'.$WorkPlanD->id.'"></td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$class[$WorkPlanD->doctor->class].'</td><td>'.$WorkPlanD->doctor->speciality->code.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>'.$WorkPlanD->work_with.'</td><td><input class="required time" name="visit_time['.$WorkPlanD->id.']" value="'.$WorkPlanD->visit_time.'"></td><td><input class="required" name="business['.$WorkPlanD->id.']" value="'.$WorkPlanD->business.'"></td></tr>';
				$i++;
				}
				
			}
			
			if(count($WorkPlansUD))
			{
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
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanUD->id.']" value="'.$WorkPlanUD->id.'"></td><td>'.$WorkPlanUD->doctor->name.'</td><td>'.$class[$WorkPlanUD->doctor->class].'</td><td>'.$WorkPlanUD->doctor->speciality->code.'</td><td>'.$WorkPlanUD->city->city_name.'</td><td>'.$WorkPlanUD->work_with.'</td><td><input class="required time" name="visit_time['.$WorkPlanUD->id.']" value="'.$WorkPlanUD->visit_time.'"></td><td><input class="required" name="business['.$WorkPlanUD->id.']" value="'.$WorkPlanUD->business.'"></td></tr>';	
				$i++;
				}
			}

			if(count($WorkPlansPD))
			{
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
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanPD->id.']" value="'.$WorkPlanPD->id.'"></td><td>'.$WorkPlanPD->pg_other->name.'</td><td>-</td><td>'.$WorkPlanPD->pg_other->speciality->code.'</td><td>'.$WorkPlanPD->city->city_name.'</td><td>'.$WorkPlanPD->work_with.'</td><td><input class="required time" name="visit_time['.$WorkPlanPD->id.']" value="'.$WorkPlanPD->visit_time.'"></td><td><input class="required" name="business['.$WorkPlanPD->id.']" value="'.$WorkPlanPD->business.'"></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}

			if(count($WorkPlansL))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10 hide">Leave</h3><table id="plans_table" class="table table-striped table-bordered table-hover hide"><thead><tr><th width="">S.No</th><th>Type of Leave</th><th>More details</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansL as $WorkPlanL)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanL->id.']" value="'.$WorkPlanL->id.'"></td><td>'.$WorkPlanL->leave_type->name.'</td><td>'.$WorkPlanL->plan_details.'</td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}

			if(count($WorkPlans))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10 hide">Other Plans</h3><table id="plans_table" class="table table-striped table-bordered table-hover hide"><thead><tr><th width="">S.No</th><th>Work Type</th><th>City</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlans as $WorkPlan)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlan->id.']" value="'.$WorkPlan->id.'"></td><td>'.$WorkPlan->work_type->name.'</td><td>'.$WorkPlan->city->city_name.'</td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}

			if(count($WorkPlansC))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10 hide">Chemists</h3><table id="plans_table" class="table table-striped table-bordered table-hover hide"><thead><tr><th width="">S.No</th><th>Stockists Name</th><th>City</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansC as $WorkPlanC)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanC->id.']" value="'.$WorkPlanC->id.'"></td><td>'.$WorkPlanC->chemist->name.'</td><td>'.$WorkPlanC->city->city_name.'</td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
			
			if(count($WorkPlansS))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10 hide">Stockists</h3><table id="plans_table" class="table table-striped table-bordered table-hover hide"><thead><tr><th width="">S.No</th><th>Stockists Name</th><th>City</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansS as $WorkPlanS)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanS->id.']" value="'.$WorkPlanS->id.'"></td><td>'.$WorkPlanS->stockist->name.'</td><td>'.$WorkPlanS->city->city_name.'</td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
						
			if($html == ""){$html.="<p>No reports on this date</p>";}
		
			echo $html;
						?>
					</div>
                </div>
				
				<div class="form-group">
					<div class="col-md-offset-4 col-md-4 col-sm-offset-0 col-sm-12 col-xs-12">
						<input type="hidden" name="date" value="<?= $reportDate?>">
						<button type="submit" name="submitPlan" class="common-btn blue-btn">Submit</button>
					</div>
				</div>
				</form>
				<?php }?>
            </div>
        </section>


    </div>
    <!-- /.content -->
</div>
<script>
	$("#finalSubmitFrom").validate({
		ignore: ":hidden"
		
	});

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
						window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewDailyReport"])?>/?date=<?php echo $reportDate;?>");			   
					}
				   else
						alert(json.msg);
			   }
		   });
		}
	}
	
	$('.time').mask('99:99');
</script>