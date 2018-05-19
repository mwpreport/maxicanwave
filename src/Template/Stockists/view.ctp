<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stockist $stockist
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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Stockist'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Stockist'), ['action' => 'edit', $stockist->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Stockist'), ['action' => 'delete', $stockist->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $stockist->name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Stockists'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h3><?= h($stockist->name) ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped text-align-left">
										<tr>
											<th scope="row"><?= __('Code') ?></th>
											<td><?= h($stockist->code) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Stockist Name') ?></th>
											<td><?= h($stockist->name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Owner') ?></th>
											<td><?= h($stockist->owner) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Contact Person') ?></th>
											<td><?= h($stockist->contact_person) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Id') ?></th>
											<td><?= $this->Number->format($stockist->id) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Email') ?></th>
											<td><?= $stockist->email ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Mobile') ?></th>
											<td><?= $this->Number->format($stockist->mobile) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Phone') ?></th>
											<td><?= $this->Number->format($stockist->phone) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Address') ?></th>
											<td>
											<?php
											if($stockist->name != "")
												echo h($stockist->name)."<br>";
											if($stockist->door_no != "" || $stockist->door_no != "")
												echo (($stockist->door_no != "")? h($stockist->door_no)." - ":"") .(($stockist->street != "")? h($stockist->street):"")."<br>";
											if($stockist->area != "")
												echo h($stockist->area) ."<br>";
											if($stockist->city != "" || $stockist->pincode != "")
											echo ($stockist->has('city') ? $this->Html->link($stockist->city->city_name, ['controller' => 'Cities', 'action' => 'view', $stockist->city->id]) : '').(($this->Number->format($stockist->pincode) != 0)? " - ".h($this->Number->format($stockist->pincode)):"")."<br>";
											echo $stockist->has('state') ? $this->Html->link($stockist->state->name, ['controller' => 'States', 'action' => 'view', $stockist->state->id]) : '';
											?>
											</td>
										</tr>
										<tr>
											<th scope="row"><?= __('DL.NO') ?></th>
											<td><?= $stockist->dl_no ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('GST.NO') ?></th>
											<td><?= $stockist->gst_no ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Bank Account Details') ?></th>
											<td>
											<?php
											if($stockist->bank_name != "")
												echo h($stockist->bank_name).(($stockist->branch != "")? " - ".h($stockist->branch):"").(($stockist->ifsc != "")? " (".h($stockist->ifsc).")":"")."<br>";
											if($stockist->account_holder != "")
												echo "Account Holder : ". h($stockist->account_holder) ."<br>";
											if($stockist->account_no != "")
												echo "Account.No : ". h($stockist->account_no) ."<br>";
											if($stockist->account_type != "")
												echo "Type of Account : ". h($stockist->account_type) ."<br>";
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
