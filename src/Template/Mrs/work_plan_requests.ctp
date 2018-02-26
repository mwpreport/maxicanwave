<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Plan Requests For Approval</h2>
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
					<th scope="col"><?= $this->Paginator->sort('user_id', 'MR') ?></th>
					<th scope="col"><?= $this->Paginator->sort('City') ?></th>
					<th scope="col" class="actions"><?= __('Options') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($workPlansApproval as $workPlanApproval): ?>
				<tr>
					<td><?= $this->Number->format($i) ?></td>
					<td><?= $workPlanApproval->has('user') ? $workPlanApproval->user->firstname." ".$workPlanApproval->user->lastname : '' ?></td>
					<td><?= $workPlanApproval->user->city->city_name?></td>
					<td><?= $this->Form->postLink(__('<img src="'.$this->Url->image('../images/eye.png').'" width="29" height="18" alt="View">'), ['action' => 'workPlan', $workPlanApproval->id], ['escape' => false]) ?></td>
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
