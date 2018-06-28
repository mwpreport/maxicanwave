<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">

       <?php if(!isset($month_days)){ ?>
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                      <h2><?= __('Expenses') ?></h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="daily-report-radio-cnt">
                  <div class="row">
    							<?= $this->Form->create($expense, array('id' => 'newform')) ?>
    								<div class="form-group">
    									<div class="col-sm-4">
                        <?= $this->Form->control('month', ['class' => 'form-control required', 'options' => $months,'empty' => 'Select', 'required' => true,]) ?>
    									</div>
                      <div class="col-sm-4">
                        <?= $this->Form->control('year', ['class' => 'form-control required', 'options' => $years,'empty' => 'Select']) ?>
    									</div>
                      <div class="col-sm-4">
                        <?= $this->Form->button(__('Submit'), ['class' => 'expense-submit common-btn blue-btn btn-125 pull-left mar-top-30']); ?>
    									</div>
    									<!-- /.input group -->
    								</div>
    							<?= $this->Form->end() ?>
    							</div>
                </div>
             </div>
           </section>
        <?php } ?>

         <?php if(isset($month_days)){ ?>
           <section>
             <div class="white-wrapper">
               <div class="col-md-12">
                   <div class="hr-title">
                     <h2><?= __('Expenses') ?></h2>
                       <hr>
                   </div>
               </div>
               <div class="clearfix"></div>
               <div class="daily-report-radio-cnt">
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                       <div class="col-sm-3">
                         <?= $this->Form->label('Employee Name'); ?>
                       </div>
                       <div class="col-sm-3">
                         <?php echo $name; ?>
                       </div>
                       <div class="col-sm-3">
                         <?= $this->Form->label('Designation'); ?>
                       </div>
                       <div class="col-sm-3">
                         <?php echo $role_name; ?>
                       </div>
                     </div>
                  </div>
                 </div><br/><br/>

                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                       <div class="col-sm-3">
                         <?= $this->Form->label('HQ'); ?>
                       </div>
                       <div class="col-sm-3">
                         <?php echo $city_name; ?>
                       </div>
                       <div class="col-sm-3">
                         <?= $this->Form->label('Month'); ?>
                       </div>
                       <div class="col-sm-3">
                         <?php echo $month_in_text.'-'.$year; ?>
                       </div>
                     </div>
                  </div>
                </div>
            </div>
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
                             <th scope="col"><?= $this->Paginator->sort('Date') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('HQ/EXHQ/OS') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Work Type') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('From') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('To') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Kms') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Fare') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('TM') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Daiy Allow.') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Other Exp.') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Total') ?></th>
                             <?php if(empty($expenseApproval) || (!empty($expenseApproval) && $expenseApproval['is_rejected'] == 1 )){ ?>
				                        <th scope="col" colspan="3" class="actions"><?= __('Options') ?></th>
                             <?php } ?>
     											</tr>
     										</thead>
     										<tbody>
     											<?php
                          $month_first_date="";
                          $month_travel_expense=0;
                          $month_daily_expense=0;
                          $month_other_expense=0;
                          $month_total_expense=0;
                          for($i=1; $i<=$month_days; $i++){
                            $time=mktime(12, 0, 0, $month, $i, $year); ?>
                            <?php if (date('m', $time)==$month){
                                  if($i==1){
                                    $month_first_date = date("Y-m-d");
                                  }
                                  $k= 0;
                                  foreach($workPlanSubmit as $report){
                                    $report_date = date("Y-m-d", strtotime($report->date));
                                    if($report_date == date('Y-m-d', $time) ){ ?>
                                    <?php if(!isset($report->expense->travel_expenses) && !isset($report->expense->travel_expenses)){ ?>
                                   <tr>
    									                 <td>
                                         <?= $this->Html->link(__(date('D-d', $time)), ['action' => 'viewDailyReport', "?" => ["date" => date('Y-m-d', $time)]],['class' => 'iframe-popup-link','escape' => false]) ?>
                                       </td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <?php if(empty($expenseApproval) || (!empty($expenseApproval) && $expenseApproval['is_rejected'] == 1 )){ ?>
        				                                 <td width="50"><?= $this->Html->link(__('<img src="./images/edit@2x.png" width="18" height="18" alt="edit">'), ['action' => 'edit-expense','?'=>['date' =>$report_date]],['escape' => false]) ?></td>
                                           <?php } ?>
    							                 </tr>
                                 <?php }else {

                                   $total_travel_expense_fare=0;
                                   $expense=$report->expense;
                                   $travelExpenses = $report->expense->travel_expenses;
                                   $travel_expense_fare_arr = array_map(function($e) {
                                        return is_object($e) ? $e->fare : $e['fare'];
                                    }, $travelExpenses);
                                    $total_travel_expense_fare=array_sum($travel_expense_fare_arr);
                                    $month_travel_expense+=$total_travel_expense_fare;

                                   $otherExpense=0;
                                   $otherExpenses = $report->expense->other_expenses;
                                   $other_expense_fare_arr = array_map(function($e) {
                                        return is_object($e) ? $e->fare : $e['fare'];
                                    }, $otherExpenses);
                                    $otherExpense=array_sum($other_expense_fare_arr);
                                    $month_other_expense+=$otherExpense;


                                    if($expense->daily_allowance){
                                     $month_daily_expense+= $expense->daily_allowance;
                                   }
                                   $month_total_expense = $month_travel_expense + $month_other_expense + $month_daily_expense;

                                   if(!empty($travelExpenses)){
                                       foreach($travelExpenses as $key => $travelExpense){ ?>
                                         <tr>
                                            <td>
                                              <?php if($key==0){ ?>
                                                <?= $this->Html->link(__(date('D-d', $time)), ['action' => 'daily-report', "?" => ["date" => date('Y-m-d', $time)]],['escape' => false]) ?>
                                              <?php } ?>
                                             </td>
                                                 <td>
                                                   <?php if($key==0){ ?>
                                                     <?php echo $expense['expense_type']['name']; ?></td>
                                                  <?php } ?>
                                                   </td>
                                                 <td><?php echo $travelExpense['workTypes']['name']; ?></td>
                                                 <td><?php echo $travelExpense['cities_from']['city_name']; ?></td>
                                                 <td><?php echo $travelExpense['cities_to']['city_name']; ?></td>
                                                 <td><?php echo $travelExpense['km']; ?></td>
                                                 <td><?php echo $travelExpense['fare']; ?></td>
                                                 <td><?php echo $travelExpense['travel_mode']; ?></td>
                                                 <td>
                                                   <?php if($key==0){ ?>
                                                     <?php echo $expense['daily_allowance']; ?></td>
                                                   <?php } ?>
                                                 <td>
                                                   <?php if($key==0){ ?>
                                                     <?php echo $otherExpense; ?>
                                                  <?php } ?>
                                                 </td>
                                                 <td>
                                                   <?php if($key==0){ ?>
                                                     <?php echo $total_fare = $expense['daily_allowance'] + $total_travel_expense_fare + $otherExpense; ?>
                                                     <?php } ?>
                                                </td>
                                              <?php if(empty($expenseApproval) || (!empty($expenseApproval) && $expenseApproval['is_rejected'] == 1 )){ ?>
                                                   <?php if($key==0){ ?>
                                                     <td width="50"><?= $this->Html->link(__('<img src="./images/edit@2x.png" width="18" height="18" alt="edit">'), ['action' => 'edit-expense','?'=>['date' =>$report_date]],['escape' => false]) ?></td>
                                                  <?php } ?>
                                                <?php } ?>
                                        </tr>
                                       <?php }
                                     }elseif(!empty($otherExpenses)) { ?>
                                         <tr>
                                            <td>
                                                <?= $this->Html->link(__(date('D-d', $time)), ['action' => 'daily-report', "?" => ["date" => date('Y-m-d', $time)]],['escape' => false]) ?>
                                             </td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td>
                                                     <?php echo $otherExpense; ?>
                                                 </td>
                                                 <td>
                                                     <?php echo $total_fare = $expense['daily_allowance'] + $total_travel_expense_fare + $otherExpense; ?>
                                                </td>
                                                <?php if(empty($expenseApproval) || (!empty($expenseApproval) && $expenseApproval['is_rejected'] == 1 )){ ?>
                                                     <td width="50"><?= $this->Html->link(__('<img src="./images/edit@2x.png" width="18" height="18" alt="edit">'), ['action' => 'edit-expense','?'=>['date' =>$report_date]],['escape' => false]) ?></td>                                                  
                                                <?php } ?>
                                        </tr>
                                     <?php
                                   }
                                    } ?>
                                   <?php $k=1; } ?>
                                 <?php
                               }
                               if($k == 0){ ?>
                                 <tr>
                                   <td>
                                     <?= $this->Html->link(__(date('D-d', $time)), ['action' => 'daily-report', "?" => ["date" => date('Y-m-d', $time)]],['escape' => false]) ?>
                                   </td>
                                   <td colspan="12">Holiday / On Leave</td>
                                </tr>
                              <?php }
                          }
                    } ?>
                        <tr>
                          <td colspan="6">Travel Expense <?php echo $month_travel_expense; ?></td>
                          <td colspan="6">Total Daily Expense <?php echo $month_daily_expense; ?></td>
                        </tr>
                        <tr>
                          <td colspan="6">Other Expense <?php echo $month_other_expense; ?></td>
                          <td colspan="6">Total <?php echo $month_total_expense; ?></td>
                        </tr>
                        <tr>

                          <td colspan="12">
                            <?php if(empty($expenseApproval) || (!empty($expenseApproval) && $expenseApproval['is_rejected'] == 1 )){ ?>
                            <?= $this->Form->create('expenses', array('id' => 'newform')) ?>
                            <?= $this->form->control('approve_request', ['type' => 'hidden', 'label' => false, 'value' => 1]); ?>
                            <?= $this->Form->control('month', ['type' => 'hidden','label' => false, 'value' => $this->request->data['month']]) ?>
                            <?= $this->Form->control('year', ['type' => 'hidden','label' => false, 'value' => $this->request->data['year']]) ?>
                          <?= $this->Form->button(__('Send Expense For Approvals'), ['class' => 'other-expense-submit common-btn blue-btn btn-125']); ?>
                            <?= $this->Form->end() ?>
                          <?php }else if(!empty($expenseApproval) && $expenseApproval['is_approved'] == 1){ ?>
                            <h4 class="message success">Expense has been approved for this month</h4>
                          <?php }else{ ?>
                            <h4 class="message success">Expense approval request sent for this month</h4>
                          <?php } ?>
                          </td>
                        </tr>
     										</tbody>
     									</table>
                    </div>
                  </div>
                <!-- /.box-body -->
                </div>
              <!-- /.box -->
              </div>
            <!-- /.col -->
            </div>
        </section>
      <?php } ?>
     </div>
</div>

<script>
$("#newform").validate();
function loadexpenses(){
  var month = $("#month").val();
  var year = $("#year").val();
  alert(month+year);
}
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

</script>
