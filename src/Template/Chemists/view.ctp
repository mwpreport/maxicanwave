<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chemist $chemist
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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Chemist'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Chemist'), ['action' => 'edit', $chemist->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Chemist'), ['action' => 'delete', $chemist->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $chemist->name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Chemists'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h3><?= h($chemist->name) ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped text-align-left">
										<tr>
											<th scope="row"><?= __('Code') ?></th>
											<td><?= h($chemist->code) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Name') ?></th>
											<td><?= h($chemist->name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Contact Person') ?></th>
											<td><?= h($chemist->contact_person) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Id') ?></th>
											<td><?= $this->Number->format($chemist->id) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Mobile') ?></th>
											<td><?= $this->Number->format($chemist->mobile) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Phone') ?></th>
											<td><?= $this->Number->format($chemist->phone) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Address') ?></th>
											<td>
											<?php
											if($chemist->name != "")
												echo h($chemist->name)."<br>";
											if($chemist->door_no != "" || $chemist->door_no != "")
												echo (($chemist->door_no != "")? h($chemist->door_no)." - ":"") .(($chemist->street != "")? h($chemist->street):"")."<br>";
											if($chemist->area != "")
												echo h($chemist->area) ."<br>";
											if($chemist->city != "" || $chemist->pincode != "")
											echo ($chemist->has('city') ? $this->Html->link($chemist->city->city_name, ['controller' => 'Cities', 'action' => 'view', $chemist->city->id]) : '').(($this->Number->format($chemist->pincode) != 0)? " - ".h($this->Number->format($chemist->pincode)):"")."<br>";
											echo $chemist->has('state') ? $this->Html->link($chemist->state->name, ['controller' => 'States', 'action' => 'view', $chemist->state->id]) : '';
											?>
											</td>
										</tr>
										<tr>
											<th scope="row"><?= __('Last Updated') ?></th>
											<td><?= h($chemist->last_updated) ?></td>
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
