<!-- pop starts here -->
<section>
    <div class="row" id="report_section">
        <div class="col-xs-12">
            <div class="white-wrapper mar-top-20">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>HQ/ExHQ/OS</th>
                                <th>Work Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Kms</th>
                                <th>Fare</th>
                                <th>Travel Mode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $travelMode = ['Road' => 'Road', 'Train' => 'Train', 'Flight' => 'Flight'];
                            for($i=0;$i<$count;$i++){
                              if(count($WorkPlans) == 1){
                                $worktype = $WorkPlans[0]['work_type']['name'];
                              }else if(count($WorkPlans) > 1 && $i > 0 && in_array(2,$worktypes)){
                                $worktype = 'Field Work';
                              }else {
                                $worktype = $WorkPlans[$i]['work_type']['name'];
                              }
                              ?>
                           <?= $this->Form->create($expense, array('id' => 'newform')) ?>
                           <?php
                           if(isset($expense['travel_expenses'])){ ?>
                            <tr>
                             <?php if($i==0) {?>
                               <td rowspan="<?php echo $count; ?>" style="vertical-align : middle;text-align:center;">
                                 <?php $expanseTypeArr = $expenseTypes->toArray();
                                       echo $expanseTypeArr[$expense['expense_type_id']];
                                 ?>
                                 <?= $this->form->control('expense_type_id',['type' => 'hidden', 'value' => $expense['expense_type_id']]); ?>
                             </td>
                             <?php } ?>
                              <td><?php echo $worktype; ?></td>
                              <td><?php echo $cities[$expense['travel_expenses'][$i]['city_from']]; ?></td>
                              <td><?php echo $cities[$expense['travel_expenses'][$i]['city_to']]; ?></td>
                              <td><?php echo $expense['travel_expenses'][$i]['km']; ?></td>
                              <td>
                                <?php
                                 if($expense['travel_expenses'][$i]['km'] <= 60){
                                   echo $expense['travel_expenses'][$i]['fare'];
                                 }else { ?>
                                   <?= $this->Form->control('fare',['value' => $expense['travel_expenses'][$i]['fare'], 'label' => false]) ?>
                                 <?php } ?>
                              </td>
                              <td><?= $this->Form->control('travel_mode', ['options' => $travelMode, 'label' => false, 'value' => $expense['travel_expenses'][$i]['travel_mode']]); ?></td>
                            </tr>

                          <?php }else{ ?>
                            <tr>
                             <?php if($i==0) {?>
                               <td rowspan="<?php echo $count; ?>">
                                 <?= $this->form->control('expense_type_id',['type' => 'hidden']); ?>
                               </td>
                             <?php } ?>
                              <td><td><?php echo $worktype; ?></td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><?= $this->Form->control('travel_mode', ['options' => $travelMode, 'label' => false]); ?></td>
                            </tr>
                          <?php } ?>
                          <?php }?>
                          <?php echo $expense['daily_allowance']; ?>
                          <tr>
                            <td colspan="7"><?= $this->Form->control('daily_allowance', ['options' => $dailyAllowances, 'value' => isset($expense['daily_allowance']) ? $expense['daily_allowance'] : 0 ]); ?></td>
                          </tr>
                          <tr>
                            <td colspan="7"><?= $this->Form->button(__('Add'), ['class' => 'travel-expense-final-submit common-btn blue-btn btn-125']); ?></td>
                          </tr>
                          <?= $this->Form->end() ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>
<!-- pop ends here -->
