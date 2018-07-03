<?php ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="iframe-wrapper">
                <!-- Main content -->
                <div class="content">
                    <section>
                        <div class="white-wrapper small">
                            <div class="col-md-12">
                                <div class="hr-title">
                                    <?php $reported_months = array_keys($visits);?>
                                    <h2>Doctor Visit Report <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "doctorVisit"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                                    <hr>
                                    <h4>History Report details for <span class="uppercase"><?php echo "Mr. ".$user->firstname." ".$user->lastname?></span> (<?= current($reported_months)?> - <?= end($reported_months)?>)</h4>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </section>
                   
                    
                    <section>
                        <div class="row" id="report_section">
                            <div class="col-xs-12">
                                <div class="white-wrapper mar-top-20">
                                    <!-- /.box-header -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Spec</th>
                                                    <th>Class</th>
                                                    <th>City</th>
                                                    <?php foreach($reported_months as $reported_month){?>
													<th><?php echo $reported_month?></th>
                                                    <?php }?>
                                                    <th>Total Visit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$i =1;
                                            foreach ($doctors as $doctor)
											{
											$total = 0;
											?>
											<tr>
											<td><?=$i?></td>
											<td><?=$doctor->doctor->name?></td>
											<td><?=$doctor->doctor->speciality->code?></td>
											<td><?=$class[$doctor->doctor->class]?></td>
											<td><?=$doctor->doctor->city->city_name?></td>
											<?php foreach($reported_months as $reported_month){ $total+=(!empty($visits[$reported_month][$doctor->doctor_id]))?count(explode("/",$visits[$reported_month][$doctor->doctor_id])):0;?>
											<th><?php echo $visits[$reported_month][$doctor->doctor_id]?></th>
											<?php }?>
											<td><?php echo $total?></td>
											</tr>
										<?php $i++;}?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </section>
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

