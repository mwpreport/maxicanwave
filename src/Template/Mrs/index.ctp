<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?=number_format($doctorsAvarage,2)?><sup style="font-size: 20px">%</sup></h3>

                        <p>Doctor Call Average</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyReport"])?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?=number_format($chemistAvarage,2)?><sup style="font-size: 20px">%</sup></h3>

                        <p>Chemist Call Average</p>
                    </div>
                    <div class="icon">
                       <i class="fa fa-plus-square" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "dailyReport"])?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?=$doctorsCoverage?></h3>

                        <p>Doctor Coverage</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "doctorVisit"])?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">

                <!-- Calendar -->
                <div class="box box-solid bg-white-gradient">
                    <div class="box-header">
                        <i class="fa fa-calendar"></i>

                        <h3 class="box-title">Calendar</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "monthlyplan"])?>" class="btn btn-sm">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<script>
    //The Calender
    var dates = [<?=implode(",",$reportedDates)?>]
    $('#calendar').datepicker({
        multidate: true,
        beforeShowDay: function(date) {
		   for (var i = 0; i < dates.length; i++) {
            if (new Date(dates[i]).toString() == date.toString()) {              
                  return {classes: 'highlight', tooltip: 'Reported'};
                  }
          }
    }
    });
</script>