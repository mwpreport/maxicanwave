<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Plan Summary</h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form id="doctorsListForm" method="POST" action="../doctors-relation/mrs_add/">
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-3">
                            <select name="month" class="error form-control" id="state" aria-invalid="true">
								<?php
								$m = date("m");
								for($i=1;$i<=12;$i++)
								echo '<option value='.$i.' '.(($m+1==$i)? "selected" : "").'>'.DateTime::createFromFormat('!m', $i)->format('F').'</option>';
								?>
                            </select>  
                        </div>
                        <div class="col-sm-3">
                            <select name="year" class="error form-control" id="city" onchange="loadDoctors()" aria-invalid="true">
								<?php
								$y = date("Y");
								for($i=$y;$i<=$y+3;$i++)
								echo '<option value='.$i.' '.(($y==$i)? "selected" : "").'>'.$i.'</option>';
								?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <div class="col-sm-12">
                            <button type="submit" id="relationSubmit" class="common-btn blue-btn btn-125">Submit</button>
                        </div>
                    </div>
                </form>

				<div class="daily-report-radio-cnt">
						<ul>
							<li class="col-md-12"><h3 class="mar-top-20 mar-bottom-20">Reports (Plan Summary)</h3></li>
							<li class="col-md-3"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "planSummary",'?' => ['type' => 'Doctor_Wise_Plan']])?>" class="btn blue-btn btn-block margin-right-35 iframe-popup-link" ><b>Doctor Wise Plan</b></a></li>
							<li class="col-md-3"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "planSummary",'?' => ['type' => 'Un-Planned_Doctors']])?>" class="btn blue-btn btn-block margin-right-35 iframe-popup-link" ><b>Un-Planned Doctors</b></a></li>
							<li class="col-md-3"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "planSummary",'?' => ['type' => 'Entire_Doctor_List_Plan']])?>" class="btn blue-btn btn-block margin-right-35 iframe-popup-link" ><b>Entire Doctor List Plan</b></a></li>
						</ul>
						<div class="clearfix"></div>
						<div class="col-sm-12 mar-top-20">
						<!--<button type="submit" class="common-btn blue-btn btn-125">Submit</button>-->
						</div>
			   </div>
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
