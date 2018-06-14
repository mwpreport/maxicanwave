<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Holiday[]|\Cake\Collection\CollectionInterface $holidays
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
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2>Holidays</h2>
								<hr>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-body no-padding">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th scope="col">S.No</th>
														<th scope="col"><?= $this->Paginator->sort('name') ?></th>
														<th scope="col"><?= $this->Paginator->sort('date') ?></th>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach ($holidays as $holiday): ?>
													<tr>
														<td><?= $i ?></td>
														<td><?= h($holiday->name) ?></td>
														<td><?= h(date("Y-m-d", strtotime($holiday->date))) ?></td>
													</tr>
													<?php $i++; endforeach; ?>
												</tbody>
											</table>
											<div class="paginator">
												<ul class="pagination">
													<?= $this->Paginator->first('<< ' . __('first')) ?>
													<?= $this->Paginator->prev('< ' . __('previous')) ?>
													<?= $this->Paginator->numbers() ?>
													<?= $this->Paginator->next(__('next') . ' >') ?>
													<?= $this->Paginator->last(__('last') . ' >>') ?>
												</ul>
												<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
											</div>

								</div>
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
