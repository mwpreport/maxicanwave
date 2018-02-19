<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
						<?php $reportDate = ""; if($date!="") $reportDate = date("Y-m-d", strtotime($date));?>
                        <h2>Daily Report of <?= $reportDate?></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="daily-report-radio-cnt">
					<div class="table-responsive" id="report_section">
						<?= $html?>
					</div>
                </div>

            </div>
        </section>


    </div>
    <!-- /.content -->
</div>
