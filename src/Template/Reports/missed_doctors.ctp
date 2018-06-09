<?php ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <div class="content">
                    <section>
                        <div class="white-wrapper small">
                            <div class="col-md-12">
                                <div class="hr-title">
                                    <h2>Doctors Visited (<?=$month?>)<span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "index"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                                    <hr>
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
                                                    <th>City</th>
                                                    <th>Role</th>
                                                    <th>Visited</th>
                                                    <th>Missed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<td>1</td>
												<td><?= "Mr. ".$user->firstname." ".$user->lastname?></td>
												<td><?=$user->city->city_name?></td>
												<td><?=$user->role->code?></td>
												<td><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "visitedDoctorsList"])?>"><?=count($visited)?></a></td>
												<td><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "missedDoctorsList"])?>"><?=count($missed)?></a></td>
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

