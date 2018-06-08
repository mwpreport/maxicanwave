<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Doctor Visit Report <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "index"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form id="plan_summary_form" method="POST" action="<?php echo $this->Url->build(["controller" => "Reports","action" => "doctorVisitReport"])?>">
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-3">
                            <select name="month[]" class="error form-control" id="state" aria-invalid="true"  multiple="multiple" required>
								<?php
								for ($i = 0; $i < 6; $i++) {
								  echo '<option value='.$i.'>'.date('F Y', strtotime("-$i month")).'</option>';
								}
								?>
                            </select>  
                        </div>
                        <div class="col-sm-3">
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
