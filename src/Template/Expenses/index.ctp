<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense[]|\Cake\Collection\CollectionInterface $expenses
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
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2><?= __('City Distances') ?></h2>
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
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('city_from') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('city_to') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('km') ?></th>
												<th scope="col" colspan="3" class="actions"><?= __('Options') ?></th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1;	foreach ($cityDistances as $cityDistance): ?>
											<tr>
											  <td><?= $this->Number->format($cityDistance->id) ?></td>
												<td><?= $cityDistance->cities_from->city_name ?></td>
												<td><?= $cityDistance->cities_to->city_name ?></td>
												<td><?= $this->Number->format($cityDistance->km) ?></td>
												<td width="60"><?= $this->Html->link(__('<img src="./images/eye.png" width="29" height="18" alt="profile">'), ['action' => 'view', $cityDistance->id],['escape' => false]) ?></td>
												<td width="50"><?= $this->Html->link(__('<img src="./images/edit@2x.png" width="18" height="18" alt="edit">'), ['action' => 'edit', $cityDistance->id],['escape' => false]) ?></td>
												<td width="50"><?= $this->Form->postLink(__('<img src="./images/del@2x.png" width="14" height="18" alt="trash">'), ['action' => 'delete', $cityDistance->id], ['escape' => false,'confirm' => __('Are you sure you want to delete distance between "{0}" to "{1}"?', $cityDistance->cities_to->city_name, $cityDistance->cities_to->city_name)]) ?></td>
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
