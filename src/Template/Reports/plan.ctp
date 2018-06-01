<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Plan Summary <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "index"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form id="plan_summary_form" method="POST" action="<?php echo $this->Url->build(["controller" => "Reports","action" => "planSummary"])?>">
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-3">
                            <select name="month" class="error form-control" id="state" aria-invalid="true">
								<?php
								$m = date("m",strtotime("+1 month"));
								//for($i=1;$i<=12;$i++)
								echo '<option value='.$m.'>'.DateTime::createFromFormat('!m', $m)->format('F').'</option>';
								?>
                            </select>  
                        </div>
                        <div class="col-sm-3">
                            <select name="year" class="error form-control" id="city" onchange="loadDoctors()" aria-invalid="true">
								<?php
								$y = date("Y");
								for($i=$y;$i<=$y;$i++)
								echo '<option value='.$i.' '.(($y==$i)? "selected" : "").'>'.$i.'</option>';
								?>
                            </select>  
                        </div>
                    </div>
					<div class="daily-report-radio-cnt">
							<ul>
								<li class="col-md-12"><h3 class="mar-top-20 mar-bottom-20">Select Format</h3></li>
								<li class="col-md-3"><input type="radio" name="type" id="Doctor_Wise_Plan" value="Doctor_Wise_Plan" checked="checked"><label for="Doctor_Wise_Plan"><span></span>Doctor Wise Plan</label></li>
								<li class="col-md-3"><input type="radio" name="type" id="Un-Planned_Doctors" value="Un-Planned_Doctors"><label for="Un-Planned_Doctors"><span></span>Un-Planned Doctors</label></li>
								<li class="col-md-3"><input type="radio" name="type" id="Entire_Doctor_List_Plan" value="Entire_Doctor_List_Plan" ><label for="Entire_Doctor_List_Plan"><span></span>Entire Doctor List Plan</label></li>
							</ul>
				   </div>
                    <div class="form-group pull-right">
                        <div class="col-sm-12">
							<input type="hidden" name="page-type" value="page">
                            <button type="submit" id="relationSubmit" class="common-btn blue-btn btn-125">Submit</button>
                        </div>
                    </div>
                </form>

			</div>
		</section>
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
