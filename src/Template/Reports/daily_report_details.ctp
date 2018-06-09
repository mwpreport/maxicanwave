<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper small">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Daily Report
							<span class="go-back pull-right no-print"><a href="javascript:print()" class="mar-left-20"><i class="fa fa-print"></i> Print</a></span>
							<span class="go-back pull-right no-print"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyReport"])?>"><i class="fa fa-arrow-left"></i> Go Back</a>&nbsp;&nbsp;</span>
                        </h2>
                        <hr>
                        <h3><?php echo "Mr. ".$user->firstname." ".$user->lastname." | ".$user->city->city_name." | ".$user->role->code?></h3>
                        <h5><?php echo "From : ".date("d/m/Y", strtotime($start_date))." | To : ".date("d/m/Y", strtotime($end_date))?></h5>
                    </div>
                </div>
                <div class="clearfix"></div>
			</div>
		</section>
	   
		
		<?php 
		$day_count = 1;
		$doctor_count = 0;
		$chemist_count = 0;
		foreach( $workPlansDate as $date=>$workPlanDate)
		{ 
			if(isset($workPlanDate['field']) || isset($workPlanDate['un_field']) || isset($workPlanDate['pg_field']) || isset($workPlanDate['chemist']) || isset($workPlanDate['stockist']) || isset($workPlanDate['other']) || isset($workPlanDate['leave']))
			{
				$html = '<div class="white-wrapper no-padding mar-top-20"><div class="table-responsive" id="report_section"><h3 class="mar-top-10 mar-bottom-15 center"><u>'.$date.'</u></h3>';
				if(!empty($workPlanDate['field']) || !empty($workPlanDate['un_field']) || !empty($workPlanDate['pg_field'])){
					$html.='<h3 class="mar-top-10 mar-bottom-10 center">Doctor Visit</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Class</th><th>Spec</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Gifts</th><th>Visit Time</th><th>Business</th></tr></thead><tbody>';
					$i = 1;
					if(!empty($workPlanDate['field']))
					{
						foreach ($workPlanDate['field'] as $WorkPlanD)
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

							$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$class[$WorkPlanD->doctor->class].'</td><td>'.$WorkPlanD->doctor->speciality->code.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>'.$WorkPlanD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.((count($gift_products)>0)?implode(", ",$gift_products):"").'</td><td>'.$WorkPlanD->visit_time.'</td><td>'.$WorkPlanD->business.'</td></tr>';
						$i++; $doctor_count++;
						}
						
					}
					
					if(!empty($workPlanDate['un_field']))
					{
						foreach ($workPlanDate['un_field'] as $WorkPlanUD)
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
							$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanUD->doctor->name.'</td><td>'.$class[$WorkPlanUD->doctor->class].'</td><td>'.$WorkPlanUD->doctor->speciality->code.'</td><td>'.$WorkPlanUD->city->city_name.'</td><td>'.$WorkPlanUD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.((count($gift_products)>0)?implode(", ",$gift_products):"").'</td><td>'.$WorkPlanUD->visit_time.'</td><td>'.$WorkPlanUD->business.'</td></tr>';
						$i++; $doctor_count++;
						}
					}

					if(!empty($workPlanDate['pg_field']))
					{
						foreach ($workPlanDate['pg_field'] as $WorkPlanPD)
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
							$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanPD->pg_other->name.'</td><td></td><td>'.$WorkPlanPD->pg_other->speciality->code.'</td><td>'.$WorkPlanPD->city->city_name.'</td><td>'.$WorkPlanPD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.((count($gift_products)>0)?implode(", ",$gift_products):"").'</td><td>'.$WorkPlanPD->visit_time.'</td><td>'.$WorkPlanPD->business.'</td></tr>';
						$i++;
						}
					}

					$html.='</tbody></table>';
				}
				if(!empty($workPlanDate['other'])){
					$html.='<h3 class="mar-top-10 mar-bottom-10 center">Others</h3><table class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Work Type</th><th>City</th></tr></thead><tbody>';
					$i = 1;
					foreach ($workPlanDate['other'] as $WorkPlan)
					{
						$html.='<tr><td>'.$i.'</td><td>'.$WorkPlan->work_type->name.'</td><td>'.$WorkPlan->city->city_name.'</td></tr>';
					$i++;
					}
					$html.='</tbody></table>';
				}
				if(!empty($workPlanDate['leave'])){
				$html.='<table class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Type of Leave</th><th>More details</th></thead><tbody>';
				$i = 1;
				foreach ($workPlanDate['leave'] as $WorkPlanL)
				{
					$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanL->leave_type->name.'</td><td>'.$WorkPlanL->plan_details.'</td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
				}
				if(!empty($workPlanDate['chemist']))
				{
					$html.='<h3 class="mar-top-10 mar-bottom-10 center">Chemist Visits</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Chemists Name</th><th>City</th></tr></thead><tbody>';
					$i = 1;
					foreach ($workPlanDate['chemist'] as $WorkPlanC)
					{
						$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanC->chemist->name.'</td><td>'.$WorkPlanC->city->city_name.'</td></tr>';
					$i++; $chemist_count++;
					}
					$html.='</tbody></table>';
				}
				if(!empty($workPlanDate['stockist']))
				{
					$html.='<h3 class="mar-top-10 mar-bottom-10 center">Stockist Visits</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Stockists Name</th><th>City</th></tr></thead><tbody>';
					$i = 1;
					foreach ($workPlanDate['stockist'] as $WorkPlanS)
					{
						$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanS->stockist->name.'</td><td>'.$WorkPlanS->city->city_name.'</td></tr>';
					$i++;
					}
					$html.='</tbody></table>';
				}
						
				$html.='<h5>Doctor Calls till today: '.$doctor_count.', Doctor Calls Avg. till today: '.number_format(($doctor_count/$day_count),2).' %</h5>';
				$html.='<h5>Chemist Calls till today: '.$chemist_count.', Chemist Calls Avg. till today: '.number_format(($chemist_count/$day_count),2).' %</h5>';
				$html.='</div></div>';
				echo $html; $day_count++;
			}
			
		}
		 ?>
    </div>

</div>
<script>
			


		//Date for the calendar events (dummy data)
		var date = new Date(), y = date.getFullYear(), m = date.getMonth();
		var startDate = new Date(y, m + 1, 1);
		var endDate = new Date(y, m + 2, 0);
				
       
		$('.popup-modal').magnificPopup({
			type: 'inline',
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
			  }
		});

		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
		
       
</script>
