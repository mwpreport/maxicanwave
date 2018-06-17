<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content travel-expense">
           <section>
               <div class="row">
                   <div class="col-xs-12">
                       <div class="white-wrapper mar-top-20">
                           <!-- /.box-header -->
                           <div class="table-responsive">
                               <table  class="table table-striped table-bordered table-hover">
                                <thead>
                                	<tr>
                                   <th scope="col"><?= $this->Paginator->sort('HQ/ExHQ/OS') ?></th>
                                   <th scope="col"><?= $this->Paginator->sort('Work Type') ?></th>
                                   <th scope="col"><?= $this->Paginator->sort('From') ?></th>
                                   <th scope="col"><?= $this->Paginator->sort('To') ?></th>
                                	</tr>
                                </thead>
                                <tbody>
                                  <?= $this->Form->create($expense, array('id' => 'newform')) ?>
                                  <?php $hours = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"];
                                        $minutes = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59"]; ?>
                                    <?php  $count = count($cities);
                                        for($i=0;$i<$count;$i++){
                                          if(count($WorkPlans) == 1){
                                            $worktype = $WorkPlans[0]['work_type']['name'];
                                          }else if(count($WorkPlans) > 1 && $i > 0 && in_array(2,$worktypes)){
                                            $worktype = 'Field Work';
                                          }else {
                                            $worktype = $WorkPlans[$i]['work_type']['name'];
                                          }?>
                     											<tr class='travel-expense-row'>
                                            <td class="exp-type">
                                              <?php if($i==0) {?>
                                                <?= $this->Form->control('expense_type_id', ['options' => $expenseTypes, 'label' => false, 'empty' => 'Select', 'onchange' => 'loadExpenseType(this)']); ?>
                                              <?php } ?>
                                            </td>
                                            <td><?php echo $worktype; ?></td>
                                            <?php if(isset($expense['travel_expenses'])){ ?>
                                              <td class="city_from_<?php echo $i; ?>" ><?= $this->Form->control('travel_expenses['.$i.'][cities_from][id]', ['options' => $cities, 'label' => false, 'empty' => 'Select','value'=>$expense['travel_expenses'][$i]['city_from'], 'onchange' => 'selectCity(this)']); ?></td>
                                              <td class="city_to_<?php echo $i; ?>"><?= $this->Form->control('travel_expenses['.$i.'][cities_to][id]', ['options' => $cities, 'label' => false, 'empty' => 'Select', 'value'=>$expense['travel_expenses'][$i]['city_to'], 'onchange' => 'selectCity(this)']); ?></td>
                                          <?php }else { ?>
                                            <td class="city_from_<?php echo $i; ?>" ><?= $this->Form->control('travel_expenses['.$i.'][cities_from][id]', ['options' => $cities, 'label' => false, 'empty' => 'Select', 'onchange' => 'selectCity(this)']); ?></td>
                                            <td class="city_to_<?php echo $i; ?>" ><?= $this->Form->control('travel_expenses['.$i.'][cities_to][id]', ['options' => $cities, 'label' => false, 'empty' => 'Select', 'onchange' => 'selectCity(this)']); ?></td>
                                          <?php } ?>
                                          </tr>
                                        <?php } ?>
                                        <tr>

                                          <td colspan='2' class='started_date'>
                                            <span>Started:</span>
                                            <?= $this->Form->control('started_hour', ['options' => $hours, 'label' => false, 'value' => isset($expense['started']) ? date("G", strtotime($expense['started'])):'00']); ?>
                                            <?= $this->Form->control('started_minute', ['options' => $minutes, 'label' => false, 'value' => isset($expense['started']) ? date("i", strtotime($expense['started'])):'00']); ?>
                                          </td>
                                          <td colspan='2' class='end_date'>
                                            <span>Reached:</span>
                                            <?= $this->Form->control('reached_hour', ['options' => $hours, 'label' => false, 'value' => isset($expense['reached']) ? date("G", strtotime($expense['reached'])):'00']); ?>
                                            <?= $this->Form->control('reached_minute', ['options' => $minutes, 'label' => false, 'value' => isset($expense['reached']) ? date("i", strtotime($expense['reached'])):'00']); ?>
                                          </td>
                                        </tr>
                                        <tr>
                                           <td colspan="4"><?= $this->Form->button(__('Submit'), ['class' => 'travel-expense-submit common-btn blue-btn btn-125']); ?></td>
                                        </tr>
                                    <?= $this->Form->end() ?>
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

        <section>
            <div class="row">
                <div class="col-xs-12">
                    <div class="white-wrapper mar-top-20">
                        <!-- /.box-header -->
                        <div class="table-responsive">
                            <table  class="table table-striped table-bordered table-hover">
                              <thead>
                               <tr>
                                  <th scope="col"><?= $this->Paginator->sort('Voucher No') ?></th>
                                  <th scope="col"><?= $this->Paginator->sort('Exp. Type') ?></th>
                                  <th scope="col"><?= $this->Paginator->sort('Amount') ?></th>
                                  <th scope="col"><?= $this->Paginator->sort('Purpose') ?></th>
                                  <th scope="col"></th>
                               </tr>
                             </thead>
                             <tbody>
                               <?php $total_other_expense_fare=0;
                                    if(isset($expense['other_expenses'])){
                                 $otherExpenses = $expense['other_expenses'];
                                 $other_expense_arr = array_map(function($e) {
                                      return is_object($e) ? $e->fare : $e['fare'];
                                  }, $otherExpenses);
                                  $total_other_expense_fare=array_sum($other_expense_arr);                                  
                                 foreach($otherExpenses as $otherExpense){ ?>
                                 <tr>
                                   <td><?php echo $otherExpense['voucher_no']; ?></td>
                                   <td><?php echo $otherExpense['other_allowance']['name']; ?></td>
                                   <td><?php echo $otherExpense['description']; ?></td>
                                   <td><?php echo $otherExpense['fare']; ?></td>
                                   <td width="50"><?= $this->Html->link(__('<img src="../images/del@2x.png" width="14" height="18" alt="trash">'), ['action' => 'other-expense-delete',$otherExpense['id']],['escape' => false]) ?></td>
                                </tr>
                              <?php } ?>
                              <?php } ?>
                              <tr>
                                <td colspan="2">Total:</td>
                                <td><?php echo $total_other_expense_fare; ?></td>
                                <td colspan="2"></td>
                              </tr>
                              <tr>
                                <?= $this->Form->create($expense, array('id' => 'newform')) ?>

                                  <td style="display:none">
                                    <?php if(!empty($expense)) { ?>
                                      <?= $this->form->control('other_allowances[0][expense_id]', ['type' => 'hidden', 'label' => false, 'value' => $expense['id']]); ?>
                                    <?php } ?>
                                  </td>

                                  <td><?= $this->Form->control('other_expenses[0][other_allowance_id]', ['options' => $otherAllowances, 'label' => false, 'empty' => 'Select']); ?></td>
                                  <td><?= $this->Form->control('other_expenses[0][fare]',['label'=>false]); ?></td>
                                  <td><?= $this->Form->control('other_expenses[0][description]',['label'=>false, 'type'=> 'textArea']); ?></td>
                                  <td style="display:none"><?= $this->Form->control('other_expenses[0][voucher_no]',['label'=>false, 'type'=> 'textArea','value' => time()]); ?></td>

                                  <td width="50">
                                    <td colspan="4"><?= $this->Form->button(__('Add'), ['class' => 'other-expense-submit common-btn blue-btn btn-125']); ?></td>
                                  </td>
                                <?= $this->Form->end() ?>
                              </tr>
                             </tbody>
                          </table>



                      </div>
                    </div>
                </div>
              </div>
           </section>


           <!-- pop starts here -->
           <div class="mfp-hide white-popup-block large_popup" id="test-modal">
           <section>
               <div class="row" id="report_section">
                   <div class="col-xs-12">
                       <div class="white-wrapper mar-top-20">
                           <!-- /.box-header -->
                           <div class="table-responsive">
                               <table class="main-travel-expense table table-striped table-bordered table-hover">
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
                                           $worktypeid=$WorkPlans[0]['work_type']['id'];
                                         }else if(count($WorkPlans) > 1 && $i > 0 && in_array(2,$worktypes)){
                                           $worktype = 'Field Work';
                                           $worktypeid = 2;
                                         }else {
                                           $worktype = $WorkPlans[$i]['work_type']['name'];
                                           $worktypeid=$WorkPlans[0]['work_type']['id'];
                                         }
                                         ?>
                                      <?= $this->Form->create($expense, array('id' => 'newform')) ?>
                                      <?php
                                      if(isset($expense['travel_expenses'])){ ?>
                                       <tr>
                                        <?php if($i==0) {?>
                                          <td class="exp-type" rowspan="<?php echo $count; ?>" style="vertical-align : middle;text-align:center;">
                                            <span>
                                              <?php $expanseTypeArr = $expenseTypes->toArray();
                                                  echo $expanseTypeArr[$expense['expense_type_id']];
                                              ?>
                                            </span>
                                            <?= $this->form->control('expense_type_id',['type' => 'hidden', 'value' => $expense['expense_type_id']]); ?>
                                        </td>
                                        <?php } ?>

                                        <td>
                                          <span><?php echo $worktype; ?></span>
                                          <?= $this->form->control('travel_expenses['.$i.'][work_type_id]',['type' => 'hidden', 'label' => false, 'value' => $worktypeid]); ?>
                                        </td>

                                         <td class="city_from_<?php echo $i; ?>">
                                           <span><?php echo $cities[$expense['travel_expenses'][$i]['city_from']]; ?></span>
                                           <?= $this->form->control('travel_expenses['.$i.'][city_from]',['type' => 'hidden', 'label' => false, 'value' => $expense['travel_expenses'][$i]['city_from']]); ?>
                                         </td>

                                         <td class="city_to_<?php echo $i; ?>">
                                           <span><?php echo $cities[$expense['travel_expenses'][$i]['city_to']]; ?></span>
                                           <?= $this->form->control('travel_expenses['.$i.'][city_to]',['type' => 'hidden', 'label' => false, 'value' => $expense['travel_expenses'][$i]['city_to']]); ?>
                                         </td>

                                         <td class='km_<?php echo $i; ?>'>
                                           <span><?php echo $expense['travel_expenses'][$i]['km']; ?></span>
                                           <?= $this->form->control('travel_expenses['.$i.'][km]', ['type' => 'hidden', 'label' => false, 'value' => $expense['travel_expenses'][$i]['km']]); ?>
                                         </td>

                                         <td class='fare_<?php echo $i; ?>'>
                                           <?php if($expense['travel_expenses'][$i]['km'] <= 60){
                                               $spanstyle='display:block';
                                               $inputtype='hidden';
                                             }else {
                                              $spanstyle='display:none';
                                              $inputtype='text';
                                            } ?>

                                             <span style="<?php echo $spanstyle; ?>"><?php echo $expense['travel_expenses'][$i]['fare']; ?></span>
                                             <?= $this->Form->control('travel_expenses['.$i.'][fare]',['value' => $expense['travel_expenses'][$i]['fare'], 'label' => false,'type'=>$inputtype]) ?>
                                         </td>

                                         <td><?= $this->Form->control('travel_expenses['.$i.'][travel_mode]', ['options' => $travelMode, 'label' => false, 'value' => $expense['travel_expenses'][$i]['travel_mode']]); ?></td>
                                         <td class='start_date' style="display:none">
                                           <?= $this->form->control('started', ['type' => 'hidden', 'label' => false, 'value' => date("G:i", strtotime($expense['started']))]); ?>
                                         </td>
                                         <td class='end_date' style="display:none">
                                           <?= $this->form->control('reached', ['type' => 'hidden', 'label' => false, 'value' => date("G:i", strtotime($expense['reached']))]); ?>
                                         </td>
                                         <td>
                                           <?= $this->form->control('travel_expenses['.$i.'][expense_id]', ['type' => 'hidden', 'label' => false, 'value' => $expense['id']]); ?>
                                         </td>
                                         <td>
                                           <?= $this->form->control('travel_expenses['.$i.'][id]', ['type' => 'hidden', 'label' => false, 'value' => $expense['travel_expenses'][$i]['id']]); ?>
                                         </td>

                                       </tr>

                                     <?php }else{ ?>
                                       <tr>
                                        <?php if($i==0) {?>
                                          <td rowspan="<?php echo $count; ?>" class='exp-type'>
                                            <?= $this->form->control('expense_type_id',['type' => 'hidden']); ?>
                                            <span></span>
                                          </td>
                                        <?php } ?>
                                         <td>
                                           <span><?php echo $worktype; ?></span>
                                           <?= $this->form->control('travel_expenses['.$i.'][work_type_id]',['type' => 'hidden', 'label' => false, 'value' => $worktypeid]); ?>
                                         </td>
                                         <td class="city_from_<?php echo $i; ?>">
                                           <span></span>
                                           <?= $this->form->control('travel_expenses['.$i.'][city_from]',['type' => 'hidden', 'label' => false]); ?>
                                         </td>
                                         <td class="city_to_<?php echo $i; ?>">
                                           <span></span>
                                           <?= $this->form->control('travel_expenses['.$i.'][city_to]', ['type' => 'hidden', 'label' => false]); ?>
                                         </td>
                                         </td>
                                         <td class='km_<?php echo $i; ?>'>
                                           <span></span>
                                           <?= $this->form->control('travel_expenses['.$i.'][km]', ['type' => 'hidden', 'label' => false]); ?>
                                         </td>
                                         <td class='fare_<?php echo $i; ?>'>
                                            <span></span>
                                            <?= $this->form->control('travel_expenses['.$i.'][fare]', ['type' => 'hidden', 'label' => false]); ?>
                                         </td>

                                         <td><?= $this->Form->control('travel_expenses['.$i.'][travel_mode]', ['options' => $travelMode, 'label' => false]); ?></td>

                                         <td class='start_date' style="display:none">
                                           <?php echo date("h:i:s", strtotime($expense['started'])); ?>
                                           <?= $this->form->control('started', ['type' => 'hidden', 'label' => false]); ?>
                                         </td>
                                         <td class='end_date' style="display:none">
                                           <?= $this->form->control('reached', ['type' => 'hidden', 'label' => false]); ?>
                                         </td>
                                       </tr>
                                     <?php } ?>
                                     <?php }?>
                                     <tr>
                                       <td colspan="7"><?= $this->Form->control('daily_allowance', ['options' => $dailyAllowances, 'value' => isset($expense['daily_allowance']) ? $expense['daily_allowance'] : 0 ]); ?></td>
                                     </tr>
                                     <tr>
                                       <td colspan="7"><?= $this->Form->button(__('submit'), ['class' => 'travel-expense-final-submit common-btn blue-btn btn-125']); ?></td>
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
         </div>
           <!-- pop ends here -->

     </div>
</div>
<script>


function loadExpenseType(sel){
  var expense_type = sel.value;
  var expense_type_text = sel.options[sel.selectedIndex].text;

  var travel_expense_row_count = $('.travel-expense .travel-expense-row').length;
  if(expense_type == 3){
    if(travel_expense_row_count > 1)
      $('.travel-expense .travel-expense-row:last').css('display','none');
  }else{
    $('.travel-expense .travel-expense-row:last').css('display','table-row');
  }
  //change in main submit form(popup)
  $('.main-travel-expense .exp-type input').val(expense_type);
  $('.main-travel-expense .exp-type span').text(expense_type_text);
}

function selectCity(sel){
  var city_value = sel.value;
  var city_text = sel.options[sel.selectedIndex].text;
  var class_name = sel.parentElement.parentElement.className;
  $('.main-travel-expense .'+class_name+' span').text(city_text);
  $('.main-travel-expense .'+class_name+' input').val(city_value);

  console.log(city_value+''+city_text+class_name);
}

//Open travel expense Popup with expense type and city informations
$('.travel-expense-submit').click(function(e){
  //Validate if all selectbox are selected

  var row_cnt=0;
  $('.travel-expense-row:visible select').each(function(){
    if($(this).val() == ""){
      alert('please select required option');
      return false;
    }
    if($(this).parent().parent().attr('class') == 'city_to_'+row_cnt){
      var city_from_value = $('.city_from_'+row_cnt+' option:selected').val();
      var city_to_value = $('.city_to_'+row_cnt+' option:selected').val();
      $.ajax({
        url: '<?php echo $this->Url->build(["controller" => "mrs","action" => "getcityDistance"])?>',
        type: "POST",
        dataType: "json",
        data: {from:city_from_value,to:city_to_value},
        success: function(result) {
          if(result.status == 1){

            //Show city distance in Kms
            $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.km_'+row_cnt+' span').text(result.distance);
            $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.km_'+row_cnt+' input').val(result.distance);

            //Show fare for travel
            $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.fare_'+row_cnt+' span').text(result.distance*result.km_fare);
            $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.fare_'+row_cnt+' input').val(result.distance*result.km_fare);
            if(result.distance <= 60){
              $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.fare_'+row_cnt+' span').css('display','block');
              $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.fare_'+row_cnt+' input').attr('type','hidden');
            }else{
              $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.fare_'+row_cnt+' span').css('display','none');
              $('.main-travel-expense .city_to_'+row_cnt).closest('tr').find('.fare_'+row_cnt+' input').attr('type','text');
            }

          }
          row_cnt++;
        }
      });
    }
  })
  //Add started and reached in main form
  $started=$('#started-hour option:selected').val()+':'+$('#started-minute option:selected').val();
  $reached=$('#reached-hour option:selected').val()+':'+$('#reached-minute option:selected').val();
  $('.main-travel-expense .start_date input').val($started);
  $('.main-travel-expense .end_date input').val($reached);
  $.magnificPopup.open({
    items: {
      src: '#test-modal',
    },
    type: 'inline'
  });
  return false;
  e.preventDefault();
});

/*$('.other-expense-form').submit(function(){

  var id=$('.other-expense-form #id').val();
  var other_allowance_id = $('.other-expense-form #other-allowance-id option:selected').val();
  var fare = $('.other-expense-form #fare').val();
  var description = $('.other-expense-form #description').val();
  alert(other_allowance_id);
  $.ajax({
    url: '<?php echo $this->Url->build(["controller" => "mrs","action" => "edit-expense", '?' => ['date' => $this->request->getQuery('date')]])?>',
    type: "POST",
    dataType: "json",
    data: {id:id,other_allowance_id:other_allowance_id,fare:fare,description:description},
    success: function(result) {
      if(result.status == 1){
      }
    }
  });

  return false;
}); */

</script>
