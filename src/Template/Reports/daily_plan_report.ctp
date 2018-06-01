<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Daily Plan () <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyPlan"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
			</div>
		</section>
	   
		
		<?php 
		foreach( $WorkPlan_Date as $date=>$WorkPlansD)
		{ ?>
		<section>
			<div class="row" id="report_section">
				<div class="col-xs-12">
					<div class="white-wrapper mar-top-20">
						<!-- /.box-header -->
						<div class="table-responsive" id="report_section">
						<?php
						$html = "";
						if(!empty($WorkPlansD))
						{
							$html.='<h3 class="mar-top-10 mar-bottom-10">'.$date.'</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Class</th><th>Spec</th><th>City</th><th>Work With</th></tr></thead><tbody>';
							$i = 1;
							foreach ($WorkPlansD as $WorkPlanD)
							{
								$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$class[$WorkPlanD->doctor->class].'</td><td>'.$WorkPlanD->doctor->speciality->code.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>'.$WorkPlanD->work_with.'</td></tr>';
							$i++;
							}
							$html.='</tbody></table>';
						}
						?>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
		</section>
		<?php }?>
    </div>
    <!-- /.content -->
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
