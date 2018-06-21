<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Expense Approval Requests</h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-xs-12">
                    <div class="white-wrapper mar-top-20">
                        <!-- /.box-header -->
                        <div class="table-responsive">
                            <table  class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
          <th scope="col"><?= $this->Paginator->sort('Month') ?></th>
					<th scope="col"><?= $this->Paginator->sort('user_id', 'MR') ?></th>
					<th scope="col"><?= $this->Paginator->sort('City') ?></th>
					<th scope="col" class="actions"><?= __('Options') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($expenseApprovals as $expenseApproval): ?>
				<tr>
					<td><?= $this->Number->format($i) ?></td>
          <td>
            <?= date("M-Y", strtotime($expenseApproval->date)); ?>
          </td>
					<td><?= $expenseApproval->has('user') ? $expenseApproval->user->firstname." ".$expenseApproval->user->lastname : '' ?></td>
					<td><?= $expenseApproval->user->city->city_name?></td>
					<td>
            <?= $this->Html->link(__('<img src="../images/eye.png" width="29" height="18" alt="profile">'), ['action' => 'expenseApprovalRequest', $expenseApproval->id],['escape' => false]) ?>
          </td>
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
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
    </div>
    <!-- /.content -->
</div>
