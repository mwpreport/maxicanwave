<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Daily Report
							<span class="go-back pull-right no-print"><a href="javascript:print()" class="mar-left-20"><i class="fa fa-print"></i> Print</a></span>
							<span class="go-back pull-right no-print"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyPlan"])?>"><i class="fa fa-arrow-left"></i> Go Back</a>&nbsp;&nbsp;</span>
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
		foreach( $workPlansDate as $date=>$workPlanDate)
		{ ?>
			<?php
			//pj($workPlanDate);
			if(isset($workPlanDate['field']) || isset($workPlanDate['other']) || isset($workPlanDate['leave']))
			{
				$html = '<div class="white-wrapper no-padding mar-top-20"><div class="table-responsive" id="report_section"><h3 class="mar-top-10 mar-bottom-10 center"><u>'.$date.'</u></h3>';
				if(!empty($workPlanDate['field'])){
					$html.='<table class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Class</th><th>Spec</th><th>City</th><th>Products</th></tr></thead><tbody>';
					$i = 1;
					foreach ($workPlanDate['field'] as $WorkPlanD)
					{
						$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$class[$WorkPlanD->doctor->class].'</td><td>'.$WorkPlanD->doctor->speciality->code.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>&nbsp;</td></tr>';
						$i++;
					}
					$html.='</tbody></table>';
				}
				if(!empty($workPlanDate['other'])){
					$html.='<table class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Work Type</th><th>City</th></tr></thead><tbody>';
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
				

				$html.='</div></div>';
				echo $html;
			}
			
			?>
		<?php }?>
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
