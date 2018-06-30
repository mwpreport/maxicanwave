<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Doctors <span class="go-back pull-right"><a href="<?php echo $this->Url->build(["controller" => "Reports","action" => "missedDoctors"])?>"><i class="fa fa-arrow-left"></i> Go Back</a></span></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="daily-report-radio-cnt">
						<div id="report_section">
							<div class="col-sm-12 mar-bottom-20" id="workType_section_2">
								<div class="col-md-12 mar-bottom-20">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th scope="col">S.No</th>
													<th scope="col"><?= $this->Paginator->sort('Code') ?></th>
													<th scope="col"><?= $this->Paginator->sort('name') ?></th>
													<th scope="col"><?= $this->Paginator->sort('Spec') ?></th>
													<th scope="col"><?= $this->Paginator->sort('Class') ?></th>
													<th scope="col"><?= $this->Paginator->sort('City') ?></th>
													<th scope="col" class="actions"><?= __('Options') ?></th>
												</tr>
											</thead>
											<tbody>
												<?php $i=1;	foreach ($missed as $doctor): ?>
												<tr>
													<td><?= $i ?></td>
													<td><?= $doctor->doctor->code ?></td>
													<td><?= h($doctor->doctor->name) ?></td>
													<td><?= $doctor->doctor->speciality->name ?></td>
													<td><?=$class[$doctor->doctor->class]?></td>
													<td><?= $doctor->doctor->city->city_name ?></td>
													<td width="60"><a href="<?php echo $this->Url->build(["controller" => "Doctors","action" => "viewDoctorProfile",'?' => ['id' => $doctor->doctor_id]])?>" class="ajax-popup-link">Profile</a></td>
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
						</div>
						
						</div>

            </div>
        </section>
    </div>
    <!-- /.content -->
</div>
<script>

	
	$('.popup-modal').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});
	$('.ajax-popup-link').magnificPopup({
		type: 'ajax',
		preloader: false,
		modal: false
	});
	$('.iframe-popup-link').magnificPopup({
		type: 'iframe',
		modal: true,
		iframe: {
			markup: '<div class="mfp-iframe-scaler">'+
					'<div class="close"><button type="button" class="close popup-modal-dismiss"><span>&times;</span></button></div>'+
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
					'</div>'
		  }
	});
	
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
	

</script>

