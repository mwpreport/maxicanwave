<?php ?>
<?php $is_editable = true; if(count($workPlanApproval)>0) $is_editable = false;?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="calendar-container">
                    <!-- Main content -->
                    <section>
                        <div class="content">
                            <div class="white-wrapper no-padding-top">
                                <div class="row">
									<?php if($is_editable){?>
										<div class="event-button-cont">
											<ul>
												<li><a href="#ModalAdd" onclick="reset_form()" class="popup-modal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a></li>
												<li><a href="#ModalDelete" onclick="reset_form()" class="popup-modal"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
												<li><a href="#ModalCopy" onclick="reset_form()" class="popup-modal"><i class="fa fa-check-circle" aria-hidden="true"></i> Copy Plan</a></li>  
												<li><a href="#ModalLeave" onclick="reset_form()" class="popup-modal"><i class="fa fa-sign-out" aria-hidden="true"></i> Leave</a></li>  
											</ul>
										</div>
									<?php }else{?>
										<div class="col-md-12 mar-bottom-20 mar-top-20">
											<h4 class="message success">Submitted for approval Queue</h4>
										</div>
									<?php }?>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <div class="box box-primary">
                                            <div class="box-body no-padding">
                                                <!-- THE CALENDAR -->
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
									<?php if($is_editable){?>
									<form action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "submitPlan"])?>" method="post">
                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4 col-sm-offset-0 col-sm-12 col-xs-12">
											<input type="hidden" name="date" value="<?= $thisDate?>">
                                            <button type="submit" name="submitPlan" class="common-btn blue-btn">Send entire month's plan for approval</button>
                                        </div>
                                    </div>
									</form>
									<?php }?>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div> 
                    </section>
                    <section>
                        <div class="content">
                            <div class="monthly-reports white-wrapper">
                                <div class="daily-report-radio-cnt">
                                    <form>
                                        <ul>
                                            <li class="col-md-12"><h3 class="mar-top-20 mar-bottom-20">Reports (Plan Summary)</h3></li>
                                            <li class="col-md-3"><input type="radio" name="theRadioGroupName" id="doctor-wise-plan" value="doctor-wise-plan" checked="checked"><label for="doctor-wise-plan"><span></span>Doctor Wise Plan</label></li>
                                            <li class="col-md-3"><input type="radio" name="theRadioGroupName" id="svl-doctor" value="svl-doctor" checked="checked"><label for="svl-doctor"><span></span>SVL Doctor</label></li>
                                            <li class="col-md-3"><input type="radio" name="theRadioGroupName" id="speciality" value="speciality" checked="checked"><label for="speciality"><span></span>Speciality</label></li>
                                            <li class="col-md-3"><input type="radio" name="theRadioGroupName" id="entire-doctor-list" value="entire-doctor-list" checked="checked"><label for="entire-doctor-list"><span></span>Entire Doctor List Plan</label></li>
                                        </ul>
                                    </form>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-12 mar-top-20">
                                    <a href="javascript:void(0)"  onclick="getRadioValue()"  class="common-btn blue-btn btn-125">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                </div>

            </div>
            <!-- /.content-wrapper -->
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="ModalAdd">
                <div class="popup-content">
					<form class="" id="ModalAddForm" method="POST" >
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Add Plan</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="form-group">
                                    <label for="work_type_id">Work Type</label>
                                    <select name="work_type_id" class="error form-control required" id="work_type_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($workTypes as $workType)
										{?>
										<option value="<?= $workType['id']?>"><?= $workType['name']?></option>
										<?php }	?>
                                    </select>  
                                </div>

                                <div class="form-group date-section">
									<div class="col-sm-6 pad-left-0">
										<label for="start_date">Select <span class="w1 hide dhide">From</span> Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="start_date" autocomplete="false" class="form-control required" id="start_date">
										</div>
                                    </div>
                                    <div class="col-sm-6 w1 pad-right-0 hide dhide">
										<label for="end_date">Select To Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="end_date" autocomplete="false" class="form-control required" id="end_date">
										</div>
                                    </div>
                                </div>
                                <div class="form-group xw1 dshow">
                                    <label for="city_id">City</label>
                                    <select name="city_id" class="form-control required" id="city_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($cities as $citiy)
										{?>
										<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
										<?php }	?>
                                    </select>  
                                </div>
                                <div class="form-group w2 hide dhide">
                                    <label for="doctor_id">Select Doctor</label>
                                    <select name="doctor_id[]" class="form-control required" id="doctor_id" aria-invalid="true" multiple="multiple">
										<?php
										foreach ($doctorsRelation as $doctor)
										{?>
										<option value="<?= $doctor['doctor_id']?>"><?= $doctor->doctor->name?></option>
										<?php }	?>
                                    </select>  
                                </div>
								<div class="form-group w1 hide dhide">
									<label for="plan_reason">Type of Leave</label>
									<select name="plan_reason" class="form-control required" id="plan_reason" aria-invalid="true">
										<option value="">Select</option>
										<?php
										foreach ($leaveTypes as $leaveType)
										{?>
										<option value="<?= $leaveType['id']?>"><?= $leaveType['name']?></option>
										<?php }	?>
									</select>  
								</div>
								<div class="form-group w1 w8 hide dhide">
									<label for="plan_details">More Detials/Comment</label>
									<textarea class="form-control required" name="plan_details" id="plan_details" rows="5"></textarea>
								</div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
                            <div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="addSubmit" class="btn blue-btn btn-block">Save</button></div>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            <!-- pop ends here -->
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="ModalEdit">
                <div class="popup-content">
					<form class="" id="ModalEditForm" method="POST" >
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Update Plan</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Work Type</label>
                                    <select name="work_type_id" class="required form-control" id="work_type_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($workTypes as $workType)
										{?>
										<option value="<?= $workType['id']?>"><?= $workType['name']?></option>
										<?php }	?>
                                    </select>  
                                </div>
                                <div class="form-group">
									<div class="col-sm-6 pad-left-0">
										<label for="start_date">Select <span class="w1 hide dhide">From</span> Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="start_date" autocomplete="false" class="form-control required" id="start_date">
										</div>
                                    </div>
                                    <div class="col-sm-6 w11 pad-right-0 hide dhide">
										<label for="end_date">Select To Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="end_date" autocomplete="false" class="form-control required" id="end_date">
										</div>
                                    </div>
                                </div>
                                <div class="form-group xw1 dshow">
                                    <label for="city_id">City</label>
                                    <select name="city_id" class="required form-control" id="city_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($cities as $citiy)
										{?>
										<option value="<?= $citiy['id']?>"><?= $citiy['city_name']?></option>
										<?php }	?>
                                    </select>  
                                </div>
                                <div class="form-group w2 hide dhide">
                                    <label for="doctor_id">Select Doctor</label>
									<select name="doctor_id" class="form-control required" id="doctor_id" aria-invalid="true">
										<?php
										foreach ($doctorsRelation as $doctor)
										{?>
										<option value="<?= $doctor['doctor_id']?>"><?= $doctor->doctor->name?></option>
										<?php }	?>
                                    </select>  
                                </div>
								<div class="form-group w1 hide dhide">
									<label for="plan_reason">Type of Leave</label>
									<select name="plan_reason" class="required form-control" id="plan_reason" aria-invalid="true">
										<option value="">Select</option>
										<?php
										foreach ($leaveTypes as $leaveType)
										{?>
										<option value="<?= $leaveType['id']?>"><?= $leaveType['name']?></option>
										<?php }	?>
									</select>  
								</div>
								<div class="form-group w1 w8 hide dhide">
									<label for="plan_details">More Detials/Comment</label>
									<textarea class="form-control required" name="plan_details" id="plan_details" rows="5"></textarea>
								</div>
                            </div>
                            <input type="hidden" name="id" class="form-control" id="id">
                            <div class="col-md-4 col-sm-4 col-xs-4"><button type="button" id="deleteButton" class="btn blue-btn btn-block margin-right-35">Delete</button></div>
                            <div class="col-md-4 col-sm-4 col-xs-4"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
                            <div class="col-md-4 col-sm-4 col-xs-4"> <button type="submit" id="updateSubmit" class="btn blue-btn btn-block">Save</button></div>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            <!-- pop ends here -->
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="ModalDelete">
                <div class="popup-content">
					<form class="" id="ModalDeleteForm" method="POST" >
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Delete Field</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="form-group">
                                    <label for="plan_details">Select Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" autocomplete="false" class="form-control pull-right required" id="delete_date">
                                    </div>
                                </div>
                                <div class="table-responsive" id="delete_plan_list">
                                    
                                            
                                        
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
                            <div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="dateDeleteButton" class="btn blue-btn btn-block">Delete</button></div>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            <!-- pop ends here -->
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="ModalCopy">
                <div class="popup-content">
					<form class="" id="ModalCopyForm" method="POST" >
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Copy Plan</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="copy-from-to-container mar-bottom-20">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="copyfrom">Copy From</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" autocomplete="false" class="form-control pull-right required" id="copyfrom" name="copyfrom">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="copyto">Copy To</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" autocomplete="false" class="form-control pull-right required" id="copyto" name="copyto">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="table-responsive" id="copy_plan_list">
                                </div>
                            </div>
                            <div class="copy-btn-container mar-bottom-20">
                                <!--<div class="col-md-4 col-sm-4 col-xs-4"><button type="button" class="btn blue-btn btn-block margin-right-35">View Plan</button></div>-->
                                <div class="col-md-6 col-sm-6 col-xs-6"> <button type="button" class="btn blue-btn btn-block popup-modal-dismiss">Cancel</button></div>
                                <div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" class="btn blue-btn btn-block" id="planCopyButton">Copy Plan</button></div>
                            </div>                            
                        </div>
                    </div>
					</form>
                </div>
            </div>
            <!-- pop ends here -->
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="ModalLeave">
                <div class="popup-content">
					<form class="" id="ModalLeaveForm" method="POST" >
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Leave Plan</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="leave-plan mar-bottom-20">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="start_date">From Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right required" id="start_date" name="start_date" autocomplete="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="end_date">To Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right required" id="end_date" name="end_date" autocomplete="false">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6 mar-top-20">
                                    <div class="form-group">
                                        <label for="plan_reason">Type of Leave</label>
                                        <select name="plan_reason" class="required form-control" id="plan_reason" aria-invalid="true">
											<option value="">Select</option>
											<?php
											foreach ($leaveTypes as $leaveType)
											{?>
											<option value="<?= $leaveType['id']?>"><?= $leaveType['name']?></option>
											<?php }	?>
										</select>  
                                    </div>
                                </div>
                                <div class="col-sm-12 mar-top-20">
                                    <div class="form-group">
                                        <label for="plan_details">Reason for Leave</label>
                                        <textarea class="form-control required" rows="5" name="plan_details"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="copy-btn-container mar-bottom-20">
								<input type="hidden" name="work_type_id" value="1">
								<input type="hidden" name="city_id" value="<?= $userCity?>">
                                <div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
                                <div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="leaveSubmit" class="btn blue-btn btn-block">Submit</button></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            <!-- pop ends here -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- Default to the left -->
                Copyright © Mexican Wave Pharma. All Rights Reserved.
            </footer>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.2.3 -->
        <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Slimscroll -->
        <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <!-- fullCalendar 2.2.5 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="../plugins/fullcalendar/fullcalendar.js"></script>
        <script src="../plugins/magnific/jquery.magnific-popup.min.js"></script>
        <script src="../plugins/input-mask/jquery.inputmask.js"></script>
        <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="../js/jquery.validate.js"></script>

        <script>
			
            $(function(){


                //Date for the calendar events (dummy data)
                var date = new Date(), y = date.getFullYear(), m = date.getMonth();
				var startDate = new Date(y, m + 1, 1);
				var endDate = new Date(y, m + 2, 0);
				
				//Date picker
                $('#ModalAddForm #start_date, #ModalEditForm #start_date, #ModalLeaveForm #start_date, #delete_date').datepicker({
                    autoclose: true, startDate: startDate, endDate: endDate
                });
                $('#ModalAddForm #start_date, #ModalEditForm #start_date, #ModalLeaveForm #start_date').on('changeDate', function (ev) {
					$('#'+$(this).closest("form").attr('id')+' #end_date').datepicker('remove');
					$('#'+$(this).closest("form").attr('id')+' #end_date').datepicker({autoclose: true, startDate: ev.date, endDate: endDate});
					//if($('#'+$(this).closest("form").attr('id')+' #end_date').is(":visible"))
					//$('#'+$(this).closest("form").attr('id')+' #end_date').datepicker("setDate", ev.date);

					
				});
                $('#ModalAddForm #start_date, #ModalEditForm #start_date, #ModalLeaveForm #start_date, #ModalAddForm #end_date, #ModalEditForm #end_date, #ModalLeaveForm #end_date').on('hide', function(e){
					console.debug('hide', e.date, $(this).data('stickyDate'));
					var stickyDate = $(this).data('stickyDate');
					if ( !e.date && stickyDate ) {
						console.debug('restore stickyDate', stickyDate);
						$(this).datepicker('setDate', stickyDate);
						$(this).data('stickyDate', null);
					}
				});
                $('#ModalAddForm #start_date, #ModalEditForm #start_date, #ModalLeaveForm #start_date, #ModalAddForm #end_date, #ModalEditForm #end_date, #ModalLeaveForm #end_date').on('show', function(e){
					console.debug('show', e.date, $(this).data('stickyDate'));
					if ( e.date ) {
						 $(this).data('stickyDate', e.date);
					}
					else {
						 $(this).data('stickyDate', null);
					}
				});
				
                $('#delete_date').on('changeDate', function (ev) {
					$.ajax({
						   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsGetPlans"])?>',
						   dataType: "json",
						   data: "date="+moment(ev.date).format('YYYY-MM-DD'),
						   type: "POST",
						   success: function(json) {
							   $("#delete_plan_list").html(json.html);
						   }
					   });
					
				});
				
                $('#copyfrom').on('changeDate', function (ev) {
					$.ajax({
						   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsGetPlansOnly"])?>',
						   dataType: "json",
						   data: "date="+moment(ev.date).format('YYYY-MM-DD'),
						   type: "POST",
						   success: function(json) {
							   $("#copy_plan_list").html(json.html);
						   }
					   });
					
				});

                $('#ModalAddForm #end_date, #ModalEditForm #end_date, #ModalLeaveForm #end_date').datepicker({
                    autoclose: true, startDate: startDate, endDate: endDate
                })
                $('#datepicker, #copyfrom, #copyto, #fromdate, #todate').datepicker({
                    autoclose: true, startDate: startDate, endDate: endDate
                });

                // initialize the calendar
				var is_editable = '<?php echo $is_editable?>';
                $('#calendar').fullCalendar({  // assign calendar

				header: {
					left: '',
					center: 'title',
					right: ''
				},
				defaultDate: startDate,
				disableDragging : true,
				/*editable: true,*/
				eventLimit: true, // allow "more" link when too many events
				selectable: true,
				selectHelper: true,
				showNonCurrentDates : false,

				events: "<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsView"])?>",  // request to load current events

				select: function(start, end, jsEvent) {  // click on empty time slot
					cDate= new Date(moment(start).format('YYYY-MM-DD 00:00:00'));
					if(cDate >= startDate && cDate <= endDate && is_editable)
					{
						reset_form();
						$('#ModalAdd #start_date').val(moment(start).format('YYYY-MM-DD'));
						$('#ModalAdd #end_date').datepicker('remove');
						$('#ModalAdd #end_date').datepicker({autoclose: true, startDate: moment(start).format('YYYY-MM-DD'), endDate: endDate});
						$.magnificPopup.open({ items: {src: '#ModalAdd'}, type: 'inline' });
					}
			   },
			   eventRender: function(event, element) { // click on event
					element.bind('click', function() {
						cDate= event.start;
						if(cDate >= startDate && cDate <= endDate && is_editable)
						{
							reset_form();
							$('#ModalEdit #id').val(event.id);
							$.ajax({
							 url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsGetPlan"])?>',
							 type: "POST",
							 dataType: "json",
							 data: "id="+event.id+"&action=get_event",
							 success: function(data) {
									if(data.success == '1'){
									$('#ModalEdit #work_type_id').val(data.work_type_id);
									$('#ModalEdit #long_plan').val(data.long_plan);
									$('#ModalEdit #start_date').datepicker("setDate", data.start_date);
									$('#ModalEdit #end_date').datepicker("setDate", data.end_date);
									$('#ModalEdit #end_date').addClass("hide");
									$('#ModalEdit #city_id').val(data.city_id);
									$('#ModalEdit #doctor_id').val(data.doctor_id);
									$('#ModalEdit #plan_reason').val(data.plan_reason);
									$('#ModalEdit #plan_details').val(data.plan_details);
									var work_type_id = data.work_type_id;
									$('#ModalEdit .xw'+work_type_id).addClass("hide");
									$("#ModalEdit .dhide").addClass("hide");
									$('#ModalEdit .w'+work_type_id).removeClass("hide");
									$.magnificPopup.open({ items: {src: '#ModalEdit'}, type: 'inline' });
									}
								}
							});
						}
					});
				},			
			   eventDrop: function(event, delta){ // event drag and drop
				   var start=moment(event.start).format('YYYY-MM-DD');
				   var end=moment(event.end).format('YYYY-MM-DD');
				   if(end=="Invalid date")
				   end = start;
				   $.ajax({
					   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsDragDrop"])?>',
					   data: 'action=update&start_date='+start+'&end_date='+end+'&id='+event.id,
					   type: "POST",
					   success: function(json) {
					   //alert(json);
					   }
				   });
			   }
			   
			});

		   /* EVENTS */
		   $('#deleteButton').on('click', function(e){ // delete event clicked
			   e.preventDefault();
			   doDelete(); //send data to delete function
		   });
       

       /*Form Events*/
		$( "#ModalAddForm #work_type_id" ).change(function() {
		  var work_type_id = $(this).val();
		  $("#ModalAddForm .dhide").addClass("hide");
		  $("#ModalAddForm .dshow").removeClass("hide");
		  $('#ModalAddForm #end_date').val('');
		  $('#ModalAddForm .w'+work_type_id).removeClass("hide");
		  $("#ModalAddForm .xw"+work_type_id).addClass("hide");
		});

		$( "#ModalEditForm #work_type_id" ).change(function() {
		  var work_type_id = $(this).val();
		  $("#ModalEditForm .dhide").addClass("hide");
		  $("#ModalEditForm .dshow").removeClass("hide");
		  $('#ModalEditForm #end_date').val('');
		  $('#ModalEditForm .w'+work_type_id).removeClass("hide");
		  $("#ModalEditForm .xw"+work_type_id).addClass("hide");
		});

			   
		$("#ModalAddForm").validate({
			 ignore: ":hidden",
			 submitHandler: function (form) {
				doSubmit()
				return false; // required to block normal submit since you used ajax
			 }
		 });
		$("#ModalEditForm").validate({
			 ignore: ":hidden",
			 submitHandler: function (form) {
				updateSubmit();
				return false; // required to block normal submit since you used ajax
			 }
		 });
		 
		$("#ModalDeleteForm").validate({
			 ignore: ":hidden",
			 submitHandler: function (form) {
				doDateDelete();
				return false; // required to block normal submit since you used ajax
			 }
		 });
		 
		$("#ModalLeaveForm").validate({
			 ignore: ":hidden",
			 submitHandler: function (form) {
				doLeave();
				return false; // required to block normal submit since you used ajax
			 }
		 });
		 
		$("#ModalCopyForm").validate({
			 ignore: ":hidden",
			 submitHandler: function (form) {
				doPlanCopy();
				return false; // required to block normal submit since you used ajax
			 }
		 });
       
		$('.popup-modal').magnificPopup({
			type: 'inline',
			preloader: false,
			modal: true
		});

		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			reset_form();
			$.magnificPopup.close();
		});
		
		$( "#ModalAddForm #start_date" ).on('changeDate', function (ev) {
			loadDoctors("#ModalAddForm");
		});
		$( "#ModalAddForm #work_type_id, #ModalAddForm #city_id" ).change(function() {
			loadDoctors("#ModalAddForm");
		});
       
            });
        </script>
        <script>
            
		function doPlanCopy(){  // delete event 
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsPlanCopy"])?>',
			   data: $('#ModalCopyForm').serialize(),
			   type: "POST",
			   dataType: "json",
			   success: function(json) {
				   if(json.success == "1")
					{
						$('#calendar').fullCalendar( 'refetchEvents' );
						$('#ModalCopyForm #copyfrom,#ModalCopyForm #copyto').val("");
						$.magnificPopup.close();
					}
				   else
				   {
					   alert(json.error); return false;
				   }
			   }
		   });
		}

		function doDateDelete(){  // delete event 
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsDateDelete"])?>',
			   data: $('#ModalDeleteForm').serialize(),
			   type: "POST",
			   dataType: "json",
			   success: function(json) {
				   if(json.success == "1")
					{
						$('#calendar').fullCalendar( 'refetchEvents' );
						$.magnificPopup.close();
					}
				   else
						return false;
			   }
		   });
		}

		function doDelete(){  // delete event 
		   var eventID = $('#ModalEdit #id').val();
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsDelete"])?>',
			   data: 'action=delete&id='+eventID,
			   type: "POST",
			   success: function(json) {
				   if(json == 1)
					{
						$("#calendar").fullCalendar('removeEvents',eventID);
						
						$.magnificPopup.close();
					}
				   else
						return false;
			   }
		   });
		}

		function doSubmit(){ // add event
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAdd"])?>',
			   dataType: "json",
			   data: $('#ModalAddForm').serialize()+"&action=add",
			   type: "POST",
			   success: function(json) {
				   if(json.status == 1)
				   {					   
					   for( var i=0; i<json.events.length; i++)
					   {
						   $("#calendar").fullCalendar('renderEvent',
						   {
							   id: json.events[i].id,
							   title: json.events[i].title,
							   start: json.events[i].start,
							   end: json.events[i].end,
							   color: json.events[i].color
						   },
						   true);
					   }
				   $.magnificPopup.close();
				   }
				   else
				   {
					   alert(json.error);
				   }
			   }
		   });
		}

		function doLeave(){ // add event
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAdd"])?>',
			   dataType: "json",
			   data: $('#ModalLeaveForm').serialize()+"&action=add",
			   type: "POST",
			   success: function(json) {
				   if(json.status == 1)
				   {					   
					   for( var i=0; i<json.events.length; i++)
					   {
						   $("#calendar").fullCalendar('renderEvent',
						   {
							   id: json.events[i].id,
							   title: json.events[i].title,
							   start: json.events[i].start,
							   end: json.events[i].end,
							   color: json.events[i].color
						   },
						   true);
					   }
				   $.magnificPopup.close();
				   }
				   else
				   {
					   alert(json.error);
				   }
			   }
		   });
		}

		function updateSubmit(){ // update event
		   var eventID = $('#ModalEdit #id').val();
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsUpdate"])?>',
			   dataType: "json",
			   data: $('#ModalEditForm').serialize()+"&action=update_event",
			   type: "POST",
			   success: function(json) {
				   if(json.status == 1)
				   {					   
					   for( var i=0; i<json.events.length; i++)
					   {
						   $("#calendar").fullCalendar('removeEvents',eventID);
						   $("#calendar").fullCalendar('renderEvent',
						   {
							   id: json.events[i].id,
							   title: json.events[i].title,
							   start: json.events[i].start,
							   end: json.events[i].end,
							   color: json.events[i].color
						   },
						   true);
					   }
				   $.magnificPopup.close();
				   }
				   else
				   {
					   alert(json.error);
				   }
			   }
		   });
		}
       
		function loadDoctors(form){
			var start_date = $(form+" #start_date").val();
			var work_type_id = $(form+" #work_type_id").val();
			if(work_type_id == 2)
			{
				var city_id = $(form+" #city_id").val();
				if($(form+" #work_type_id").length)
				var id = $(form+" #id").val();
				$.ajax({
					   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "planGetDoctors"])?>',
					   data: "city_id="+city_id+"&start_date="+start_date+"&id="+id,
					   type: "POST",
					   success: function(json) {
						   $(form+' #doctor_id').html(json);
					   }
				});
			}
		}
		
		function reset_form(){
			$('#ModalAddForm,#ModalEditForm,#ModalLeaveForm,#ModalDeleteForm,#ModalCopyForm')[0].reset();
			$("#delete_plan_list, #copy_plan_list").html('');
			$("#ModalAddForm .dhide").addClass("hide");
			$("#ModalAddForm .dshow").removeClass("hide");
		}

        </script>
        <script>
        function getRadioValue() {
            var selectedOption = $("input:radio[name=theRadioGroupName]:checked").val();
            if(selectedOption){
                if(selectedOption == 'doctor-wise-plan'){
                    window.location.href = 'http://www.mwreports.com/demo/doctor-wise-plan.php';
                }else if(selectedOption == 'svl-doctor'){
                    window.location.href = 'http://www.yahoo.com';
                }else if(selectedOption == 'speciality'){
                    window.location.href = 'http://www.facebook.com';
                }else if(selectedOption == 'entire-doctor-list'){
                    window.location.href = 'http://www.twitter.com';
                }
            }else{
                alert('Please select the radio');
            }
            
 
        }
    </script>
