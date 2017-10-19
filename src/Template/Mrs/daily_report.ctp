<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Daily Report</h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="daily-report-radio-cnt">
                    <div class="col-md-6 mar-bottom-20">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <h3 class="mar-top-10 mar-bottom-20">Select Date</h3>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    <form>
                        <ul>
                            <li class="col-md-12"><h3 class="mar-top-20 mar-bottom-20">Type of Work</h3></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>Field</label></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>On Leave</label></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>Quartely Meeting</label></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>CME / Symposium</label></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>Induction / Training</label></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>Transit</label></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>Review Meeting</label></li>
                            <li class="col-md-3"><input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>Others</label></li>
                        </ul>
                    </form>
                    <div class="clearfix"></div>

                    <div class="center-button-container">
                        <div class="row">
                            <div class="form-group  mar-top-30">
                                <div class="col-sm-6">
                                    <a href="" class="common-btn blue-btn pull-left">Submit</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="" class="common-btn blue-btn pull-right">View Reported Calls</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <!-- /.content -->
</div>