<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
		<!-- Main content -->
		<section>
			<div class="content">
				<div class="white-wrapper no-padding-top">
					<div class="row">
						<div class="event-button-cont">
							<ul class="side-nav">
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Doctor'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Doctor'), ['action' => 'edit', $doctor->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Doctor'), ['action' => 'delete', $doctor->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $doctor->name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Doctors'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h3><?= h($doctor->name) ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped text-align-left">
										<tr>
											<th scope="row"><?= __('Code') ?></th>
											<td><?= h($doctor->code) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Name') ?></th>
											<td><?= h($doctor->name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Speciality') ?></th>
											<td><?= $doctor->has('speciality') ? $this->Html->link($doctor->speciality->name, ['controller' => 'Specialities', 'action' => 'view', $doctor->speciality->id]) : '' ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Qualification') ?></th>
											<td><?= $doctor->has('qualification') ? $this->Html->link($doctor->qualification->name, ['controller' => 'Qualifications', 'action' => 'view', $doctor->qualification->id]) : '' ?>,<?= h($doctor->add_qualification) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Id') ?></th>
											<td><?= $this->Number->format($doctor->id) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Email') ?></th>
											<td><?= $doctor->email ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Mobile') ?></th>
											<td><?= $this->Number->format($doctor->mobile) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Phone') ?></th>
											<td><?= $this->Number->format($doctor->phone) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Address') ?></th>
											<td>
											<?php
											if($doctor->name != "")
												echo h($doctor->name)."<br>";
											if($doctor->door_no != "" || $doctor->door_no != "")
												echo (($doctor->door_no != "")? h($doctor->door_no)." - ":"") .(($doctor->street != "")? h($doctor->street):"")."<br>";
											if($doctor->area != "")
												echo h($doctor->area) ."<br>";
											if($doctor->city != "" || $doctor->pincode != "")
											echo ($doctor->has('city') ? $this->Html->link($doctor->city->city_name, ['controller' => 'Cities', 'action' => 'view', $doctor->city->id]) : '').(($this->Number->format($doctor->pincode) != 0)? " - ".h($this->Number->format($doctor->pincode)):"")."<br>";
											echo $doctor->has('state') ? $this->Html->link($doctor->state->name, ['controller' => 'States', 'action' => 'view', $doctor->state->id]) : '';
											?>
											</td>
										</tr>
										<tr>
											<th scope="row"><?= __('Is Approved') ?></th>
											<td><?= ($doctor->is_approved == 1) ? "Yes" : "No" ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Is Active') ?></th>
											<td><?= ($doctor->is_active == 1) ? "Yes" : "No" ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Last Updated') ?></th>
											<td><?= h($doctor->last_updated) ?></td>
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
