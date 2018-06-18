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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New City Distance'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit City Distance'), ['action' => 'edit', $cityDistance->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete City Distance'), ['action' => 'delete', $cityDistance->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete distance from "{0}" to "{1}"?', $cityDistance->cities_to->city_name, $cityDistance->cities_to->city_name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List City Distances'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>

						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped text-align-left">
										<tr>
											<th scope="row"><?= __('City From') ?></th>
											<td><?= h($cityDistance->cities_from->city_name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('City To') ?></th>
											<td><?= h($cityDistance->cities_to->city_name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('KM') ?></th>
											<td><?= $cityDistance->km ?></td>
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
