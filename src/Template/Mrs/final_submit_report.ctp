<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
				<?php if(){?>
				<form action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "finalSaveDailyReport"])?>" method="post">
                <div class="col-md-12">
                    <div class="hr-title">
						<?php $reportDate = ""; if($date!="") $reportDate = date("Y-m-d", strtotime($date));?>
                        <h2>Final Submit for Daily Report of <?= $reportDate?></h2>
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
				$html.='<h3 class="mar-top-10 mar-bottom-10">Planned Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansD as $WorkPlanD)
				{
					
					$products_array = array();
					if($WorkPlanD->products!="")
					$products_array = unserialize($WorkPlanD->products);
					$sample_products =array();
					foreach($products as $product)
					if (array_key_exists($product->id, $products_array)) $sample_products[]= $product->name;
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanD->id.']" value="'.$WorkPlanD->id.'"></td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>'.$WorkPlanD->work_with.'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td><input name="visit_time['.$WorkPlanD->id.']" value="'.$WorkPlanD->visit_time.'"></td><td><input name="business['.$WorkPlanD->id.']" value="'.$WorkPlanD->business.'"></td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
			
			if(count($WorkPlansUD))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">Un-Planned Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansUD as $WorkPlanUD)
				{
					
					$products_array = array();
					if($WorkPlanUD->products!="")
					$products_array = unserialize($WorkPlanUD->products);
					$sample_products =array();
					foreach($products as $product)
					if (array_key_exists($product->id, $products_array)) $sample_products[]= $product->name;
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanUD->id.']" value="'.$WorkPlanUD->id.'"></td><td>'.$WorkPlanUD->doctor->name.'</td><td>'.$WorkPlanUD->city->city_name.'</td><td>'.$WorkPlanUD->work_with.'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td><input name="visit_time['.$WorkPlanUD->id.']" value="'.$WorkPlanUD->visit_time.'"></td><td><input name="business['.$WorkPlanUD->id.']" value="'.$WorkPlanUD->business.'"></td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanUD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}

			if(count($WorkPlansL))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">Leave</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Type of Leave</th><th>More details</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansL as $WorkPlanL)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanL->id.']" value="'.$WorkPlanL->id.'"></td><td>'.$WorkPlanL->leave_type->name.'</td><td>'.$WorkPlanL->plan_details.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanL->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}

			if(count($WorkPlans))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">Other Plans</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Work Type</th><th>City</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlans as $WorkPlan)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlan->id.']" value="'.$WorkPlan->id.'"></td><td>'.$WorkPlan->work_type->name.'</td><td>'.$WorkPlan->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlan->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}

			if(count($WorkPlansC))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">Chemists</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Stockists Name</th><th>City</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansC as $WorkPlanC)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanC->id.']" value="'.$WorkPlanC->id.'"></td><td>'.$WorkPlanC->chemist->name.'</td><td>'.$WorkPlanC->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanC->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
			
			if(count($WorkPlansS))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">Stockists</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Stockists Name</th><th>City</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansS as $WorkPlanS)
				{
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanS->id.']" value="'.$WorkPlanS->id.'"></td><td>'.$WorkPlanS->stockist->name.'</td><td>'.$WorkPlanS->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanS->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
						
			if(count($WorkPlansPD))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">PG & Others</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansPD as $WorkPlanPD)
				{
					
					$products_array = array();
					if($WorkPlanPD->products!="")
					$products_array = unserialize($WorkPlanPD->products);
					$sample_products =array();
					foreach($products as $product)
					if (array_key_exists($product->id, $products_array)) $sample_products[]= $product->name;
					$html.='<tr><td>'.$i.'<input type="hidden" name="workplan_id['.$WorkPlanPD->id.']" value="'.$WorkPlanPD->id.'"></td><td>'.$WorkPlanPD->doctor->name.'</td><td>'.$WorkPlanPD->city->city_name.'</td><td>'.$WorkPlanPD->work_with.'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td><input name="visit_time['.$WorkPlanPD->id.']" value="'.$WorkPlanPD->visit_time.'"></td><td><input name="business['.$WorkPlanPD->id.']" value="'.$WorkPlanPD->business.'"></td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanPD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
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
						<input type="hidden" name="date" value="<?= $reportDateDate?>">
						<button type="submit" name="submitPlan" class="common-btn blue-btn">Send entire month's plan for approval</button>
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
</script>