<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DailyAllowance $dailyAllowance
 */
?>
<div class="content-wrapper">
		<!-- Main content -->
		<section>
			<div class="content">
				<div class="white-wrapper no-padding-top">
					<div class="row">
						<div class="event-button-cont">
							<ul class="side-nav">
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Daily Allowance'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Daily Allowance'), ['action' => 'edit', $dailyAllowance->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Daily Allowance'), ['action' => 'delete', $dailyAllowance->id], ['escape' => false, 'confirm' =>  __('Are you sure you want to delete {0} {1} daily allowance?', $dailyAllowance->role->name,$dailyAllowance->expense_type->name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Daily Allowances'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>

						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped text-align-left">
										<tr>
											<th scope="row"><?= __('Role') ?></th>
											<td><?= h($dailyAllowance->role->name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Expense Type') ?></th>
											<td><?= h($dailyAllowance->expense_type->name) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('cost') ?></th>
											<td><?= $dailyAllowance->cost ?></td>
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
<style>
.event-button-cont ul li:last-child {margin-top:10px;}
</style>
