<?php ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="<?=$wrapper?>-wrapper">
                <!-- Main content -->
                <div class="content">
                    <section>
                        <div class="white-wrapper">
                            <div class="col-md-12">
                                <div class="hr-title">
                                    <h2><?=str_replace("_"," ",$filter)?> of <?=$month?> <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "plan"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!--<form>
                                <div class="form-group mar-bottom-40">
                                    <div class="col-sm-12">
                                        <div class="radio-blk">
                                            <label for="exampleInputClass" class="gray-txt">Select Class of Doctor</label>
                                            <input type="radio" name="UserType" id="square-account" value="square-account" checked="checked"><label for="square-account"><span></span>A</label>
                                            <input type="radio" name="UserType" id="swipe-account" value="swipe-account"><label for="swipe-account"><span></span>B</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mar-bottom-40">
                                    <div class="col-sm-6">
                                        <select name="Country" class="error form-control" id="Country" aria-invalid="true">
                                             <option value="0">Select Month</option>
                                            <option value='2'>Janaury</option>
                                            <option value='2'>February</option>
                                            <option value='3'>March</option>
                                            <option value='4'>April</option>
                                            <option value='5'>May</option>
                                            <option value='6'>June</option>
                                            <option value='7'>July</option>
                                            <option value='8'>August</option>
                                            <option value='9'>September</option>
                                            <option value='10'>October</option>
                                            <option value='11'>November</option>
                                            <option value='12'>December</option>
                                        </select>  
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="Country" class="error form-control" id="Country" aria-invalid="true">
                                            <option value="0">Select Year</option>
                                            <option value="1">2017</option>
                                            <option value="2">2018</option>
                                        </select>  
                                    </div>
                                </div>
                              
                                
                                <div class="form-group pull-right">
                                    <div class="col-sm-12">
                                        <a href="" class="common-btn blue-btn btn-125">Submit</a>
                                    </div>
                                </div>
                            </form>-->
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
                                                    <th>ID</th>
                                                    <th>Doctor Name</th>
                                                    <th>Speciality</th>
                                                    <th>Class</th>
                                                    <th>City</th>
                                                    <?php if($filter != "Un-Planned_Doctors"){?>
                                                    <th>Planned Visit</th>
                                                    <th>Total Visit</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$i =1;
                                            foreach ($doctors as $doctor)
											{
												if($filter == "Doctor_Wise_Plan") {if(empty($visits[$doctor->doctor_id])) continue;}
												elseif($filter == "Un-Planned_Doctors") {if(!empty($visits[$doctor->doctor_id])) continue;}
											?>
											<tr class="<?=(empty($visits[$doctor->doctor_id]))?"unplanned":""?>">
											<td><?=$i?></td>
											<td><?=$doctor->doctor->code?></td>
											<td><?=$doctor->doctor->name?></td>
											<td><?=$doctor->doctor->speciality->code?></td>
											<td><?=$class[$doctor->doctor->class]?></td>
											<td><?=$doctor->doctor->city->city_name?></td>
											<?php if($filter != "Un-Planned_Doctors"){?>
											<td><?=$visits[$doctor->doctor_id]?></td>
											<td><?=(!empty($visits[$doctor->doctor_id]))?count(explode("/",$visits[$doctor->doctor_id])):0?></td>
											<?php }?>
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

