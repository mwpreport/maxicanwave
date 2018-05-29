<?php
/**
 * @var \App\View\AppView $this
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
								<?php $user_param = ($filterUser != 0)? ['action' => 'add', '?' => ['user' => $filterUser]]:['action' => 'add']; ?>
								<li><?= $this->Html->link(__('<i class="fa fa-plus-circle" aria-hidden="true"></i> Add'), $user_param, ['escape' => false]) ?></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="hr-title">
								<h2>Assigned Samples</h2>
								<hr>
							</div>
						</div>
						<div class="row">
                            <div class="col-sm-12 mar-bottom-20">
								<div class="form-group col-sm-6">
								<div class="col-sm-4"><h4 for="user_id">Select MR</h4></div>
								<div class="col-sm-8">
									<select name="user_id" id="user_id"  class="error form-control required">
									<option value="">Select MR</option>
										<?php foreach ($users as $user){
										echo '<option value="'.$user->id.'" '.(($user->id==$filterUser)?"selected":"").'>'.$user->firstname.' ('.$user->code.')</option>';
										} ?>
									</select>
								</div>
								</div>
							</div>
						</div>

						<div class="clearfix"></div>
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-body no-padding">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
												<th scope="col"><?= $this->Paginator->sort('Product') ?></th>
												<th scope="col"><?= $this->Paginator->sort('Received') ?></th>
												<th scope="col"><?= $this->Paginator->sort('Issued') ?></th>
												<th scope="col"><?= $this->Paginator->sort('Remaining') ?></th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach ($assignedSamples as $assignedSample): ?>
											<tr>
												<td><?= $i ?></td>
												<td><?= $assignedSample->name?></td>
												<td><?= $assignedSample->count?></td>
												<td><?= $i_sample[$assignedSample->id] ?></td>
												<td><?= $assignedSample->count-$i_sample[$assignedSample->id] ?></td>
											</tr>
											<?php endforeach; ?>
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
<script>
	$('#user_id').on('change', function (ev) {
		window.location.replace("<?php echo $this->Url->build(["controller" => "AssignedSamples","action" => "index"])?>/?user="+$('#user_id').val());
	});
</script>