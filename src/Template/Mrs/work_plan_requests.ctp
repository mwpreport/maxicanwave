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
					<th scope="col" colspan="3" class="actions"><?= __('Options') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($workPlansApproval as $workPlanApproval): ?>
				<tr>
					<td><?= $this->Number->format($i) ?></td>
					<td><?= $workPlanApproval->has('user') ? $workPlanApproval->user->firstname." ".$workPlanApproval->user->lastname : '' ?></td>
					<td><?= $workPlanApproval->has('user') ? $workPlanApproval->user->city->name : '' ?></td>
					<td width="60"><a href="javascript:void(0)" onclick="loadProfile(<?= $doctorsRelation->doctor_id ?>);"><img src="../images/eye.png" width="29" height="18" alt="profile"></a></td>
					<td width="50"><a href="#ModalEdit" class="popup-modal" onclick="loadProfileForm(<?= $doctorsRelation->id ?>);"><img src="../images/edit@2x.png" width="18" height="18" alt="edit"></a></td>
					<td width="50"><?= $this->Form->postLink(__('<img src="../images/del@2x.png" width="14" height="18" alt="trash">'), ['controller' => 'DoctorsRelation','action' => 'mrsDelete', $doctorsRelation->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete?')]) ?></td>
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
