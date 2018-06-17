<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OtherAllowance $otherAllowance
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
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> New Other Allowance'), ['action' => 'add'], ['escape' => false]) ?></li>
								<li><?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i> Edit Other Allowance'), ['action' => 'edit', $otherAllowance->id], ['escape' => false]) ?> </li>
								<li><?= $this->Form->postLink(__('<i class="fa fa-trash" aria-hidden="true"></i> Delete Other Allowance'), ['action' => 'delete', $otherAllowance->id], ['escape' => false, 'confirm' =>  __('Are you sure you want to delete {0} other allowance?', $otherAllowance->name)]) ?> </li>
								<li><?= $this->Html->link(__('<i class="fa fa-list" aria-hidden="true"></i> List Other Allowances'), ['action' => 'index'], ['escape' => false]) ?> </li>
							</ul>
						</div>

						<div class="clearfix"></div>
						<div class="col-md-12">
								<div class="box-body no-padding">
									<table class="table table-striped text-align-left">
										<tr>
											<th scope="row"><?= __('Name') ?></th>
											<td><?= h($otherAllowance->name) ?></td>
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
