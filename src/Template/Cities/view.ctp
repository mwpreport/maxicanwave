<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New City'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit City'), ['action' => 'edit', $city->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete City'), ['action' => 'delete', $city->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete "{0}"?', $city->city_name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Cities'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>
						<div class="clearfix"></div>

						<div class="col-md-12">
							<div class="hr-title">
								<h3><?= h($city->city_name) ?></h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped">
										<tr>
											<th scope="row"><?= __('State') ?></th>
											<td><?= $city->has('state') ? $this->Html->link($city->state->name, ['controller' => 'States', 'action' => 'view', $city->state->id]) : '' ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('City Name') ?></th>
											<td><?= h($city->city_name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Id') ?></th>
											<td><?= $this->Number->format($city->id) ?></td>
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
