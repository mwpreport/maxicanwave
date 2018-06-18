<?php ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <div class="content">
                    <section>
                        <div class="white-wrapper small">
                            <div class="col-md-12">
                                <div class="hr-title">
                                    <h2>Attendence Report (<?=$month?>)<span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "index"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                                    <hr>
                                    <h3><?php echo "Mr. ".$user->firstname." ".$user->lastname." | ".$user->city->city_name." | ".$user->role->code?></h3>
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
                                        <?php
                                        foreach ($workPlansDate as $date=>$status)
										{?>
											<div class="at_box">
												<p class="at_date"><?= date("d", strtotime($date))?></p>
												<p class="at_status"><?= $status?></p>
											</div>
										<?php }?>
                                    </div>
                                    
                                    <p>P - Present, L - Leave, PH - Public Hoiday, S - Sunday, ? - Not Reported </p>
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

