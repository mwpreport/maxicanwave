<?php ?>
<?php $is_editable = true;?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="calendar-container">
                    <!-- Main content -->
                    <section>
                        <div class="content">
                            <div class="white-wrapper no-padding-top">
                                <div class="row">
										<div class="col-md-12 mar-bottom-20 mar-top-20">
											<h4 class="message success">
											<?php
											if($workPlanApproval->is_approved == 0)
												echo "Submitted for approval Queue";
											if($workPlanApproval->is_rejected == 1)
											{echo "Request Rejected";$is_editable = false;}
											if($workPlanApproval->is_approved == 1)
											{echo "Approved";$is_editable = false;}
											?>
											</h4>
										</div>
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
									<form action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "planApproval"])?>" method="post">
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-6 col-sm-offset-0 col-sm-12 col-xs-12">
											<input type="hidden" name="id" value="<?= $workPlanApproval['id']?>">
                                            <div class="col-sm-6"><button type="submit" name="RejectPlan" class="common-btn blue-btn">Reject</button></div>
                                            <div class="col-sm-6"><button type="submit" name="ApprovePlan" class="common-btn blue-btn">Approve</button></div>
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
                    <!-- /.content -->
                </div>

            </div>
            <!-- /.content-wrapper -->
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="ModalEdit">
                <div class="popup-content">
					<form class="" id="ModalEditForm" method="POST" >
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Plan Details</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Work Type</label>
                                    <select disabled name="work_type_id" class="required form-control" id="work_type_id" aria-invalid="true">
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
											<input disabled type="text" name="start_date" autocomplete="false" class="form-control required" id="start_date">
										</div>
                                    </div>
                                    <div class="col-sm-6 w11 pad-right-0 hide dhide">
										<label for="end_date">Select To Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input disabled type="text" name="end_date" autocomplete="false" class="form-control required" id="end_date">
										</div>
                                    </div>
                                </div>
                                <div class="form-group xw1 dshow">
                                    <label for="city_id">City</label>
                                    <select disabled name="city_id" class="required form-control" id="city_id" aria-invalid="true">
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
									<select disabled name="doctor_id" class="form-control required" id="doctor_id" aria-invalid="true">
										<?php
										foreach ($doctorsRelation as $doctor)
										{?>
										<option value="<?= $doctor['doctor_id']?>"><?= $doctor->doctor->name?></option>
										<?php }	?>
                                    </select>  
                                </div>
								<div class="form-group w1 hide dhide">
									<label for="plan_reason">Type of Leave</label>
									<select disabled name="plan_reason" class="required form-control" id="plan_reason" aria-invalid="true">
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
									<textarea disabled class="form-control required" name="plan_details" id="plan_details" rows="5"></textarea>
								</div>
                            </div>
                            <input type="hidden" name="id" class="form-control" id="id">
                            <div class="col-md-4 col-sm-4 col-xs-4"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Close</button></div>
                            <div class="col-md-4 col-sm-4 col-xs-4"><button type="button" id="deleteButton" class="btn blue-btn btn-block margin-right-35">Delete</button></div>
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
        <script src="<?php echo $this->Url->image('../plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
        <script src="<?php echo $this->Url->image('../bootstrap/js/bootstrap.min.js')?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?php echo $this->Url->image('../plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
        <!-- FastClick -->
        <script src="<?php echo $this->Url->image('../plugins/fastclick/fastclick.js')?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo $this->Url->image('../dist/js/app.min.js')?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo $this->Url->image('../dist/js/demo.js')?>"></script>
        <!-- fullCalendar 2.2.5 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="<?php echo $this->Url->image('../plugins/fullcalendar/fullcalendar.js')?>"></script>
        <script src="<?php echo $this->Url->image('../plugins/magnific/jquery.magnific-popup.min.js')?>"></script>
        <script src="<?php echo $this->Url->image('../plugins/input-mask/jquery.inputmask.js')?>"></script>
        <script src="<?php echo $this->Url->image('../plugins/datepicker/bootstrap-datepicker.js')?>"></script>
        <script src="<?php echo $this->Url->image('../js/jquery.validate.js')?>"></script>

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

				events: "<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsView", "user_id" => $user_id])?>",  // request to load current events

				
			   eventRender: function(event, element) { // click on event
					element.bind('click', function() {
						cDate = new Date(moment(event.start).format('YYYY-MM-DD 00:00:00'));
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
