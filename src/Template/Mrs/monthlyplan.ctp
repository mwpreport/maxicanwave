<?php $this->layout = false;?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calendar</title>
        <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.min.css">
        <link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.print.css" media="print">
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="../dist/css/skins/skin-red-light.min.css">
        <link rel="stylesheet" href="../plugins/magnific/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>
    <body class="skin-red-light sidebar-mini">
        <div class="wrapper">

			<?php
			//echo $this->element('mr/header'); 
			//echo $this->element('mr/menu'); 
			echo $this->Flash->render();
			?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="calendar-container">
                    <!-- Main content -->
                    <section>
                        <div class="content">
                            <div class="white-wrapper no-padding-top">
                                <div class="row">
                                    <div class="event-button-cont">
                                        <ul>
                                            <li><a href="#ModalAdd" class="popup-modal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a></li>
                                            <li><a href="#ModalDelete" class="popup-modal"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                            <li><a href="#copy_plan" class="popup-modal"><i class="fa fa-check-circle" aria-hidden="true"></i> Copy Plan</a></li>  
                                            <li><a href="#ModalLeave" class="popup-modal"><i class="fa fa-sign-out" aria-hidden="true"></i> Leave</a></li>  
                                        </ul>
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
                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4 col-sm-offset-0 col-sm-12 col-xs-12">
                                            <a href="" class="common-btn blue-btn">Send entire month's plan for approval</a>
                                        </div>
                                    </div>
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
                        <div class="hr-title"><h4>Add Field</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Work Type</label>
                                    <select name="work_type_id" class="error form-control" id="work_type_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($workTypes as $workType)
										{?>
										<option value="<?= $workType['id']?>"><?= $workType['name']?></option>
										<?php }	?>
                                    </select>  
                                </div>

                                <div class="form-group hide">
									<label for="date">Long Plan</label>
									<select name="long_plan" class="error form-control" id="long_plan" aria-invalid="true">
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
                                </div>
                                <div class="form-group">
									<div class="col-sm-6 pad-left-0">
										<label for="date">Select <span class="w2 hide dhide">From</span> Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="start_date" class="form-control" id="start_date">
										</div>
                                    </div>
                                    <div class="col-sm-6 w2 pad-right-0 hide dhide">
										<label for="date">Select To Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="end_date" class="form-control" id="end_date">
										</div>
                                    </div>
                                </div>
                                <div class="form-group xw2 dshow">
                                    <label for="exampleInputEmail1">City</label>
                                    <select name="city_id" class="error form-control" id="city_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($cities as $citiy)
										{?>
										<option value="<?= $citiy['id']?>" <?php if($citiy['id']==$userCity	) echo "selected";?>><?= $citiy['city_name']?></option>
										<?php }	?>
                                    </select>  
                                </div>
                                <div class="form-group w1 hide dhide">
                                    <label for="exampleInputEmail1">Select Doctor</label>
                                    <select name="doctor_id" class="error form-control" id="doctor_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($doctorsRelation as $doctor)
										{?>
										<option value="<?= $doctor['doctor_id']?>"><?= $doctor->doctor->name?></option>
										<?php }	?>
                                    </select>  
                                </div>
								<div class="form-group w2 hide dhide">
									<label for="date">Type of Leave</label>
									<select name="plan_reason" class="error form-control" id="plan_reason" aria-invalid="true">
										<option value="">Select</option>
										<?php
										foreach ($leaveTypes as $leaveType)
										{?>
										<option value="<?= $leaveType['id']?>"><?= $leaveType['name']?></option>
										<?php }	?>
									</select>  
								</div>
								<div class="form-group w2 w8 hide dhide">
									<label for="date">More Detials/Comment</label>
									<textarea class="form-control" name="plan_details" id="plan_details" rows="5"></textarea>
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
                        <div class="hr-title"><h4>Add Field</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Work Type</label>
                                    <select name="work_type_id" class="error form-control" id="work_type_id" aria-invalid="true">
                                        <option value="">Field</option>
										<?php
										foreach ($workTypes as $workType)
										{?>
										<option value="<?= $workType['id']?>"><?= $workType['name']?></option>
										<?php }	?>
                                    </select>  
                                </div>
                                <div class="form-group hide">
									<label for="date">Long Plan</label>
									<select name="long_plan" class="error form-control" id="long_plan" aria-invalid="true">
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
                                </div>
                                <div class="form-group">
									<div class="col-sm-6 pad-left-0">
										<label for="date">Select <span class="w2 hide dhide">From</span> Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="start_date" class="form-control" id="start_date">
										</div>
                                    </div>
                                    <div class="col-sm-6 w2 pad-right-0 hide dhide">
										<label for="date">Select To Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="end_date" class="form-control" id="end_date">
										</div>
                                    </div>
                                </div>
                                <div class="form-group xw2 dshow">
                                    <label for="exampleInputEmail1">City</label>
                                    <select name="city_id" class="error form-control" id="city_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($cities as $citiy)
										{?>
										<option value="<?= $citiy['id']?>"><?= $citiy['city_name']?></option>
										<?php }	?>
                                    </select>  
                                </div>
                                <div class="form-group w1 hide dhide">
                                    <label for="exampleInputEmail1">Select Doctor</label>
                                    <select name="doctor_id" class="error form-control" id="doctor_id" aria-invalid="true">
                                        <option value="">Select</option>
										<?php
										foreach ($doctorsRelation as $doctor)
										{?>
										<option value="<?= $doctor['doctor_id']?>"><?= $doctor->doctor->name?></option>
										<?php }	?>
                                    </select>  
                                </div>
								<div class="form-group w2 hide dhide">
									<label for="date">Type of Leave</label>
									<select name="plan_reason" class="error form-control" id="plan_reason" aria-invalid="true">
										<option value="">Select</option>
										<?php
										foreach ($leaveTypes as $leaveType)
										{?>
										<option value="<?= $leaveType['id']?>"><?= $leaveType['name']?></option>
										<?php }	?>
									</select>  
								</div>
								<div class="form-group w2 w8 hide dhide">
									<label for="date">Reason for Leave</label>
									<textarea class="form-control" name="plan_details" id="plan_details" rows="5"></textarea>
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
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Delete Field</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="col-sm-12 mar-bottom-20">
                                <div class="form-group">
                                    <label for="date">Select Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>ID</th>
                                                <th>Doctors Name</th>
                                                <th>City</th>
                                                <th>Class</th>
                                                <th>Speciality</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>TRZ0001</td>
                                                <td>Doctor</td>
                                                <td>Trichy</td>
                                                <td>A</td>
                                                <td>Nero</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>TRZ0001</td>
                                                <td>Doctor</td>
                                                <td>Trichy</td>
                                                <td>A</td>
                                                <td>Nero</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>TRZ0001</td>
                                                <td>Doctor</td>
                                                <td>Trichy</td>
                                                <td>A</td>
                                                <td>Nero</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6"><button type="submit" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
                            <div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" class="btn blue-btn btn-block">Delete</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pop ends here -->
            <!-- pop starts here -->
            <div class="mfp-hide white-popup-block small_popup" id="copy_plan">
                <div class="popup-content">
                    <div class="popup-header">
                        <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                        <div class="hr-title"><h4>Copy Plan</h4><hr /></div>
                    </div>
                    <div class="popup-body">
                        <div class="row">
                            <div class="copy-from-to-container mar-bottom-20">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date">Copy From</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="copyfrom">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date">Copy To</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="copyto">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="copy-btn-container mar-bottom-20">
                                <div class="col-md-4 col-sm-4 col-xs-4"><button type="submit" class="btn blue-btn btn-block margin-right-35">View Plan</button></div>
                                <div class="col-md-4 col-sm-4 col-xs-4"> <button type="submit" class="btn blue-btn btn-block">Copy Plan</button></div>
                                <div class="col-md-4 col-sm-4 col-xs-4"> <button type="submit" class="btn blue-btn btn-block popup-modal-dismiss">Close</button></div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="col-sm-12 mar-bottom-20">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>ID</th>
                                                <th>Doctor Name</th>
                                                <th>City</th>
                                                <th>Class</th>
                                                <th>Speciality</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>TRZ0001</td>
                                                <td>Doctor</td>
                                                <td>Trichy</td>
                                                <td>A</td>
                                                <td>Nero</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>TRZ0001</td>
                                                <td>Doctor</td>
                                                <td>Trichy</td>
                                                <td>A</td>
                                                <td>Nero</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>TRZ0001</td>
                                                <td>Doctor</td>
                                                <td>Trichy</td>
                                                <td>A</td>
                                                <td>Nero</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <label for="date">From Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="start_date" name="start_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date">To Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="end_date" name="end_date">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6 mar-top-20">
                                    <div class="form-group">
                                        <label for="date">Type of Leave</label>
                                        <select name="plan_reason" class="error form-control" id="plan_reason" aria-invalid="true">
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
                                        <label for="date">Reason for Leave</label>
                                        <textarea class="form-control" rows="5" name="plan_details"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="copy-btn-container mar-bottom-20">
								<input type="hidden" name="work_type_id" value="2">
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
        </div>
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
        <script src="../plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="../plugins/magnific/jquery.magnific-popup.min.js"></script>
        <script src="../plugins/input-mask/jquery.inputmask.js"></script>
        <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
		<style>.fc-content .fc-time{display:none;} .mfp-close{display:none !important;}</style>
        <script>
            $(function () {
                //Date picker
                $('#ModalAddForm #start_date, #ModalEditForm #start_date, #ModalLeaveForm #start_date').datepicker({
                    autoclose: true
                })
                $('#ModalEditForm #end_date, #ModalEditForm #end_date, #ModalLeaveForm #end_date').datepicker({
                    autoclose: true
                })
            });
            $(function () {
                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                });
            });
            $(function () {
                //Date picker
                $('#copyfrom').datepicker({
                    autoclose: true
                });
            });
            $(function () {
                //Date picker
                $('#copyto').datepicker({
                    autoclose: true
                });
            });
            $(function () {
                //Date picker
                $('#fromdate').datepicker({
                    autoclose: true
                });
            });
            $(function () {
                //Date picker
                $('#todate').datepicker({
                    autoclose: true
                });
            });
        </script>
        <script>
            $(function () {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function () {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        });

                    });
                }

                ini_events($('#external-events div.external-event'));

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate(),
                        m = date.getMonth(),
                        y = date.getFullYear();
                $('#calendar').fullCalendar({  // assign calendar

				header: {
					left: 'prev',
					center: 'title',
					right: 'next'
				},
				defaultDate: '2016-01-12',
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				selectable: true,
				selectHelper: true,

				

				events: "../work-plans/mrs_view/",  // request to load current events

				select: function(start, end, jsEvent) {  // click on empty time slot
					$('#ModalAddForm')[0].reset();
					$('#ModalAdd #start_date').val(moment(start).format('YYYY-MM-DD'));
					$('#ModalAdd #end_date').val(moment(start).format('YYYY-MM-DD'));


					$.magnificPopup.open({ items: {src: '#ModalAdd'}, type: 'inline' });

			   },
			   eventRender: function(event, element) { // click on event
					element.bind('click', function() {
						$('#ModalEditForm')[0].reset();
						$('#ModalEdit #id').val(event.id);
						$.ajax({
						 url: '../work-plans/mrs_get_plan/',
						 type: "POST",
						 dataType: "json",
						 data: "id="+event.id+"&action=get_event",
						 success: function(data) {
								if(data.success == '1'){
								$('#ModalEdit #work_type_id').val(data.work_type_id);
								$('#ModalEdit #long_plan').val(data.long_plan);
								$('#ModalEdit #start_date').datepicker("setDate", data.start_date);
								$('#ModalEdit #end_date').datepicker("setDate", data.end_date);
								$('#ModalEdit #city_id').val(data.city_id);
								$('#ModalEdit #doctor_id').val(data.doctor_id);
								$('#ModalEdit #plan_reason').val(data.plan_reason);
								$('#ModalEdit #plan_details').val(data.plan_details);
								var work_type_id = data.work_type_id;
								$("#ModalEdit .dhide").addClass("hide");
								$('#ModalEdit .w'+work_type_id).removeClass("hide");
								$.magnificPopup.open({ items: {src: '#ModalEdit'}, type: 'inline' });
								}
							}
						});
					});
				},			
			   eventDrop: function(event, delta){ // event drag and drop
				   var start=moment(event.start).format('YYYY-MM-DD');
				   var end=moment(event.end).format('YYYY-MM-DD');
				   if(end=="Invalid date")
				   end = start;
				   $.ajax({
					   url: '../work-plans/mrs_drag_drop/',
					   data: 'action=update&start_date='+start+'&end_date='+end+'&id='+event.id,
					   type: "POST",
					   success: function(json) {
					   //alert(json);
					   }
				   });
			   }
			   
			});

               /* ADDING EVENTS */
                
			   $('#addSubmit').on('click', function(e){ // add event submit
				   e.preventDefault();
				   doSubmit(); // send to form submit function
			   });
			   
			   $('#updateSubmit').on('click', function(e){ // add event submit
				   e.preventDefault();
				   updateSubmit(); // send to form submit function
			   });
			   
			   $('#deleteButton').on('click', function(e){ // delete event clicked
				   e.preventDefault();
				   doDelete(); //send data to delete function
			   });

			   $('#leaveSubmit').on('click', function(e){ // delete event clicked
				   e.preventDefault();
				   doLeave(); //send data to delete function
			   });

       

       function doDelete(){  // delete event 
           var eventID = $('#ModalEdit #id').val();
           $.ajax({
               url: '../work-plans/mrs_delete/',
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
               url: '../work-plans/mrs_add/',
               dataType: "json",
               data: $('#ModalAddForm').serialize()+"&action=add",
               type: "POST",
               success: function(json) {
                   $("#calendar").fullCalendar('renderEvent',
                   {
                       id: json.id,
                       title: json.title,
                       start: json.start,
                       end: json.end,
                       color: json.color
                   },
                   true);
                   $.magnificPopup.close();
               }
           });
       }
       
       function doLeave(){ // add event
           $.ajax({
               url: '../work-plans/mrs_add/',
               dataType: "json",
               data: $('#ModalLeaveForm').serialize()+"&action=add",
               type: "POST",
               success: function(json) {
                   $("#calendar").fullCalendar('renderEvent',
                   {
                       id: json.id,
                       title: json.title,
                       start: json.start,
                       end: json.end,
                       color: json.color
                   },
                   true);
                   $.magnificPopup.close();
               }
           });
       }
       
       function updateSubmit(){ // update event
           var eventID = $('#ModalEdit #id').val();
           $.ajax({
               url: '../work-plans/mrs_update/',
               dataType: "json",
               data: $('#ModalEditForm').serialize()+"&action=update_event",
               type: "POST",
               success: function(json) {
				   $("#calendar").fullCalendar('removeEvents',eventID);
                   $("#calendar").fullCalendar('renderEvent',
                   {
                       id: json.id,
                       title: json.title,
                       start: json.start,
                       end: json.end,
                       color: json.color
                   },
                   true);
                   $.magnificPopup.close();
               }
           });
       }
       
       /*Form Events*/
       $( "#ModalAddForm #work_type_id" ).change(function() {
		  var work_type_id = $(this).val();
		  $("#ModalAddForm .dhide").addClass("hide");
		  $("#ModalAddForm .dshow").removeClass("hide");
		  
		  $('#ModalAddForm .w'+work_type_id).removeClass("hide");
		  $("#ModalAddForm .xw"+work_type_id).addClass("hide");
		});
		
       $( "#ModalEditForm #work_type_id" ).change(function() {
		  var work_type_id = $(this).val();
		  $("#ModalEditForm .dhide").addClass("hide");
		  $("#ModalEditForm .dshow").removeClass("hide");
		  
		  $('#ModalEditForm .w'+work_type_id).removeClass("hide");
		  $("#ModalEditForm .xw"+work_type_id).addClass("hide");
		});

			   
			   /*$("#ModalAddForm").validate({
					 ignore: ":hidden",
					 submitHandler: function (form) {
						 $.ajax({
							 type: "POST",
							 url: "formfiles/submit.php",
							 data: $(form).serialize(),
							 success: function () {
								 $(form).html("<div id='message'></div>");
								 $('#message').html("<h2>Your request is on the way!</h2>")
									 .append("<p>someone</p>")
									 .hide()
									 .fadeIn(1500, function () {
									 $('#message').append("<img id='checkmark' src='images/ok.png' />");
								 });
							 }
						 });
						 return false; // required to block normal submit since you used ajax
					 }
				 });*/
       
       
            });
        </script>
        <script>
            $('.popup-modal').magnificPopup({
                type: 'inline',
                preloader: false,
                modal: true
            });
            $(document).on('click', '.popup-modal-dismiss', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });
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
    </body>
</html>
