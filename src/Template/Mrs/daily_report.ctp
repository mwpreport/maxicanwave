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
				<?php
				
				?>
                <div class="clearfix"></div>
                <div class="daily-report-radio-cnt">
						<div class="col-md-12 mar-bottom-20">
							<div class="row">
							<?php $reportDate = ""; if($date!="") $reportDate = date("Y-m-d", strtotime($date));?>
							<form action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "finalSaveDailyReport",'?' => ['date' => $reportDate]])?>" method="post" >
								<div class="form-group">
									<div class="col-sm-3">
										<h3 class="mar-top-10 mar-bottom-20">Select Date</h3>
									</div>
									<div class="col-sm-3">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" name="reportDate" id="reportDate" value="<?php echo $reportDate;?>">
										</div>
									</div>
									<div class="col-sm-6">
									 <div class="col-sm-6"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewDailyReport",'?' => ['date' => $reportDate]])?>" class="btn btn-block margin-right-35"><b>View Reported Calls</b></a></div>
									 <div class="col-sm-6"><button class="btn blue-btn btn-block margin-right-35 pull-right" type="submit">Final Submit</a></div>
									</div>
									<!-- /.input group -->
								</div>
							</div>
						</form>
						</div>
						<?php if($date!=""){?>
						<div class="col-sm-12 mar-bottom-20">
							<ul>
								<li class="col-md-12"><h3 class="mar-top-20 mar-bottom-20">Type of Work</h3></li>
								<li class="col-md-3"><input type="radio" name="workType" id="workType_2" value="2"><label for="workType_2"><span></span>Field Work</label></li>
								<?php foreach ($workTypes as $workType){?>
									<li class="col-md-3"><input type="radio" name="workType" id="workType_<?php echo $workType->id?>" value="<?php echo $workType->id?>"><label for="workType_<?php echo $workType->id?>"><span></span><?php echo $workType->name;?></label></li>
								<?php $workTypePlans[$workType->id]=[];}?>
								<li class="col-md-3"><input type="radio" name="workType" id="workType_1" value="1"><label for="workType_1"><span></span>Leave</label></li>
							</ul>
							<div class="clearfix"></div><hr />
						</div>
						<?php }?>
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20 hide" id="workType_section_2">
							<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
							<input type="hidden" value="<?php echo $reportDate;?>" name="reportDate">
								<div class="col-md-12 mar-bottom-20">
									<?php
									$html = "";
									if(count($WorkPlansD))
									{
									}
									?>
									<?php if(count($WorkPlansD)<1){?>
									<div class="table-responsive">
										<p>No Planned Doctors on this date</p>
									</div>
									<?php }else {?>
									<div class="table-responsive">
										<h3 class="mar-top-10 mar-bottom-10">Planned Doctors</h3>
										<table id="doctors_table" class="table table-striped table-bordered table-hover">
											<thead><tr><th width=""><input type="checkbox" class="check_all" onclick="toggleCheck(this)" value="1"></th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Products</th></tr></thead>
											<tbody>
										<?php
										$work_with = '<select name="work_with[%s]"><option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option></select>';
										foreach ($WorkPlansD as $WorkPlanD)
										{
											
											$work_with_selected = str_replace("<option>".$WorkPlanD->work_with."</option>","<option selected>".$WorkPlanD->work_with."</option>",$work_with);
											$products_array = array();
											if($WorkPlanD->products!="")
											$products_array = unserialize($WorkPlanD->products);
											$sample_products =array();
											foreach($products as $product)
											if (in_array($product->id, $products_array)) $sample_products[]= $product->name;
											?>
											<tr class="<?=(($WorkPlanD->is_reported)?"reported":"")?> <?=(($WorkPlanD->is_missed)?"missed":"")?>">
											<td>
												<input type="checkbox" <?=(($WorkPlanD->is_missed)?"disabled":"")?> class="workplan_id" name="workplan_id[<?=$WorkPlanD->id?>]" value="<?=$WorkPlanD->id?>">
											</td>
											<td><?=$WorkPlanD->doctor->name?></td>
											<td><?=$WorkPlanD->city->city_name?></td>
											<td><?=str_replace("%s",$WorkPlanD->id,$work_with_selected)?></td>
											<td>
												<?php 
													if(count($sample_products)>0) {echo  implode(", ",$sample_products);}
												?>
												<br><a href="#doctor_product_<?=$WorkPlanD->id?>" id="pdt_link_<?=$WorkPlanD->id?>" class="popup-modal">Detail Reporting</a>
											</td>
											</tr>
										<?php }?>
										</tbody></table>

									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" name="SubmitSave" id="w2SubmitSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="button" name="SubmitMissed" id="w2SubmitMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" name="SubmitRemove" id="w2SubmitRemove">Remove Visit List</button>
												</div>
											</div>
										</div>
									</div>
									<?php }?>
								</div>
							
								<div class="col-md-12 mar-bottom-20">
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<hr>
											<div class="form-group  mar-top-10">
												<div class="col-sm-3">
													<a  href="#UnplannedAdd" class="popup-modal common-btn blue-btn pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Unplanned Doctors</a>
												</div>
												<div class="col-sm-3">
													<a  href="#ChemistAdd" class="popup-modal common-btn blue-btn pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Chemists</a>
												</div>
												<div class="col-sm-3">
													<a  href="#StockistAdd" class="popup-modal common-btn blue-btn pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Stockists</a>
												</div>
												<div class="col-sm-3">
													<a  href="#PGOthers" class="popup-modal common-btn blue-btn pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> PG & Others</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							</div>
							<?php
							foreach ($WorkPlans as $WorkPlan)
							{
								$workTypePlans[$WorkPlan->work_type_id][] = $WorkPlan;
							}
							?>
							<?php foreach ($workTypes as $workType){?>
							<div class="col-sm-12 mar-bottom-20 hide" id="workType_section_<?php echo $workType->id?>">
								<div class="col-md-12 mar-bottom-20">
									<?php 
										$html = "";
										if(count($workTypePlans[$workType->id]))
										{
											$html.='<h3 class="mar-top-10 mar-bottom-10">Planned '.$workType->name.'</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width=""><input type="checkbox" class="check_all" onclick="toggleCheck(this)" value="1"></th><th>Work Type</th><th>City</th></thead><tbody>';
											foreach ($workTypePlans[$workType->id] as $workTypePlan)
											{
												$html.='<tr class="'.(($workTypePlan->is_reported)?"reported":"").' '.(($workTypePlan->is_missed)?"missed":"").' "><td><input type="checkbox" '.(($workTypePlan->is_missed)?"disabled":"").' name="workplan_id['.$workTypePlan->id.']" value="'.$workTypePlan->id.'"></td><td>'.$workTypePlan->work_type->name.'</td><td>'.$workTypePlan->city->city_name.'</td></tr>';
											}
											$html.='</tbody></table>';
										}
									?>
									<?php if($html == ""){?>
									<div class="table-responsive">
										<p>No Planned <?php echo $workType->name?> on this date</p>
									</div>
									<?php }else {?>
									<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
									<input type="hidden" value="<?php echo $reportDate;?>" name="reportDate">
									<div class="table-responsive">
										<?php echo $html;?>
									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" name="SubmitSave" id="w<?php echo $workType->id?>SubmitSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" name="SubmitMissed" id="w<?php echo $workType->id?>SubmitMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" name="SubmitRemove" id="w<?php echo $workType->id?>SubmitRemove">Remove Visit List</button>
												</div>
											</div>
										</div>
									</div>
									</form>
									<?php }?>
								</div>
								<div class="col-md-12 mar-bottom-20">
								<hr />
									<form class="workplanForm" id="<?php echo $workType->name?>AddForm" method="POST" >
										<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
										<input type="hidden" name="work_type_id" value="<?php echo $workType->id?>">
										<div class="row">
											<div class="form-group">
												<div class="col-sm-12 mar-bottom-20">
													<div class="col-md-6 col-sm-6 col-xs-6 form-group">
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
													<div class="col-md-4 col-sm-4 col-xs-4">
														<label>&nbsp;</label>
														<button type="submit" class="btn blue-btn btn-block margin-right-35"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add <?php echo $workType->name?></button>
													</div>
												</div>
												<!-- /.input group -->
											</div>
										</div>
									</form>
								</div>
							</div>
							<?php }?>
							<div class="col-sm-12 mar-bottom-20 hide" id="workType_section_1">
								<div class="col-md-12 mar-bottom-20">
									<?php 
										$html = "";
										if(count($workTypePlans[1]))
										{
											$html.='<h3 class="mar-top-10 mar-bottom-10">Planned Leave</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width=""><input type="checkbox" name="check_all" value="1"></th><th>Work Type</th><th>On</th></thead><tbody>';
											foreach ($workTypePlans[1] as $workTypePlan)
											{
												$html.='<tr class="'.(($workTypePlan->is_reported)?"reported":"").' '.(($workTypePlan->is_missed)?"missed":"").' "><td><input type="checkbox" '.(($workTypePlan->is_missed)?"disabled":"").' name="workplan_id['.$workTypePlan->id.']" value="'.$workTypePlan->id.'"></td><td>'.$workTypePlan->work_type->name.'</td><td>'.$reportDate.'</td></tr>';
											}
											$html.='</tbody></table>';
										}
									?>
									<?php if($html == ""){?>
									<div class="table-responsive">
										<p>No Planned Leave on this date</p>
									</div>
									<?php }else {?>
									<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
									<input type="hidden" value="<?php echo $reportDate;?>" name="reportDate">
									<div class="table-responsive">
										<?php echo $html;?>
									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" value="w1SubmitSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" value="w1SubmitMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="submit" value="w1SubmitRemove">Remove Visit List</button>
												</div>
											</div>
										</div>
									</div>
									</form>
									<?php }?>
								</div>
								<div class="col-md-12 mar-bottom-20">
								<hr />
									<form class="workplanForm" id="LeaveAddForm" method="POST" >
										<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
										<input type="hidden" name="work_type_id" value="1">
										<div class="row">
											<div class="form-group">
												<div class="col-sm-12 mar-bottom-20">
													<div class="col-md-6 col-sm-6 col-xs-6 form-group">
														<label>&nbsp;</label>
														<button type="submit" class="btn blue-btn btn-block margin-right-35"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Leave</button>
													</div>
												</div>
												<!-- /.input group -->
											</div>
										</div>
									</form>
								</div>
							</div>

						</div>
						
						</div>
					<!--
					<hr>
					<table border=0 cellpadding="5" cellspacing="5">
					<tr class="reported"><td>Saved Reports</td></tr>
					<tr class="reported unplanned"><td>Saved Reports (Unplanned Doctors)</td></tr>
					</table>
					-->

            </div>
        </section>
		<?php if($date!=""){?>
		<!-- pop starts here -->
		<div class="mfp-hide white-popup-block small_popup" id="UnplannedAdd">
			<div class="popup-content">
				<form class="" id="UnplannedAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="2">
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss add-form"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Doctors</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group col-sm-4">
								<label for="city_id">City</label>
								<select name="city_id" onchange="loadDoctors(this.form.id)" class="form-control required" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group col-sm-4">
								<label for="doctor_id">Select Doctor</label>
								<select name="doctor_id[]" class="form-control required" id="doctor_id" aria-invalid="true">
								<option value="">Select Doctors</option>
									<?php
									if(count($doctorsRelation)>0)
									foreach ($doctorsRelation as $doctor)
									{?>
									<option value="<?= $doctor['doctor_id']?>"><?= $doctor->doctor->name?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group col-sm-4">
								<label for="work_with">Work With</label>
								<select name="work_with" class="form-control required" id="work_with" aria-invalid="true">
								<option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option> 
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="UnplannedSubmit" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block small_popup" id="ChemistAdd">
			<div class="popup-content">
				<form class="" id="ChemistAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Chemists</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group col-sm-6">
								<label for="city_id">City</label>
								<select name="city_id" onchange="loadChemists(this.form.id)" class="form-control required" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group col-sm-6">
								<label for="chemist_id">Select Chemists</label>
								<select name="chemist_id[]" class="form-control required" id="chemist_id" aria-invalid="true">
								<option value="">Select Chemists</option>
									<?php
									foreach ($chemists as $chemist)
									{?>
									<option value="<?= $chemist->id?>"><?= $chemist->name?></option>
									<?php }	?>
								</select>  
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="ChemistSubmit" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block small_popup" id="StockistAdd">
			<div class="popup-content">
				<form class="" id="StockistAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add Stockists</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group col-sm-6">
								<label for="city_id">City</label>
								<select name="city_id" class="form-control required" onchange="loadStockists(this.form.id)" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group col-sm-6">
								<label for="stockit_id">Select Stockists</label>
								<select name="stockist_id[]" class="form-control required" id="stockist_id" aria-invalid="true">
								<option value="">Select Stockists</option>
									<?php
									foreach ($stockists as $stockist)
									{?>
									<option value="<?= $stockist->id?>"><?= $stockist->name?></option>
									<?php }	?>
								</select>  
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="StockistSubmit" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block large_popup doctor_product" id="PGOthers">
			<div class="popup-content">
				<form class="" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAddPgoReport"])?>" id="PGOAddForm" method="POST" >
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Add PG & Others</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group col-sm-6">
								<label for="city_id">Doctor Name</label>
								<input type="text" name="name" id="name" class="form-control required">
							</div>
							<div class="form-group col-sm-6">
								<label for="city_id">City</label>
								<select name="city_id" class="form-control required" onchange="loadStockists(this.form.id)" id="city_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($cities as $citiy)
									{?>
									<option value="<?= $citiy['id']?>" <?= ($citiy['id']==$userCity	) ? "selected" : "";?>><?= $citiy['city_name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group col-sm-6">
								<label for="speciality_id">Speciality</label>
								<select name="speciality_id" class="form-control required" onchange="loadStockists(this.form.id)" id="speciality_id" aria-invalid="true">
									<option value="">Select</option>
									<?php
									foreach ($specialities as $speciality)
									{?>
									<option value="<?= $speciality['id']?>" ><?= $speciality['name']?></option>
									<?php }	?>
								</select>  
							</div>
							<div class="form-group col-sm-6">
								<label for="work_with">Work With</label>
								<select name="work_with" class="form-control required" id="work_with" aria-invalid="true">
									<option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option> 
								</select>
							</div>
						</div>
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group col-sm-12">
								<h4>Products To be detailed(Check given products and its quantity) :</h4>
								<ul>
								<?php
								$products_array = array();
								foreach($products as $product)
								{?>
									<li class="col-sm-6">
									<label class="col-sm-6"> <input type="checkbox"  name="products[]" value="<?=$product->id?>"> <?= $product->name?></label>
									<label> <input type="text"  name="products_qty[]" value=""></label>
									</li>
								<?php }?>
								</ul>
							</div>
							<div class="form-group col-sm-6">
								<label class="col-sm-6">Discussion</label>
								<textarea name="discussion"></textarea>
							</div>
							<div class="form-group col-sm-6">
								<div class="col-sm-6">
								<label>Visit Time</label>
								<input type="text" name="visi_time" value=""><br>
								</div>
								<div class="col-sm-6">
								<label>Doctor Business</label>
								<input type="text" name="business" value="">
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="PGOSubmit" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block small_popup" id="DoctorsMissed">
			<div class="popup-content">
				<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportMissed"])?>" id="DoctorsMissedForm">
				<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="2">
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss" onclick="reset_missed_form()"><span>&times;</span></button>
					<div class="hr-title"><h4>Missed Calls</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<?php
						$html = "";
						if(count($WorkPlansD))
						{
							$is_missed = '<select name="missed_reason[%s]" class="form-control required"><option value="">Select</option><option>Doctor Refused Appointment</option><option>Doctor on Leave</option><option>Doctor not in Station</option><option>Plan Changed</option><option>Meeting / CME</option><option>Others</option></select>';
							$html.='<table id="missed_doctors_table" class="table table-striped table-bordered"><thead><tr><th>Doctor Name</th><th>Reason</th><th>Date</th></tr></thead><tbody>';
							foreach ($WorkPlansD as $WorkPlanD)
							{
								$html.='<tr style="display:none" id="missed_'.$WorkPlanD->id.'"><td><input type="checkbox" class="hide" id="m_workplan_id_'.$WorkPlanD->id.'" name="m_workplan_id['.$WorkPlanD->id.']" value="'.$WorkPlanD->id.'"><h4>'.$WorkPlanD->doctor->name.'</h4></td><td>'.str_replace("%s",$WorkPlanD->id,$is_missed).'<br><label><input type="checkbox" id="m_cancel_plan_'.$WorkPlanD->id.'" name="m_cancel_plan['.$WorkPlanD->id.']" value="'.$WorkPlanD->id.'"> Check if you cannot plan this month</label></td><td><input class="form-control required" type="text" id="alt_date_'.$WorkPlanD->id.'" name="alt_date['.$WorkPlanD->id.']"></td></tr>';
							}
							$html.='</tbody></table>';
						}
						?>
						<?php if($html == ""){?>
						<div class="table-responsive">
							<p>No Planned Doctors on this date</p>
						</div>
						<?php }else {?>
						<div class="table-responsive">
							<?php echo $html;?>
						</div>
						<?php }?>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" onclick="reset_missed_form()" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="SubmitMissed" name="SubmitMissed" class="btn blue-btn btn-block">Save</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<a href="#DoctorsMissed" id="DoctorsMissedLink" class="hide popup-modal">Missed Doctors</a>
		
		<?php
		if(count($WorkPlansD))
		{
			foreach ($WorkPlansD as $WorkPlanD)
			{?>
			<div class="mfp-hide white-popup-block large_popup doctor_product" id="doctor_product_<?=$WorkPlanD->id?>">
				<div class="popup-content">
					<form class="" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>" class="ProductForm" method="POST" id="doctor_product_<?=$WorkPlanD->id?>Form" >
					<input type="hidden" name="start_date" value="<?php echo $reportDate;?>">
					<input type="hidden" name="work_type_id" value="2">
					<input type="hidden" name="workplan_id['<?=$WorkPlanD->id?>']" value="<?=$WorkPlanD->id?>">
					<div class="popup-header">
						<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
						<div class="hr-title"><h4>Add Stockists</h4><hr /></div>
					</div>
					<div class="popup-body">
						<div class="row">
							<div class="col-sm-12 mar-bottom-20">
								<div class="form-group col-sm-6">
									<label>Doctor Name : <?= $WorkPlanD->doctor->name?></label>
								</div>
								<div class="form-group col-sm-6">
									<label>Doctor Speciality : <?= $WorkPlanD->doctor->speciality->name?></label>
								</div>
								<div class="form-group col-sm-12">
									<label>Products To be detailed(Check given products and its quantity) :</label>
								</div>
							</div>
							<div class="col-sm-12 mar-bottom-20">
								<div class="form-group col-sm-12">
									<h4>Products To be detailed(Check given products and its quantity) :</h4>
									<ul>
									<?php
									$products_array = array();
									if($WorkPlanD->products!="")
									$products_array = unserialize($WorkPlanD->products);
									$sample_products =array();
									foreach($products as $product)
									{?>
										<li class="col-md-6">
											<?php
											if (in_array($product->id, $products_array)){
											$sample_products[$product->id]= $product->name;
											?>
											<label class="col-sm-6"> <input type="checkbox"  name="products[<?=$WorkPlanD->id?>]" checked class="products_<?=$WorkPlanD->id?>" value="<?=$product->id?>"> <?= $product->name?></label>
											<?php }else { ?>
											<label class="col-sm-6"> <input type="checkbox"  name="products[<?=$WorkPlanD->id?>]" value="<?=$product->id?>"> <?= $product->name?></label>
											<?php }?>
											<label> <input type="text"  name="products_qty[<?=$WorkPlanD->id?>]" value=""></label>
										</li>
									<?php }?>
									</ul>
								</div>
								<div class="form-group col-sm-6">
									<label class="col-sm-6">Discussion</label>
									<textarea name="discussion"></textarea>
								</div>
								<div class="form-group col-sm-6">
									<div class="col-sm-6">
									<label>Visit Time</label>
									<input type="text" name="visi_time" value=""><br>
									</div>
									<div class="col-sm-6">
									<label>Doctor Business</label>
									<input type="text" name="business" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="submit" name="SubmitSave" class="btn blue-btn btn-block">Save</button></div>
					</div>
					</form>
					</div>
			</div>
			<?php }
		}?>
		<?php }?>
    </div>
    <!-- /.content -->
</div>
<script>

	//Date for the calendar events (dummy data)
	var date = new Date(), y = date.getFullYear(), m = date.getMonth(), d = date.getDate();
	var startDate = new Date(y, m, 1);
	var endDate = new Date(y, m + 1, 0);

	//Date picker
	$('#reportDate').datepicker({
		autoclose: true, startDate: startDate, endDate: endDate
	});
	$('#missed_doctors_table [type="text"]').datepicker({
		autoclose: true, startDate: new Date(y, m, d + 1), endDate: endDate
	});

	$('#reportDate').on('changeDate', function (ev) {
		window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport"])?>?date="+moment(ev.date).format('YYYY-MM-DD'));
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
	
	$("#UnplannedAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#UnplannedAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("#ChemistAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#ChemistAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("#StockistAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#StockistAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("#DoctorsMissedForm").validate({
		ignore: ":hidden"
		
	});

	$("input[id^='workType_']").click(function(){
		if ($(this).is(':checked'))
		{
			$("div[id^='workType_section_']").addClass("hide");
			$("#workType_section_"+$(this).val()).removeClass("hide");
			$('input[type="checkbox"]').prop('checked', false);
		}
	});
	
	$("#w2SubmitMissed").click(function(){
		$('#DoctorsMissedForm')[0].reset();
		if ($('input[type="checkbox"].workplan_id').is(':checked'))
		{
			var yourArray = [];
			$('input[type="checkbox"].workplan_id:checked').each(function(){
				$('#missed_'+$(this).val()).show();
				$('#m_workplan_id_'+$(this).val()).prop('checked', true);
			});
			$('#DoctorsMissedLink').click();
		}
		else{
			alert("Please check a Doctor");
		}
	});
	
	$("input[id^='m_cancel_plan_']").click(function(){
		if ($(this).is(':checked'))
		{
			$("#alt_date_"+$(this).val()).addClass("hide");
			$("#alt_date_"+$(this).val()+"-error").addClass("hide");
		}
		else
		{
			$("#alt_date_"+$(this).val()).removeClass("hide");
			$("#alt_date_"+$(this).val()+"-error").removeClass("hide");
		}
	});
  
	function reset_form(){
		$('#StockistAddForm, #ChemistAddForm, #UnplannedAddForm')[0].reset();
	}
	function reset_missed_form(){
		$("tr[id^='missed_']").hide();
		$('#DoctorsMissedForm')[0].reset();
		$('#DoctorsMissedForm input[type="checkbox"]').prop('checked', false);
	}
	
	function toggleCheck(elem)
	{
		if($(elem).prop("checked") == true)
		$(elem).closest("form").find("input:checkbox").prop('checked', true);
		else
		$(elem).closest("form").find("input:checkbox").prop('checked', false);
	}
	
	function productShow(id){
		var str = ""; var i=0;
		$('input[type="checkbox"].products_'+id+':checked').each(function () {
		if(i>0) str += ", ";
		str += $(this).val();
		i++;
		});
		if(str != "")
		{$("#pdt_link_"+id).html(str);$("#pdt_val_"+id).val($("#products_"+id).val());}
		else
		{$("#pdt_link_"+id).html("Select Products");}
	}

	function loadDoctors(id){
		var city_id = $('#'+id+' #city_id').val();
		var start_date = $('#'+id+' #start_date').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetDoctors"])?>',
			   data: "city_id="+city_id+"&start_date="+start_date,
			   type: "POST",
			   success: function(json) {
				   $('#doctor_id').html(json);
			   }
		});
	}

	function loadChemists(id){
		var city_id = $('#'+id+' #city_id').val();
		var start_date = $('#'+id+' #start_date').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetChemists"])?>',
			   data: "city_id="+city_id+"&start_date="+start_date,
			   type: "POST",
			   success: function(json) {
				   $('#chemist_id').html(json);
			   }
		});
	}

	function loadStockists(id){
		var city_id = $('#'+id+' #city_id').val();
		var start_date = $('#'+id+' #start_date').val();
		$.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "Mrs","action" => "reportGetStockists"])?>',
			   data: "city_id="+city_id+"&start_date="+start_date,
			   type: "POST",
			   success: function(json) {
				   $('#stockist_id').html(json);
			   }
		});
	}

	function doSubmit(form){ // add event
	   $.ajax({
		   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsAddReport"])?>',
		   dataType: "json",
		   data: $(form).serialize()+"&action=add",
		   type: "POST",
		   success: function(json) {
			   if(json.status == 1)
			   {	
					window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport"])?>/?date=<?php echo $reportDate;?>");			   
					$.magnificPopup.close();
			   }
			   else
			   {
					alert(json.msg);
			   }
		   }
	   });
	}
	
	function doDelete(eventID){  // delete event 
		if (confirm("Are you sure on deleting this?"))
		{
		   $.ajax({
			   url: '<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsDeleteReport"])?>',
			   dataType: "json",
			   data: 'action=delete&id='+eventID,
			   type: "POST",
			   success: function(json) {
				   if(json.status == 1)
					{
						window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReport"])?>/?date=<?php echo $reportDate;?>");			   
					}
				   else
						alert(json.msg);
			   }
		   });
		}
	}


</script>
