<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">

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
                             <th scope="col"><?= $this->Paginator->sort('Disallowed') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Remark') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Abeyance') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('Remark') ?></th>
     											</tr>
     										</thead>
                        <?= $this->Form->create('expenses', array('id' => 'newform')) ?>
     										<tbody>
     											<?php
                          $month_first_date="";
                          $month_travel_expense=0;
                          $month_daily_expense=0;
                          $month_other_expense=0;
                          $month_total_expense=0;
                          $month_disallowed_amount=0;
                          $month_abeyance_amount=0;
                          $expense_key=0;
                          for($i=1; $i<=$month_days; $i++){
                            $bgcolor= ($i%2 ==0) ? "background-color:#f9f9f9" : "background-color:#ffffff";
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
                                   <tr style="<?php echo $bgcolor; ?>">
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
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
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

                                   //total disallowed amount
                                   $month_disallowed_amount+=$expense->disallowed; 
                                   $month_abeyance_amount+=$expense->abeyance; 

                                   if(!empty($travelExpenses)){
                                       foreach($travelExpenses as $key => $travelExpense){ ?>
                                         <tr style="<?php echo $bgcolor; ?>">
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
                                                <td>
                                                  <?php if($key==0){ ?>
                                                    <?= $this->form->control('expenses['.$expense_key.'][id]', ['type' => 'hidden', 'label' => false, 'value' => $expense['id']]); ?>
                                                    <?= $this->form->control('expenses['.$expense_key.'][disallowed]', ['label' => false, 'value' => $expense['disallowed']]); ?>
                                                  <?php } ?>
                                                </td>
                                                <td>
                                                  <?php if($key==0){ ?>
                                                    <?= $this->form->control('expenses['.$expense_key.'][disallowed_remark]', ['type' => 'textArea', 'label' => false, 'value' => $expense['disallowed_remark']]); ?>
                                                  <?php } ?>
                                                </td>
                                                <td>
                                                  <?php if($key==0){ ?>
                                                    <?= $this->form->control('expenses['.$expense_key.'][abeyance]', ['label' => false, 'value' => $expense['abeyance']]); ?>
                                                  <?php } ?>
                                                </td>
                                                <td>
                                                  <?php if($key==0){ ?>
                                                    <?= $this->form->control('expenses['.$expense_key.'][abeyance_remark]', ['type' => 'textArea', 'label' => false,'value' => $expense['abeyance_remark']]); ?>
                                                  <?php } ?>
                                                </td>
                                        </tr>
                                       <?php }
                                     }elseif(!empty($otherExpenses)) { ?>
                                         <tr style="<?php echo $bgcolor; ?>">
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
                                                <td>
                                                    <?= $this->form->control('expenses['.$expense_key.'][id]', ['type' => 'hidden', 'label' => false, 'value' => $expense['id']]); ?>
                                                    <?= $this->form->control('expenses['.$expense_key.'][disallowed]', ['label' => false, 'value' => $expense['disallowed']]); ?>
                                                </td>
                                                <td>
                                                    <?= $this->form->control('expenses['.$expense_key.'][disallowed_remark]', ['type' => 'textArea', 'label' => false, 'value' => $expense['disallowed_remark']]); ?>
                                                </td>
                                                <td>
                                                    <?= $this->form->control('expenses['.$expense_key.'][abeyance]', ['label' => false, 'value' => $expense['abeyance']]); ?>
                                                </td>
                                                <td>
                                                    <?= $this->form->control('expenses['.$expense_key.'][abeyance_remark]', ['type' => 'textArea', 'label' => false,'value' => $expense['abeyance_remark']]); ?>
                                                </td>
                                        </tr>
                                     <?php
                                   }
                                   $expense_key++;
                                    } ?>
                                   <?php $k=1; } ?>
                                 <?php
                               }
                               if($k == 0){ ?>
                                 <tr style="<?php echo $bgcolor; ?>">
                                   <td style="color:red">
                                     <?php echo date('D-d', $time); ?>
                                   </td>
                                   <td colspan="16" style="color:red">Holiday / On Leave</td>
                                </tr>
                              <?php }
                          }
                    } ?>
                        <tr>
                          <td colspan="8">Travel Expense <?php echo $month_travel_expense; ?></td>
                          <td colspan="8">Total Daily Expense <?php echo $month_daily_expense; ?></td>
                        </tr>
                        <tr>
                          <td colspan="8">Other Expense <?php echo $month_other_expense; ?></td>
                          <td colspan="8">Total <?php echo $month_total_expense; ?></td>
                        </tr>
                        <tr>
                          <td colspan="3">Total Amount Claimed Rs</td>
                          <td colspan="3"><?php echo $month_total_expense; ?></td>
                          <td colspan="3">Comments </td>
                          <td colspan="4" rowspan="5">
                            <?= $this->form->control('comments', ['type' => 'textArea', 'rows' => 5, 'cols' => 50, 'label' => false, 'value' => isset($expenseApproval['comments']) ? $expenseApproval['comments'] : '' ]); ?>
                          </td>
    
                        </tr>
                        <tr>
                          <td colspan="3">Amount Disallowed Rs</td>
                          <td colspan="3"><?php echo $month_disallowed_amount; ?></td>
                          <td colspan="3"></td>

                        </tr>
                        <tr>
                          <td colspan="3">Amount in Abeyance Rs</td>
                          <td colspan="3"><?php echo $month_abeyance_amount; ?></td>
                          <td colspan="3"></td>
                        </tr>
                        <tr>
                          <td colspan="3">Released Abeyance Rs</td>
                          <td colspan="3">0.00</td>
                          <td colspan="3"></td>
                        </tr>
                        <tr>
                          <td colspan="3">Checked & Approved Rs</td>
                          <td colspan="3">0.00</td>
                          <td colspan="3"></td>
                        </tr>
                        <tr>

                          <td colspan="16">
                            <?php if(!empty($expenseApproval) && $expenseApproval['is_rejected'] != 1 && $expenseApproval['is_approved'] != 1){ ?>
                            <?= $this->form->control('approve_request', ['type' => 'hidden', 'label' => false, 'value' => 1]); ?>
                            <!-- <?= $this->Form->button(__('Reject'), ['name'=> 'is_rejected', 'class' => 'other-expense-submit common-btn blue-btn btn-125']); ?> -->
                            <?= $this->Form->button(__('Send to HO'), ['name'=> 'is_approved', 'class' => 'other-expense-submit common-btn blue-btn btn-125']); ?>
                          <?php }else if(!empty($expenseApproval) && $expenseApproval['is_approved'] == 1){ ?>
                            <h4 class="message success">Expense Approved</h4>
                          <?php }else if(!empty($expenseApproval) && $expenseApproval['is_rejected'] == 1){ ?>
                            <h4 class="message success">Expense Rejected</h4>
                          <?php } ?>
                          </td>
                        </tr>
     										</tbody>
                        <?= $this->Form->end() ?>
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
</script>
