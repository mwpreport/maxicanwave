<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
						<?php $reportDate = ""; if($date!="") $reportDate = date("Y-m-d", strtotime($date));?>
                        <h2>Daily Report of <?= $reportDate?></h2>
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
				$html.='<h3 class="mar-top-10 mar-bottom-10">Planned Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansD as $WorkPlanD)
				{
					$products_array = array(); $samples_array = array();
					if($WorkPlanD->products!="")
					$products_array = unserialize($WorkPlanD->products);
					if($WorkPlanD->samples!="")
					$samples_array = unserialize($WorkPlanD->samples);
					$detail_products =array(); $sample_products =array();
					foreach($products as $product)
					{
					if (array_key_exists($product->id, $samples_array)) $sample_products[]= $product->name;
					if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
					}
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>'.$WorkPlanD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.$WorkPlanD->visit_time.'</td><td>'.$WorkPlanD->business.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
			
			if(count($WorkPlansUD))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">Un-Planned Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansUD as $WorkPlanUD)
				{
					$products_array = array(); $samples_array = array();
					if($WorkPlanUD->products!="")
					$products_array = unserialize($WorkPlanUD->products);
					if($WorkPlanUD->samples!="")
					$samples_array = unserialize($WorkPlanUD->samples);
					$detail_products =array(); $sample_products =array();
					foreach($products as $product)
					{
					if (array_key_exists($product->id, $samples_array)) $sample_products[]= $product->name;
					if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
					}
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanUD->doctor->name.'</td><td>'.$WorkPlanUD->city->city_name.'</td><td>'.$WorkPlanUD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.$WorkPlanUD->visit_time.'</td><td>'.$WorkPlanUD->business.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanUD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}

			if(count($WorkPlansPD))
			{
				$html.='<h3 class="mar-top-10 mar-bottom-10">PG & Others</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansPD as $WorkPlanPD)
				{
					
					$products_array = array(); $samples_array = array();
					if($WorkPlanPD->products!="")
					$products_array = unserialize($WorkPlanPD->products);
					if($WorkPlanPD->samples!="")
					$samples_array = unserialize($WorkPlanPD->samples);
					$detail_products =array(); $sample_products =array();
					foreach($products as $product)
					{
					if (array_key_exists($product->id, $samples_array)) $sample_products[]= $product->name;
					if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
					}
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanPD->pg_other->name.'</td><td>'.$WorkPlanPD->city->city_name.'</td><td>'.$WorkPlanPD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.$WorkPlanPD->visit_time.'</td><td>'.$WorkPlanPD->business.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanPD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
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
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanL->leave_type->name.'</td><td>'.$WorkPlanL->plan_details.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanL->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
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
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlan->work_type->name.'</td><td>'.$WorkPlan->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlan->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
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
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanC->chemist->name.'</td><td>'.$WorkPlanC->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanC->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
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
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanS->stockist->name.'</td><td>'.$WorkPlanS->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanS->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
						
			if($html == ""){$html.="<p>No reports on this date</p>";}
		
			echo $html;
						?>
					</div>
                </div>

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