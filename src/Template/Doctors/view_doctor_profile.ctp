<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="ajax-wrapper">
		<!-- Main content -->
		<section>
			<div class="content">
				<div class="white-wrapper small">
					<div class="row">
						<div class="col-md-12">
								<div class="popup-header">
									<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
									<div class="hr-title"><h4>Dr. <?= h($doctor->name) ?> (<?= h($doctor->name) ?>)</h4><hr /></div>
								</div>
								<div class="popup-body">
									<table class="table table-striped text-align-left">
										<tr>
											<th scope="row"><?= __('Hospital/ Institution/ Clinic Name') ?></th>
											<td><?= h($doctor->clinic_name) ?></td>
										
											<th scope="row"><?= __('Reg.no') ?></th>
											<td><?= h($doctor->reg_no) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('D.O.Birth') ?></th>
											<td><?= !empty($doctor->dob) ? $doctor->dob->i18nFormat('dd-MM-YYYY') : "" ?></td>
										
											<th scope="row"><?= __('D.O.Wedding') ?></th>
											<td><?= !empty($doctor->dow) ? $doctor->dow->i18nFormat('dd-MM-YYYY') : "" ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Speciality') ?></th>
											<td><?= $doctor->has('speciality') ? $doctor->speciality->name : '' ?></td>
											
											<th scope="row"><?= __('Qualification') ?></th>
											<td><?= $doctor->has('qualification') ? $doctor->qualification->name : '' ?>,<?= h($doctor->add_qualification) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Mobile') ?></th>
											<td><?= $this->Number->format($doctor->mobile) ?></td>
										
											<th scope="row"><?= __('Phone') ?></th>
											<td><?= $this->Number->format($doctor->phone) ?></td>
										</tr>
										<tr>
										
											<th scope="row" valign="top"><?= __('Email') ?></th>
											<td valign="top"><?= $doctor->email ?></td>
											<th scope="row" valign="top"><?= __('Address') ?></th>
											<td valign="top">
											<?php
											if($doctor->name != "")
												echo h($doctor->name)."<br>";
											if($doctor->door_no != "" || $doctor->door_no != "")
												echo (($doctor->door_no != "")? h($doctor->door_no)." - ":"") .(($doctor->street != "")? h($doctor->street):"")."<br>";
											if($doctor->area != "")
												echo h($doctor->area) ."<br>";
											if($doctor->city != "" || $doctor->pincode != "")
											echo ($doctor->has('city') ? $doctor->city->city_name : '').(($this->Number->format($doctor->pincode) != 0)? " - ".h($this->Number->format($doctor->pincode)):"")."<br>";
											echo $doctor->has('state') ? $doctor->state->name	 : '';
											?>
											</td>
										</tr>
									</table>
								</div>
						</div>
						<div class="clearfix"></div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div> 
		</section>
		<!-- /.content -->
</div>
<!-- /.content-wrapper -->
