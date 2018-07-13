<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Daily Report <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "index"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form id="daily_plan_form" method="POST" action="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyReportDetails"])?>">
                    <div class="form-group mar-bottom-40">
                        <div class="row">
                            <div class="leave-plan mar-bottom-20">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="start_date">From Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right required" id="start_date" name="start_date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="end_date">To Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right required" id="end_date" name="end_date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
									<div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="input-group date">
										<button type="submit" id="relationSubmit" class="common-btn blue-btn btn-125">Submit</button>
										</div>
									</div>
                                </div>
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
		var startDate = new Date(y, m - 6, 1);
		var endDate = new Date(y, m, 31);
		
		//Date picker
		$('#start_date, #end_date').datepicker({
			autoclose: true, startDate: startDate, endDate: endDate, format: 'dd-mm-yyyy'
		});
		$('#start_date').on('changeDate', function (ev) {
			$('#end_date').datepicker('remove');
			$('#end_date').datepicker({autoclose: true, startDate: ev.date, endDate: endDate, format: 'dd-mm-yyyy'});
		});
				
       
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
		
		$("#daily_plan_form").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#daily_plan_form")
			return false; // required to block normal submit since you used ajax
		}
	});

       
</script>
