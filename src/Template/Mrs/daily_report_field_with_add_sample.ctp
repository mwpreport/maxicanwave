<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
						<?php $reportDate = ($date!="")?date("Y-m-d", strtotime($date)):"";?>
                        <h2>Daily Report of <?= ($date!="")?date("Y-m-d (l)", strtotime($date)):"" ?></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="daily-report-radio-cnt">
						<div class="col-md-12 mar-bottom-20">
							<div class="row">
							<form action="<?php echo $this->Url->build(["controller" => "Mrs","action" => "finalSubmitReport",'?' => ['date' => $reportDate]])?>" method="post" >
								<div class="form-group">
									<div class="col-sm-6">
									 <input type="hidden" class="form-control pull-right" name="reportDate" id="reportDate" value="<?php echo $reportDate;?>">
									 <div class="col-sm-6"><a href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "viewDailyReport",'?' => ['date' => $reportDate]])?>" class="btn blue-btn btn-block margin-right-35" target="blank"><b>View Reported Calls</b></a></div>
									 <div class="col-sm-6"><button class="btn blue-btn btn-block margin-right-35 pull-right" type="submit">Final Submit</a></div>
									</div>
									<!-- /.input group -->
								</div>
							</div>
						</form>
						</div>
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20" id="workType_section_2">
							<form method="post" action="<?php echo $this->Url->build(["controller" => "WorkPlans","action" => "mrsReportUpdate"])?>">
							<input type="hidden" value="<?php echo $reportDate;?>" name="reportDate">
								<div class="col-md-12 mar-bottom-20">
									<?php if(count($WorkPlansD)<1){?>
									<div class="table-responsive">
										<p>No Planned Doctors on this date</p>
									</div>
									<?php }else {?>
									<div class="table-responsive">
										<h3 class="mar-top-10 mar-bottom-10">Planned Doctors</h3>
										<table id="doctors_table" class="table table-striped table-bordered table-hover">
											<thead><tr><th width=""><input type="checkbox" class="check_all" onclick="toggleCheck(this)" value="1"></th><th>Doctor Name</th><th>Class</th><th>Spe</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Gifts</th><th>Visit Time</th><th>Business</th></tr></thead>
											<tbody>
										<?php
										$work_with = '<select name="work_with[%s]"><option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option></select>';
										foreach ($WorkPlansD as $WorkPlanD)
										{
											
											$work_with_selected = str_replace("<option>".$WorkPlanD->work_with."</option>","<option selected>".$WorkPlanD->work_with."</option>",$work_with);
											$products_array = array(); $samples_array = array(); $gifts_array = array();
											if($WorkPlanD->products!="")
											$products_array = unserialize($WorkPlanD->products);
											if($WorkPlanD->samples!="")
											$samples_array = unserialize($WorkPlanD->samples);
											if($WorkPlanD->gifts!="")
											$gifts_array = unserialize($WorkPlanD->gifts);
											$detail_products =array(); $sample_products =array(); $gift_products =array();
											foreach($products as $product)
											if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
											foreach($samples as $sample)
											if (array_key_exists($sample->id, $samples_array)) $sample_products[]= $sample->name;
											foreach($gifts as $gift)
											if (array_key_exists($gift->id, $gifts_array)) $gift_products[]= $gift->name;
											?>
											<tr class="<?=(($WorkPlanD->is_reported)?"reported":"")?> <?=(($WorkPlanD->is_missed)?"missed":"")?>">
											<td>
												<input type="checkbox" class="workplan_id" name="workplan_id[<?=$WorkPlanD->id?>]" value="<?=$WorkPlanD->id?>">
											</td>
											<td><?php if($WorkPlanD->is_missed) {echo $WorkPlanD->doctor->name;}else{?><a href="#doctor_product_<?=$WorkPlanD->id?>" id="pdt_link_<?=$WorkPlanD->id?>" class="popup-modal"><?=$WorkPlanD->doctor->name?></a><?php }?></td>
											<td><?=$class[$WorkPlanD->doctor->class]?></td>
											<td><?=$WorkPlanD->doctor->speciality->code?></td>
											<td><?=$WorkPlanD->city->city_name?></td>
											<td><?=str_replace("%s",$WorkPlanD->id,$work_with_selected)?></td>
											<td><?php if(count($detail_products)>0) echo  implode(", ",$detail_products);?></td>
											<td><?php if(count($sample_products)>0) echo  implode(", ",$sample_products);?></td>
											<td><?php if(count($gift_products)>0) echo  implode(", ",$gift_products);?></td>
											<td><?=$WorkPlanD->visit_time?></td>
											<td><?=$WorkPlanD->business?></td>
											</tr>
										<?php }?>
										</tbody></table>

									</div>
									<div class="clearfix"></div>
									<div class="center-button-container">
										<div class="row">
											<div class="form-group  mar-top-30">
												<div class="col-sm-3">
													<input type="hidden" id="return" name="return" value="dailyReportField" >
													<input type="submit" id="w2SubmitSave" name="SubmitSave" class="hide" >
													<button class="common-btn blue-btn pull-left" value="w2SubmitSave" type="button" name="" id="w2ButtonSave">Save</button>
												</div>
												<div class="col-sm-3">
													<button class="common-btn blue-btn pull-left" type="button" name="SubmitMissed" id="w2SubmitMissed">Missed</button>
												</div>
												<div class="col-sm-3">
													<input type="submit" id="w2SubmitRemove" name="SubmitRemove" class="hide" >
													<button class="common-btn blue-btn pull-left" value="w2SubmitRemove" type="button" name="" id="w2ButtonRemove">Remove Visit List</button>
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
													<!--<a  href="<?php echo $this->Url->build(["controller" => "Mrs","action" => "UnplannedDoctors",'?' => ['date' => $reportDate]])?>" class="common-btn blue-btn pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Unplanned Doctors</a>-->
													<a href="#UnplannedAdd" class="popup-modal common-btn blue-btn pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Unplanned Doctors</a>
												</div>
												<div class="col-sm-3">
													<a  href="#ChemistAdd" class="popup-modal common-btn blue-btn pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Chemists</a>
												</div>
												<div class="col-sm-3">
													<a  href="#StockistAdd" class="popup-modal common-btn blue-btn pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Stockists</a>
												</div>
												<div class="col-sm-3">
													<a  href="#PGOthers" class="popup-modal common-btn blue-btn pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Unlisted Doctors</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
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
		<div class="mfp-hide white-popup-block large_popup" id="UnplannedAdd">
			<div class="popup-content">
				<form class="" id="UnplannedAddForm" method="POST" >
				<input type="hidden" name="start_date" id="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="2">
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss add-form"><span>&times;</span></button>
					<div class="hr-title"><h4>Unplanned Doctors</h4><hr /></div>
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
								<select name="doctor_id" class="form-control required" id="doctor_id" aria-invalid="true">
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
						<div class="col-sm-12 mar-bottom-20">
						<a href="javascript:void(0)" onclick="$('#unplan_details').removeClass('hide')">Details</a>
						</div>
						<div class="col-sm-12 mar-bottom-20 hide" id="unplan_details">
							<div class="form-group col-sm-6">
								<label>Products To be detailed :</label>
								<select name="products[]" class="multiselect-ui form-control required" id="products" aria-invalid="true" multiple="multiple">
								<?php
								foreach($products as $product)
								echo '<option value="'.$product->id.'">'.$product->name.'</option>';
								?>
								</select>
							</div>
							<?php if(count($samples)){?>
							<div class="form-group col-sm-6">
								<h4>Samples :</h4>
								<ul id="ud_samples">
									<li>
									<label class="col-sm-6">
										<select name="sample_id[]" id="sample_id_1" class="sample_id" onchange="productClick(this,1)">
										<option value="">Select</option>
										<?php
										$bal =0;
										foreach($samples as $sample)
										{ $bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;?>
										<option value="<?=$sample->id?>" data-bal="<?=$bal?>"><?=$sample->name?></option>
										<?php }?>
										</select>
									</label>
									<label class="col-sm-6"> <input type="text" name="sample_qty[]" max="" class="required" id="sample_qty_1" value="" disabled></label>
									</li>
								</ul>
								<a href="javascript:void(0)" id="addSample" onclick="addSample('ud_samples')" >Add Sample</a>
							</div>
							<?php }?>
							<?php if(count($gifts)){?>
							<div class="form-group col-sm-6">
								<h4>Gifts :</h4>
								<ul id="ud_gifts">
									<li>
									<label class="col-sm-6">
										<select name="gift_id[]" id="gift_id_1" class="gift_id" onchange="giftClick(this,1)">
										<option value="">Select</option>
										<?php
										$bal =0;
										foreach($gifts as $gift)
										{ $bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;?>
										<option value="<?=$gift->id?>" data-bal="<?=$bal?>"><?=$gift->name?></option>
										<?php }?>
										</select>
									</label>
									<label class="col-sm-6"> <input type="text" name="gift_qty[]" max="" class="required" id="gift_qty_1" value="" disabled></label>
									</li>
								</ul>
								<a href="javascript:void(0)" id="addGift" onclick="addGift('ud_gifts')" >Add Sample</a>
							</div>
							<?php }?>
							<div class="form-group col-sm-12">
								<div class="form-group col-sm-6">
									<label class="col-sm-6">Discussion</label>
									<textarea name="discussion"></textarea>
								</div>
								<div class="form-group col-sm-6">
									<div class="col-sm-6">
									<label>Visit Time</label>
									<input type="text" name="visit_time" value=""><br>
									</div>
									<div class="col-sm-6">
									<label>Doctor Business</label>
									<input type="text" name="business" value="">
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="UnplannedSubmit" class="btn blue-btn btn-block">Save</button></div>
						<hr>
						<div class="col-sm-12 mar-bottom-20">
						<?php 
						$html ="";
						if(count($WorkPlansUD))
						{
							$html.='<h3 class="mar-top-10 mar-bottom-10">Un-Planned Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Class</th><th>Spec</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Gifts</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
							$i = 1;
							foreach ($WorkPlansUD as $WorkPlanUD)
							{
								$products_array = array(); $samples_array = array(); $gifts_array = array();
								if($WorkPlanUD->products!="")
								$products_array = unserialize($WorkPlanUD->products);
								if($WorkPlanUD->samples!="")
								$samples_array = unserialize($WorkPlanUD->samples);
								if($WorkPlanUD->gifts!="")
								$gifts_array = unserialize($WorkPlanUD->gifts);
								$detail_products =array(); $sample_products =array(); $gift_products =array();
								foreach($products as $product)
								if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
								foreach($samples as $sample)
								if (array_key_exists($sample->id, $samples_array)) $sample_products[]= $sample->name;
								foreach($gifts as $gift)
								if (array_key_exists($gift->id, $gifts_array)) $gift_products[]= $gift->name;
								$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanUD->doctor->name.'</td><td>'.$class[$WorkPlanUD->doctor->class].'</td><td>'.$WorkPlanUD->doctor->speciality->code.'</td><td>'.$WorkPlanUD->city->city_name.'</td><td>'.$WorkPlanUD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.((count($gift_products)>0)?implode(", ",$gift_products):"").'</td><td>'.$WorkPlanUD->visit_time.'</td><td>'.$WorkPlanUD->business.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanUD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
							$i++;
							}
							$html.='</tbody></table>';
						}
						if($html!="") echo $html;
						?>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block small_popup" id="ChemistAdd">
			<div class="popup-content">
				<form class="" id="ChemistAddForm" method="POST" >
				<input type="hidden" name="start_date" id="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Chemists</h4><hr /></div>
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
								<select name="chemist_id" class="form-control required" id="chemist_id" aria-invalid="true">
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
						<hr>
						<div class="col-sm-12 mar-bottom-20">
						<?php 
						$html ="";
						if(count($WorkPlansC))
						{
							$html.='<h3 class="mar-top-10 mar-bottom-10">Chemists</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Stockists Name</th><th>City</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
							$i = 1;
							foreach ($WorkPlansC as $WorkPlanC)
							{
								$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanC->chemist->name.'</td><td>'.$WorkPlanC->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanC->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
							$i++;
							}
							$html.='</tbody></table>';
						}
						if($html!="") echo $html;
						?>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="mfp-hide white-popup-block small_popup" id="StockistAdd">
			<div class="popup-content">
				<form class="" id="StockistAddForm" method="POST" >
				<input type="hidden" name="start_date" id="start_date" value="<?php echo $reportDate;?>">
				<input type="hidden" name="work_type_id" value="">
				<div class="popup-header">
					<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
					<div class="hr-title"><h4>Stockists</h4><hr /></div>
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
								<select name="stockist_id" class="form-control required" id="stockist_id" aria-invalid="true">
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
						<hr>
						<div class="col-sm-12 mar-bottom-20">
						<?php 
						$html ="";
						if(count($WorkPlansS))
						{
							$html.='<h3 class="mar-top-10 mar-bottom-10">Stockists</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Stockists Name</th><th>City</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
							$i = 1;
							foreach ($WorkPlansS as $WorkPlanS)
							{
								$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanS->stockist->name.'</td><td>'.$WorkPlanS->city->city_name.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanS->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
							$i++;
							}
							$html.='</tbody></table>';
						}
						if($html!="") echo $html;
						?>
						</div>
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
					<div class="hr-title"><h4>Unlisted Doctors</h4><hr /></div>
				</div>
				<div class="popup-body">
					<div class="row">
						<div class="col-sm-12 mar-bottom-20">
							<div class="form-group col-sm-4">
								<label for="city_id">Doctor Name</label>
								<input type="text" name="name" id="name" class="form-control required">
							</div>
							<div class="form-group col-sm-4">
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
							<div class="form-group col-sm-4">
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
							<div class="form-group col-sm-4">
								<label for="work_with">Work With</label>
								<select name="work_with" class="form-control required" id="work_with" aria-invalid="true">
									<option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option> 
								</select>
							</div>
						</div>
							<div class="form-group col-sm-6">
								<label>Products To be detailed :</label>
								<select name="products[]" class="multiselect-ui form-control required" id="products" aria-invalid="true" multiple="multiple">
								<?php
								foreach($products as $product)
								echo '<option value="'.$product->id.'">'.$product->name.'</option>';
								?>
								</select>
							</div>
						<div class="col-sm-12 mar-bottom-20">
							<?php if(count($samples)){?>
							<div class="form-group col-sm-6">
								<h4>Samples :</h4>
								<ul>
								<?php
								foreach($samples as $sample)
								{ $bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;
									?>
									<li>
									<label class="col-sm-6"> <input type="checkbox" name="sample_id[]" id="sample_id_<?=$sample->id?>" value="<?=$sample->id?>" onclick="productClick(this)"> <?= $sample->name?></label>
									<label class="col-sm-6"> <input type="text" name="sample_qty[<?=$sample->id?>]" max="<?=$bal?>" class="required" id="sample_qty_<?=$sample->id?>" value="" disabled></label>
									</li>
								<?php $bal =0;}?>
								</ul>
							</div>
							<?php }?>
							<?php if(count($gifts)){?>
							<div class="form-group col-sm-6">
								<h4>Gifts :</h4>
								<ul>
								<?php
								foreach($gifts as $gift)
								{ $bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;
									?>
									<li>
									<label class="col-sm-6"> <input type="checkbox" name="gift_id[]" id="gift_id_<?=$gift->id?>" value="<?=$gift->id?>" onclick="giftClick(this)"> <?= $gift->name?></label>
									<label class="col-sm-6"> <input type="text" name="gift_qty[<?=$gift->id?>]" max="<?=$bal?>" class="required" id="gift_qty_<?=$gift->id?>" value="" disabled></label>
									</li>
								<?php $bal =0;}?>
								</ul>
							</div>
							<?php }?>
							<div class="form-group col-sm-12">
								<div class="form-group col-sm-6">
									<label class="col-sm-6">Discussion</label>
									<textarea name="discussion"></textarea>
								</div>
								<div class="form-group col-sm-6">
									<div class="col-sm-6">
									<label>Visit Time</label>
									<input type="text" name="visit_time" value=""><br>
									</div>
									<div class="col-sm-6">
									<label>Doctor Business</label>
									<input type="text" name="business" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
						<div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" id="PGOSubmit" class="btn blue-btn btn-block">Save</button></div>
						<hr>
						<div class="col-sm-12 mar-bottom-20">
						<?php 
						$html ="";
						if(count($WorkPlansPD))
						{
							$html.='<h3 class="mar-top-10 mar-bottom-10">Unlisted Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>Spec</th><th>City</th><th>Work With</th><th>Products</th><th>Samples</th><th>Gifts</th><th>Visit Time</th><th>Business</th><th class="delete">&nbsp;</th></tr></thead><tbody>';
							$i = 1;
							foreach ($WorkPlansPD as $WorkPlanPD)
							{
								
								$products_array = array(); $samples_array = array(); $gifts_array = array();
								if($WorkPlanPD->products!="")
								$products_array = unserialize($WorkPlanPD->products);
								if($WorkPlanPD->samples!="")
								$samples_array = unserialize($WorkPlanPD->samples);
								if($WorkPlanPD->gifts!="")
								$gifts_array = unserialize($WorkPlanPD->gifts);
								$detail_products =array(); $sample_products =array(); $gift_products =array();
								foreach($products as $product)
								if (in_array($product->id, $products_array)) $detail_products[]= $product->name;
								foreach($samples as $sample)
								if (array_key_exists($sample->id, $samples_array)) $sample_products[]= $sample->name;
								foreach($gifts as $gift)
								if (array_key_exists($gift->id, $gifts_array)) $gift_products[]= $gift->name;
								$html.='<tr><td>'.$i.'</td><td>'.$WorkPlanPD->pg_other->name.'</td><td>'.$WorkPlanPD->pg_other->speciality->code.'</td><td>'.$WorkPlanPD->city->city_name.'</td><td>'.$WorkPlanPD->work_with.'</td><td>'.((count($detail_products)>0)?implode(", ",$detail_products):"").'</td><td>'.((count($sample_products)>0)?implode(", ",$sample_products):"").'</td><td>'.((count($gift_products)>0)?implode(", ",$gift_products):"").'</td><td>'.$WorkPlanPD->visit_time.'</td><td>'.$WorkPlanPD->business.'</td><td><a href="javascript:void(0)" onclick="doDelete('.$WorkPlanPD->id.')"><img src="'.$this->Url->image('../images/del@2x.png').'" width="14" height="18" alt="trash"></a></td></tr>';
							$i++;
							}
							$html.='</tbody></table>';
						}
						if($html!="") echo $html;
						?>
						</div>
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
						<input type="hidden" id="return" name="return" value="dailyReportField" >
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
					<input type="hidden" name="reportDate" value="<?php echo $reportDate;?>">
					<input type="hidden" name="workplan_id[<?=$WorkPlanD->id?>]" value="<?=$WorkPlanD->id?>">
					<div class="popup-header">
						<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
						<div class="hr-title"><h4>Detail Reporting</h4><hr /></div>
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
								<div class="form-group col-sm-6">
									<label>Products To be detailed :</label>
									<select name="products[]" class="multiselect-ui form-control required" id="products" aria-invalid="true" multiple="multiple">
									<?php
									$products_array = array();
									if($WorkPlanD->products!="")
									$products_array = unserialize($WorkPlanD->products);
									foreach($products as $product){
										echo '<option value="'.$product->id.'"'. (in_array($product->id, $products_array)?"selected":"") .'>'.$product->name.'</option>';
									}
									?>
									</select>
								</div>
							</div>
							<div class="col-sm-12 mar-bottom-20">
								<?php if(count($samples)){?>
								<div class="form-group col-sm-6">
									<h4>Samples :</h4>
									<ul>
									<?php
									$samples_array = array();
									if($WorkPlanD->samples!="")
									$samples_array = unserialize($WorkPlanD->samples);
									foreach($samples as $sample)
									{ $bal = (isset($i_sample[$sample->id]))?($sample->count - $i_sample[$sample->id]):$sample->count;
									?>
										<li>
											<?php
											if (array_key_exists($sample->id, $samples_array)){
											$sample_product_id[$sample->id]= $sample->name;
											?>
											<label class="col-sm-6"> <input type="checkbox"  name="sample_id[]" class="samples_<?=$WorkPlanD->id?>" id="sample_id_<?=$sample->id?>" value="<?=$sample->id?>" onclick="productClick(this)" checked> <?= $sample->name?></label>
											<label class="col-sm-6"> <input type="text" name="sample_qty[<?=$sample->id?>]" max="<?=($bal+$samples_array[$sample->id])?>" class="qty_txt required" id="sample_qty_<?=$sample->id?>" value="<?=$samples_array[$sample->id]?>"></label>
											<?php }else { ?>
											<label class="col-sm-6"> <input type="checkbox"  name="sample_id[]" class="samples_<?=$WorkPlanD->id?>" id="sample_id_<?=$sample->id?>" value="<?=$sample->id?>" onclick="productClick(this)"> <?= $sample->name?></label>
											<label class="col-sm-6"> <input type="text" name="sample_qty[<?=$sample->id?>]" max="<?=$bal?>" class="qty_txt required" id="sample_qty_<?=$sample->id?>" value="" disabled></label>
											<?php }?>
										</li>
									<?php $bal =0;}?>
									</ul>
								</div>
								<?php }?>
								<?php if(count($gifts)){?>
								<div class="form-group col-sm-6">
									<h4>Gifts :</h4>
									<ul>
									<?php
									$gifts_array = array();
									if($WorkPlanD->gifts!="")
									$gifts_array = unserialize($WorkPlanD->gifts);
									foreach($gifts as $gift)
									{ $bal = (isset($i_gift[$gift->id]))?($gift->count - $i_gift[$gift->id]):$gift->count;
									?>
										<li>
											<?php
											if (array_key_exists($gift->id, $gifts_array)){
											$sample_product_id[$gift->id]= $gift->name;
											?>
											<label class="col-sm-6"> <input type="checkbox"  name="gift_id[]" class="gifts_<?=$WorkPlanD->id?>" id="gift_id<?=$gift->id?>" value="<?=$gift->id?>" onclick="giftClick(this)" checked> <?= $gift->name?></label>
											<label class="col-sm-6"> <input type="text" name="gift_qty[<?=$gift->id?>]" max="<?=($bal+$gifts_array[$gift->id])?>" class="qty_txt required" id="gift_qty_<?=$gift->id?>" value="<?=$gifts_array[$gift->id]?>"></label>
											<?php }else { ?>
											<label class="col-sm-6"> <input type="checkbox"  name="gift_id[]" class="gifts_<?=$WorkPlanD->id?>" id="gift_id<?=$gift->id?>" value="<?=$gift->id?>" onclick="giftClick(this)"> <?= $gift->name?></label>
											<label class="col-sm-6"> <input type="text" name="gift_qty[<?=$gift->id?>]" max="<?=$bal?>" class="qty_txt required" id="gift_qty_<?=$gift->id?>" value="" disabled></label>
											<?php $bal =0;}?>
										</li>
									<?php }?>
									</ul>
								</div>
								<?php }?>
								<div class="form-group col-sm-12">
									<div class="form-group col-sm-6">
										<label class="col-sm-6">Discussion</label>
										<textarea name="discussion"><?= $WorkPlanD->discussion?></textarea>
									</div>
									<div class="form-group col-sm-6">
										<div class="col-sm-6">
										<label>Visit Time</label>
										<input type="text" name="visit_time" value="<?= $WorkPlanD->visit_time?>"><br>
										</div>
										<div class="col-sm-6">
										<label>Doctor Business</label>
										<input type="text" name="business" value="<?= $WorkPlanD->business?>">
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" id="return" name="return" value="dailyReportField" >
							<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss">Cancel</button></div>
							<div class="col-md-6 col-sm-6 col-xs-6"><button type="submit" name="SubmitSave" class="btn blue-btn btn-block">Save</button></div>
						</div>
					</div>
					</form>
					</div>
			<script>
				$("#doctor_product_<?=$WorkPlanD->id?>Form").validate({
					ignore: ":hidden"
				});
			</script>
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
		window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField"])?>?date="+moment(ev.date).format('YYYY-MM-DD'));
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
	$("#LeaveAddForm").validate({
		ignore: ":hidden",
		submitHandler: function (form) {
			doSubmit("#LeaveAddForm")
			return false; // required to block normal submit since you used ajax
		}
	});
	$("input[id^='workType_']").click(function(){
		if ($(this).is(':checked'))
		{
			$("div[id^='workType_section_']").addClass("hide");
			$("#workType_section_"+$(this).val()).removeClass("hide");
			$('input[type="checkbox"].workplan_id').prop('checked', false);
		}
	});
	
	$("#w2ButtonSave,#w2ButtonRemove").click(function(){
		var target_id = $(this).val();
		if ($('input[type="checkbox"].workplan_id').is(':checked'))
		{
			$( "#"+target_id ).click();
		}
		else{
			alert("Please check a Doctor");
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
	
	function addSample(ul){
		var n = $("#"+ul + " li").length;
		var limit = 3; if(<?=count($samples)?> < limit) limit = <?=count($samples)?>;
		if($("#"+ul + " #sample_qty_" + (n)).val()=="" || $("#"+ul + " #sample_id_" + (n)).val()=="")
		{
			alert("Please fill sample information");
		}
		else
		{
			var li = $("#"+ul + " li:last").html();
			var n_li = "<li>"+li+"</li>"
			var selected = $("#"+ul + " #sample_id_" + (n)).find(':selected').val()
			n_li = n_li.replace("sample_id_" + (n), "sample_id_" + (n + 1));
			n_li = n_li.replace("sample_qty_" + (n), "sample_qty_" + (n + 1));
			n_li = n_li.replace("this," + (n), "this," + (n + 1));
			$("#"+ul).append(n_li);
			if((n+1) == limit) $("#addSample").hide();
			$("#"+ul + " #sample_id_" + (n + 1) +" option[value='"+selected+"']").remove();
		}
		
	}
	
	function addGift(ul){
		var n = $("#"+ul + " li").length;
		var limit = 3; if(<?=count($samples)?> < limit) limit = <?=count($samples)?>;
		if($("#"+ul + " #gift_qty_" + (n)).val()=="" || $("#"+ul + " #gift_id_" + (n)).val()=="")
		{
			alert("Please fill gift information");
		}
		else
		{
			var li = $("#"+ul + " li:last").html();
			var n_li = "<li>"+li+"</li>"
			var selected = $("#"+ul + " #gift_id_" + (n)).find(':selected').val()
			n_li = n_li.replace("gift_id_" + (n), "gift_id_" + (n + 1));
			n_li = n_li.replace("gift_qty_" + (n), "gift_qty_" + (n + 1));
			n_li = n_li.replace("this," + (n), "this," + (n + 1));
			$("#"+ul).append(n_li);
			if((n+1) == limit) $("#addGift").hide();
			$("#"+ul + " #gift_id_" + (n + 1) +" option[value='"+selected+"']").remove();
		}
	}
	
	function productClick(elem,id){
		var product = $(elem).val();
		var bal = $(elem).find(':selected').data('bal');
		if(product != "")
		$(elem).closest("form").find('#sample_qty_'+id).prop('disabled', false).attr('max', bal);
		else
		$(elem).closest("form").find('#sample_qty_'+id+"-error").addClass("hide").val('').prop('disabled', true).attr('max', '');
	}
	
	function giftClick(elem,id){
		var gift = $(elem).val();
		var bal = $(elem).find(':selected').data('bal');
		if(gift != "")
		$(elem).closest("form").find('#gift_qty_'+id).prop('disabled', false).attr('max', bal);
		else
		$(elem).closest("form").find('#gift_qty_'+id+"-error").addClass("hide").val('').prop('disabled', true).attr('max', '');
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
					window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField"])?>/?date=<?php echo $reportDate;?>");			   
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
						window.location.replace("<?php echo $this->Url->build(["controller" => "Mrs","action" => "dailyReportField"])?>/?date=<?php echo $reportDate;?>");			   
					}
				   else
						alert(json.msg);
			   }
		   });
		}
	}


</script>
<?php echo $this->Html->script(['multiselect.js']); ?>        
<?= $this->fetch('script') ?>
<script type="text/javascript">
$('.multiselect-ui').multiselect({ });
</script>
