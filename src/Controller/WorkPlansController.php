<?php
namespace App\Controller;

use App\Controller\AppController;
use DateTime;
use DatePeriod;
use DateInterval;
/**
 * WorkPlans Controller
 *
 * @property \App\Model\Table\WorkPlansTable $WorkPlans
 *
 * @method \App\Model\Entity\WorkPlan[] paginate($object = null, array $settings = [])
 */
class WorkPlansController extends AppController
{
	public function initialize() {
        parent::initialize();
		$this->loadComponent('Auth');
	
        $this->loadModel('WorkPlans');
		$this->loadModel('WorkPlanApproval');
		$this->loadModel('WorkPlanSubmit');
        $this->loadModel('Workreports');
        $this->loadModel('WorkTypes');
        $this->loadModel('Users');
        $this->loadModel('Cities');
        $this->loadModel('Doctors');
        $this->loadModel('PgOthers');
        $this->loadModel('Roles');
		$this->loadModel('Products');
		$this->loadModel('Gifts');
        $this->loadModel('AssignedSamples');
        $this->loadModel('IssuedSamples');
        $this->loadModel('AssignedGifts');
        $this->loadModel('IssuedGifts');
		
    }

    /*
	public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'WorkTypes', 'Cities', 'Doctors']
        ];
        $workPlans = $this->paginate($this->WorkPlans);

        $this->set(compact('workPlans'));
        $this->set('_serialize', ['workPlans']);
    }

    public function view($id = null)
    {
        $workPlan = $this->WorkPlans->get($id, [
            'contain' => ['Users', 'WorkTypes', 'Cities', 'Doctors']
        ]);

        $this->set('workPlan', $workPlan);
        $this->set('_serialize', ['workPlan']);
    }

    public function add()
    {
        $workPlan = $this->WorkPlans->newEntity();
        if ($this->request->is('post')) {
            $workPlan = $this->WorkPlans->patchEntity($workPlan, $this->request->getData());
            if ($this->WorkPlans->save($workPlan)) {
                $this->Flash->success(__('The work plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work plan could not be saved. Please, try again.'));
        }
        $users = $this->WorkPlans->Users->find('list', ['limit' => 200]);
        $workTypes = $this->WorkPlans->WorkTypes->find('list', ['limit' => 200]);
        $cities = $this->WorkPlans->Cities->find('list', ['limit' => 200]);
        $doctors = $this->WorkPlans->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('workPlan', 'users', 'workTypes', 'cities', 'doctors'));
        $this->set('_serialize', ['workPlan']);
    }

    public function edit($id = null)
    {
        $workPlan = $this->WorkPlans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workPlan = $this->WorkPlans->patchEntity($workPlan, $this->request->getData());
            if ($this->WorkPlans->save($workPlan)) {
                $this->Flash->success(__('The work plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work plan could not be saved. Please, try again.'));
        }
        $users = $this->WorkPlans->Users->find('list', ['limit' => 200]);
        $workTypes = $this->WorkPlans->WorkTypes->find('list', ['limit' => 200]);
        $cities = $this->WorkPlans->Cities->find('list', ['limit' => 200]);
        $doctors = $this->WorkPlans->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('workPlan', 'users', 'workTypes', 'cities', 'doctors'));
        $this->set('_serialize', ['workPlan']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workPlan = $this->WorkPlans->get($id);
        if ($this->WorkPlans->delete($workPlan)) {
            $this->Flash->success(__('The work plan has been deleted.'));
        } else {
            $this->Flash->error(__('The work plan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	*/
	protected function _datePeriod($start_date, $end_date)
    {
		$period = new DatePeriod(
		new DateTime($start_date),
		new DateInterval('P1D'),
		new DateTime($end_date)
		);
		foreach ($period as $key => $value)
		$dates[]=$value->format('Y-m-d');
		return $dates;

	}
	
    public function mrsView($id = null)
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
        $startDate=$_GET['start']." 00:00:00";
        $endDate=$_GET['end']." 23:59:00";
		if(isset($_GET['user_id']))
			$uid = $_GET['user_id'];
        $workPlans = $this->WorkPlans->find()->contain(['Doctors'])
					->where(['start_date >= ' => $startDate,'end_date < ' => $endDate])
					->where(['WorkPlans.user_id' => $uid, 'WorkPlans.is_planned =' => 1, 'WorkPlans.is_deleted =' => 0]);
        
		$events=array();
		foreach($workPlans as $event)
        {
			$start = explode(" ", $event['start_date']);
			$end = explode(" ", $event['end_date']);
			if($start[1] == '00:00:00'){
				$start = $start[0];
			}else{
				$start = $event['start_date'];
			}
			if($end[1] == '00:00:00'){
				$end = $end[0];
			}else{
				$end = $event['end_date'];
			}
			$WorkTypes = $this->WorkPlans->WorkTypes->find()->select(['name', 'color'])->where(['id =' => $event['work_type_id']])->first();
			$title = $WorkTypes['name'];
			if($event['work_type_id']==2)
			$title = $event->doctor->name;
			$events[] = array('id'=>$event['id'], 'start'=>$start ,'end'=>$end ,'title'=>$title, 'color'=>$WorkTypes['color']); 
        }
			echo json_encode($events); 
			exit;
     }

    public function mrsAdd()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$workPlan = $this->WorkPlans->newEntity();
        if ($this->request->is('post')) {
			$data = array('user_id' => $uid, 'work_type_id' => $_POST['work_type_id'], 'start_date' => $_POST['start_date'], 'end_date' => $_POST['end_date'], 'city_id' => $_POST['city_id']);
			$data['plan_reason'] = isset($_POST['plan_reason'])? $_POST['plan_reason'] : "";
			$data['plan_details'] = isset($_POST['plan_details'])? $_POST['plan_details'] : "";
			$data['is_planned'] = 1;
			$data['start_date'] = $_POST['start_date']." 00:00:00";
			if( $_POST['end_date']=="")$_POST['end_date'] = $_POST['start_date'];
			$data['end_date'] = $_POST['end_date']." 23:59:00";
			
			

            list($status, $error)=$this->_checkLeave($data['start_date'],$data['end_date'],$data['work_type_id'],0);
            if(!$status)
            {echo json_encode(array("status"=>$status,"error"=>$error)); exit;}
			
			
            
			if($data['work_type_id'] ==1)
			{
				
				$dates = $this->_datePeriod($data['start_date'], $data['end_date']);
				foreach ($dates as $date)
				{
					$plan_data = $data;
					$plan_data['start_date'] = $date." 00:00:00";
					$plan_data['end_date'] = $date." 23:59:00";
					$workPlans_array[] = $plan_data;
				}

				$entities = $this->WorkPlans->newEntities($workPlans_array);
				$_results = $this->WorkPlans->saveMany($entities);
				
				$WorkTypes = $this->WorkPlans->WorkTypes->find()->select(['name', 'color'])->where(['id =' => 1])->first();
				foreach ($_results as $_result)
				{
					$returnArray[] = array('id'=> $_result['id'], 'start'=>$_result['start_date'] ,'end'=>$_result['end_date'] ,'title'=>$WorkTypes['name'], 'color'=>$WorkTypes['color']); 
				}
				echo json_encode(array("status"=>1,"events"=>$returnArray)); exit;
				
			}
			elseif($data['work_type_id'] == 2 && isset($_POST['doctor_id']))
			{
				$doctor_ids = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : array();
				foreach ($doctor_ids as $doctor_id)
				{
					$plan_data = $data;
					$plan_data['doctor_id'] = $doctor_id;
					$workPlans_array[] = $plan_data;
				}

				$entities = $this->WorkPlans->newEntities($workPlans_array);
				$_results = $this->WorkPlans->saveMany($entities);
				$WorkTypes = $this->WorkPlans->WorkTypes->find()->select(['name', 'color'])->where(['id =' => 2])->first();
				foreach ($_results as $_result)
				{
					$doctor_name = $this->WorkPlans->Doctors->find()->select(['name'])->where(['id =' => $_result['doctor_id']])->first()->name;
					$returnArray[] = array('id'=> $_result['id'], 'start'=>$_result['start_date'] ,'end'=>$_result['end_date'] ,'title'=>$doctor_name, 'color'=>$WorkTypes['color']); 
				}
				echo json_encode(array("status"=>1,"events"=>$returnArray)); exit;
			}
			elseif($data['work_type_id'] != 2 && $data['work_type_id'] != 1)
			{
				$workPlan = $this->WorkPlans->patchEntity($workPlan, $data);
				if ($this->WorkPlans->save($workPlan)) {
					$id = $workPlan->id;
					$WorkTypes = $this->WorkPlans->WorkTypes->find()->select(['name', 'color'])->where(['id =' => $workPlan->work_type_id])->first();
					$returnArray[] = array('id'=>$id, 'start'=>$workPlan->start_date ,'end'=>$workPlan->end_date ,'title'=>$WorkTypes['name'], 'color'=>$WorkTypes['color']); 
					echo json_encode(array("status"=>1,"events"=>$returnArray)); exit;
				}
				else
				{echo json_encode(array("status"=>0,"error"=>'The work plan could not be saved. Please, try again.')); exit;}
			}
			
        }
		exit;   
     }

    public function mrsUpdate()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$id = $_POST['id'];
		$workPlan = $this->WorkPlans->get($id, [
            'contain' => []
        ]);
		if ($this->request->is(['patch', 'post', 'put'])) {
            $workPlan = $this->WorkPlans->patchEntity($workPlan, $this->request->getData());
            $workPlan->start_date = $_POST['start_date']." 00:00:00";
            $_POST['end_date'] = $_POST['start_date'];
            $workPlan->end_date = $_POST['end_date']." 23:59:00";
			
            list($status, $error)=$this->_checkLeave($workPlan['start_date'],$workPlan['end_date'],$workPlan['work_type_id'],$workPlan->id);
            if(!$status)
            {echo json_encode(array("status"=>$status,"error"=>$error)); exit;}
			
			if($workPlan['work_type_id'] != 2)
			$workPlan->doctor_id = null;

            if ($this->WorkPlans->save($workPlan)) {
			$WorkTypes = $this->WorkPlans->WorkTypes->find()->select(['name', 'color'])->where(['id =' => $workPlan->work_type_id])->first();
			$title = $WorkTypes['name'];
			if($workPlan->work_type_id==2)
			$title = $this->WorkPlans->Doctors->find()->select(['name'])->where(['id =' => $workPlan->doctor_id])->first()->name;
			$returnArray[] = array('id'=>$id, 'start'=>$workPlan->start_date ,'end'=>$workPlan->end_date ,'title'=>$title, 'color'=>$WorkTypes['color']); 
			echo json_encode(array("status"=>1,"events"=>$returnArray)); exit;

            }
            else
            {echo json_encode(array("status"=>1,"error"=>'The work plan could not be saved. Please, try again.')); exit;}
        }
        
		exit;   
     }
     
    public function mrsDragDrop()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$data = $this->request->data;
		$id = $data['id'];
		
		$WorkPlans = $this->WorkPlans->get($id);

		$WorkPlans->start_date = $data['start_date'];
		$WorkPlans->end_date = $data['end_date'];

		if ($this->WorkPlans->save($WorkPlans)) {
			echo "1";
		}
		exit;   
     }

    public function mrsGetPlan()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$id = $_POST['id'];
		
		$WorkPlansTable = $this->WorkPlans;
		$WorkPlans = $WorkPlansTable->get($id);

		$returnArray = array('success' => "1",'work_type_id' => $WorkPlans->work_type_id,'long_plan' => $WorkPlans->long_plan,'start_date' => date_format($WorkPlans->start_date,"Y-m-d"),'end_date' => date_format($WorkPlans->end_date,"Y-m-d"),'city_id' => $WorkPlans->city_id,'doctor_id' => $WorkPlans->doctor_id,'plan_reason' => $WorkPlans->plan_reason,'plan_details' => $WorkPlans->plan_details);
		echo json_encode($returnArray); 
		exit;   
     }

    public function mrsGetPlans()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$date = $_POST['date'];
		$start_date = $date." 00:00:00";
        $end_date = $date." 23:59:00";
            
		
		$WorkPlans = $this->WorkPlans
		->find('all')
		->contain(['WorkTypes', 'Cities', 'Doctors'])	
		->where(['WorkPlans.user_id =' => $uid])
		->where(['WorkPlans.start_date =' => $start_date])->toArray();
		$html = "";
		if(count($WorkPlans))
		{
			$i=1;$html.='<table class="table table-striped table-bordered table-hover"><thead><tr><th>S.No</th><th>Field/ Others</th><th>City</th></tr></thead><tbody>';
			foreach ($WorkPlans as $WorkPlan)
			{
				$colomn_two = ($WorkPlan->work_type_id == 2) ? $WorkPlan->doctor->name : $WorkPlan->work_type->name;
				$html.='<tr><td class="text-center">'.$i.'</td><td><input type="hidden" name="selected_plan_id[]" value="'.$WorkPlan->id.'">'.$colomn_two.'</td><td>'.$WorkPlan->city->city_name.'</td></tr>';
				$i++;
			}
			$html.='</tbody></table>';

		}
		else {$html.="<p>No plans on this date</p>";}
		
		

		$returnArray = array('success' => "1",'html' => $html);
		echo json_encode($returnArray); 
		exit;   
     }

    public function mrsGetPlansOnly()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$date = $_POST['date'];
		$start_date = $date." 00:00:00";
        $end_date = $date." 23:59:00";
            
		
		$WorkPlans = $this->WorkPlans
		->find('all')
		->contain(['WorkTypes', 'Cities', 'Doctors'])	
		->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.work_type_id <>' => 1])
		->where(['WorkPlans.start_date =' => $start_date])->toArray();
		$html = "";
		if(count($WorkPlans))
		{
			$i=1;$html.='<table class="table table-striped table-bordered table-hover"><thead><tr><th>S.No</th><th>Field/ Others</th><th>City</th></tr></thead><tbody>';
			foreach ($WorkPlans as $WorkPlan)
			{
				$colomn_two = ($WorkPlan->work_type_id == 2) ? $WorkPlan->doctor->name : $WorkPlan->work_type->name;
				$html.='<tr><td class="text-center">'.$i.'</td><td><input type="hidden" name="selected_plan_id[]" value="'.$WorkPlan->id.'">'.$colomn_two.'</td><td>'.$WorkPlan->city->city_name.'</td></tr>';
				$i++;
			}
			$html.='</tbody></table>';

		}
		else {$html.="<p>No plans on this date</p>";}
		
		

		$returnArray = array('success' => "1",'html' => $html);
		echo json_encode($returnArray); 
		exit;   
     }

    public function mrsDelete()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$id = $_POST['id'];
		
		$WorkPlansTable = $this->WorkPlans;
		$WorkPlans = $WorkPlansTable->get($id);

		if ($this->WorkPlans->delete($WorkPlans)) {
			echo "1";
		}
		exit;   
     }

    public function mrsDateDelete()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$id = $_POST['selected_plan_id'];
		$returnArray = array();
		
		$WorkPlansTable = $this->WorkPlans;
		//pj($WorkPlans); exit;
		if ($WorkPlansTable->deleteAll(['WorkPlans.id IN' => $id])) {
			$returnArray = array('success' => "1",'eventIDs' => $id);
		}
		echo json_encode($returnArray); 
		exit;   
     }
     
    public function mrsPlanCopy()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $uid = $this->Auth->user('id');
		$id = $_POST['selected_plan_id'];
		$start_date = $_POST['copyto']." 00:00:00";
        $end_date = $_POST['copyto']." 23:59:00";
		$returnArray = array();
		$workPlans_array = array();
		
		$workPlan = $this->WorkPlans->find()
			->where(['id IN' => $id])->first();
		if($workPlan['work_type_id'] !=1)
		{
			list($status, $error) = $this->_checkLeave($start_date,$start_date,$workPlan->work_type_id,$workPlan->id);
			if(!$status)
			{echo json_encode(array("success"=>$status,"error"=>$error)); exit;}
		}
		
		$workPlans = $this->WorkPlans->find()
		->where(['id IN' => $id]);

		foreach($workPlans as $workPlan)
		{
			$data = array('user_id' => $uid, 'work_type_id' => $workPlan->work_type_id, 'city_id' => $workPlan->city_id,
			'doctor_id' => $workPlan->doctor_id, 
			'plan_reason' => $workPlan->plan_reason, 
			'plan_details' => $workPlan->plan_details, 
			'start_date' => $start_date, 
			'end_date' => $end_date, 
			'is_planned' => 1
			);

			$workPlans_array[] = $data;
		}

		$entities = $this->WorkPlans->newEntities($workPlans_array);
		$_results = $this->WorkPlans->saveMany($entities);
		if ($_results)
		{
			echo json_encode(array("success"=>1,"events"=>true)); exit;
		}
		echo json_encode(array("success"=>0,"error"=>"Something went wrong!")); exit;
     }

	public function submitPlan()
	{
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$lead_id = $this->Auth->user('lead_id');
		$workPlanApproval = $this->WorkPlanApproval->newEntity();
        if ($this->request->is('post')) {
			$data=array('date' => $_POST['date'], 'user_id' => $uid, 'lead_id' => $lead_id );
            $workPlanApproval = $this->WorkPlanApproval->patchEntity($workPlanApproval, $data);
            if ($this->WorkPlanApproval->save($workPlanApproval)) {
                $this->Flash->success(__('Submited to approval Queue.'));
            }
            $this->Flash->error(__('Failed. Please, try again.'));
        }
            return $this->redirect(["controller" => "Mrs","action" => "monthlyplan"]);
	}
	
	public function planApproval()
	{
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$id = $_POST['id'];
		$workPlanApproval = $this->WorkPlanApproval->find('all')->where(['id =' => $id])->first();

		$workPlanData = array();
		if(isset($_POST['RejectPlan']))
		{
			$workPlanData['is_rejected'] = 1;
			$success = 'Plan Rejected.';
		}
		
		if(isset($_POST['ApprovePlan']))
		{
			$workPlanData['is_approved'] = 1;
			$workPlanData['is_rejected'] = 0;
            $success = 'Plan Approved.';
		}
		$workPlanApproval = $this->WorkPlanApproval->patchEntity($workPlanApproval, $workPlanData);
		if ($this->WorkPlanApproval->save($workPlanApproval))
		{
			$this->Flash->success(__($success));
			if($workPlanApproval->is_approved == 1)
			{
				$startDate = date("Y-m-d", strtotime($workPlanApproval->date));
				$endDate = date("Y-m", strtotime($workPlanApproval->date))."-31";
		
				$WorkPlansTable = $this->WorkPlans;
				if ($WorkPlansTable->updateAll( array('is_approved' => 1), array('start_date >=' => $startDate, 'start_date <=' => $endDate, 'is_planned =' => 1))) {
				}
			}
		}
		else
		$this->Flash->success(__('Something went wrong. Please try again.'));
			
        		
		return $this->redirect(["controller" => "Mrs","action" => "workPlanRequests"]);
	}
	
	public function mrsGetReports()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$date = $_POST['date'];
		$start_date = $date." 00:00:00";
        $end_date = $date." 23:59:00";

		echo json_encode(array()); 
		exit;   
     }

 	public function mrsReportUpdate()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//pj($data); exit;
			$return = 'dailyReport';
			if(isset($data['return']))
			$return = $data['return'];
			$reportDate = $data['reportDate'];
			$workPlan_ids = array();
			if(isset($data['workplan_id']))
			$workPlan_ids = array_keys($data['workplan_id']);
			if(count($workPlan_ids)<1)
				{
					$this->Flash->error(__('Please select any plan to process.'));
					return $this->redirect(['controller' => 'mrs','action' => $return,'?' => ['date' => $reportDate]]);
				}

			foreach($workPlan_ids as $workPlan_id)
			{	
				$reportData=array(); $sample_diff = array(); $gift_diff = array();
				$workPlan = $this->WorkPlans->get($workPlan_id, [
					'contain' => []
				]);
				
				
				if(isset($data['SubmitDelete']))
				{
					if ($this->WorkPlans->delete($workPlan))
					$success = 'Deleted Successfully.';
					
					continue;
				}

				$reportData['is_reported'] = 1;
				if(isset($data['SubmitSave']))
				{
					if(isset($data['work_with'][$workPlan_id]))
					$reportData['work_with']=$data['work_with'][$workPlan_id];
					
					$product_array=array();
					if(isset($data['products']))
					{
						$reportData['products']=(count($data['products'])>0)?serialize($data['products']):"";
					}
					
					$sample_array=array();
					if(isset($data['sample_id']))
					{
						foreach($data['sample_id'] as $key => $sample_id)
						if($sample_id != "" )$sample_array[$sample_id] = $data['sample_qty'][$key];
						
						$reportData['samples']=(count($sample_array)>0)?serialize($sample_array):"";
						
						$sample_old = array_keys((($workPlan->samples != "")?unserialize($workPlan->samples):array()));
						$sample_new = array_keys($sample_array);
						$sample_diff = array_diff($sample_old,$sample_new);
					}
					
					$gift_array=array();
					if(isset($data['gift_id']))
					{
						foreach($data['gift_id'] as $key => $gift_id)
						if($gift_id != "" )$gift_array[$gift_id] = $data['gift_qty'][$key];
						
						$reportData['gifts']=(count($gift_array)>0)?serialize($gift_array):"";
						
						$gift_old = array_keys((($workPlan->gifts != "")?unserialize($workPlan->gifts):array()));
						$gift_new = array_keys($gift_array);
						$gift_diff = array_diff($gift_old,$gift_new);
					}
					
					if(isset($data['discussion']))
					$reportData['discussion']=$data['discussion'];
					if(isset($data['visit_time']))
					$reportData['visit_time']=$data['visit_time'];
					if(isset($data['business']))
					$reportData['business']=$data['business'];
				
					$success = 'The work plan has been saved.';
				}
				if(isset($data['SubmitMissed']))
				{
					if(isset($data['missed_reason'][$workPlan_id]) && $data['missed_reason'][$workPlan_id] != "")
					{
						$reportData['missed_reason']=$data['missed_reason'][$workPlan_id];
					}
					$reportData['is_missed'] = 1;
					$reportData['work_with'] = "";
					$reportData['products'] = "";
					$reportData['samples'] = "";
					$reportData['gifts'] = "";
					$reportData['visit_time'] = null;
					$reportData['business'] = null;
					$reportData['discussion	'] = null;
					$success = 'The work plan has been saved.';
				}
				if(isset($data['SubmitRemove']))
				{
					if($workPlan->is_planned == 1 && $workPlan->is_reported == 1)
						$reportData['is_reported'] = 0;
					if($workPlan->is_missed == 1 && $workPlan->is_missed == 1)
						$reportData['is_missed'] = 0;
					$reportData['products'] = "";
					$reportData['samples'] = "";
					$reportData['gifts'] = "";
					$reportData['visit_time'] = null;
					$reportData['business'] = null;
					$reportData['discussion	'] = null;
					
					//else
					//	$reportData['is_deleted'] = 1;

					$success = 'Removed Successfully.';
				}
			
				$reportData['last_updated'] = date("Y-m-d H:i:s");
			
				//pj($reportData);exit;

				$workPlan = $this->WorkPlans->patchEntity($workPlan, $reportData);
				if ($this->WorkPlans->save($workPlan)) {
					if(isset($data['SubmitSave']))
					{
						if(isset($reportData['gifts']) && !empty($reportData['gifts']))
						$this->saveIssuedGifts($gift_array, $workPlan, null);

						if(isset($reportData['samples']) && !empty($reportData['samples']))
						$this->saveIssuedSamples($sample_array, $workPlan, null);

						if(!empty($sample_diff))
						$this->deleteIssuedSamples($sample_diff, $workPlan);

						if(!empty($gift_diff))
						$this->deleteIssuedgifts($gift_diff, $workPlan);
					}
					else
					{
						$this->IssuedGifts->deleteAll(array('IssuedGifts.plan_id'=>$workPlan->id));
						$this->IssuedSamples->deleteAll(array('IssuedSamples.plan_id'=>$workPlan->id));
					}
				}
				else
				{
					$this->Flash->error(__('Something went wrong. Please, try again.'));
					return $this->redirect(['controller' => 'Mrs','action' => $return,'?' => ['date' => $reportDate]]);
				}
					
			} //exit;
			$this->Flash->success(__($success));
			return $this->redirect(['controller' => 'Mrs','action' => $return,'?' => ['date' => $reportDate]]);
        }
	}

 	public function mrsReportMissed()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $uid = $this->Auth->user('id');

        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//pj($data);exit;
			$return = 'dailyReport';
			if(isset($data['return']))
			$return = $data['return'];
			$reportDate = $data['start_date'];
			$workPlan_ids = array();
			if(isset($data['m_workplan_id']))
			$workPlan_ids = array_keys($data['m_workplan_id']);
			if(count($workPlan_ids)<1)
				{
					$this->Flash->error(__('Please select any plan to process.'));
					return $this->redirect(['controller' => 'mrs','action' => $return,'?' => ['date' => $reportDate]]);
				}

			foreach($workPlan_ids as $workPlan_id)
			{	
				$reportData=array();
				$workPlan = $this->WorkPlans->get($workPlan_id, [
					'contain' => []
				]);
				$reportData['is_reported'] = 1;
				
				if(isset($data['SubmitMissed']))
				{
					if(isset($data['missed_reason'][$workPlan_id]) && $data['missed_reason'][$workPlan_id] != "")
					{
						$reportData['missed_reason']=$data['missed_reason'][$workPlan_id];
						$reportData['products'] = "";
						$reportData['work_with'] = "";
						$reportData['samples'] = "";
						$reportData['gifts'] = "";
						$reportData['visit_time'] = null;
						$reportData['business'] = null;
						$reportData['discussion	'] = null;

						if(isset($data['alt_date'][$workPlan_id]) && $data['alt_date'][$workPlan_id] != "")
						{
							$newWorkPlan = $this->WorkPlans->newEntity();
							$newData = array('user_id' => $uid, 'work_type_id' => '2', 'city_id' => $workPlan['city_id']);
							$newData['start_date'] = $data['alt_date'][$workPlan_id]." 00:00:00";
							$newData['end_date'] = $data['alt_date'][$workPlan_id]." 23:59:00";
							$newData['is_planned'] = 1;
							$newData['is_approved'] = 1;
							$newData['doctor_id'] = $workPlan['doctor_id'];
							$newData = $this->WorkPlans->patchEntity($newWorkPlan, $newData);
							//pj($newWorkPlan); exit;
							
							if (!$this->WorkPlans->save($newWorkPlan)) {break;}
						}
					}
					$reportData['is_missed'] = 1;
					$success = 'The work plan has been saved.';
				}
			
				$reportData['last_updated'] = date("Y-m-d H:i:s");
			
				//pj($workPlan);pj($reportData);exit;

				$workPlan = $this->WorkPlans->patchEntity($workPlan, $reportData);
				if ($this->WorkPlans->save($workPlan)) {
						$this->IssuedGifts->deleteAll(array('IssuedGifts.plan_id'=>$workPlan->id));
						$this->IssuedSamples->deleteAll(array('IssuedSamples.plan_id'=>$workPlan->id));
				}
				else
				{
					$this->Flash->error(__('Something went wrong. Please, try again.'));
					return $this->redirect(['controller' => 'Mrs','action' => $return,'?' => ['date' => $reportDate]]);
				}
					
			} //exit;
			$this->Flash->success(__($success));
			return $this->redirect(['controller' => 'Mrs','action' => $return,'?' => ['date' => $reportDate]]);
        }
	}

    public function mrsAddReport()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$workPlan = $this->WorkPlans->newEntity();
		$noflash=false;
        if ($this->request->is('post')) {
			$data = array('user_id' => $uid, 'work_type_id' => $_POST['work_type_id'], 'start_date' => $_POST['start_date'], 'city_id' => $_POST['city_id']);
			$data['start_date'] = $_POST['start_date']." 00:00:00";
			$data['end_date'] = $_POST['start_date']." 23:59:00";
			$data['plan_reason'] = isset($_POST['plan_reason'])? $_POST['plan_reason'] : "";
			$data['plan_details'] = isset($_POST['plan_details'])? $_POST['plan_details'] : "";
			$data['plan_time'] = isset($_POST['start_time']) && isset($_POST['end_time'])? $_POST['start_time']."-".$_POST['end_time'] : "";

			$data['is_reported'] = 1;
			$data['last_updated'] = date("Y-m-d H:i:s");
			
			if($data['work_type_id'] == "" && !isset($_POST['chemist_id']) && !isset($_POST['stockist_id']))
			{echo json_encode(array("status"=>0,"msg"=>'The report could not be saved. Please, try again.')); exit;}
            
			if($data['work_type_id'] == 2 && isset($_POST['doctor_id']))
			{
				$reportData = $data;
				$reportData['doctor_id'] = $_POST['doctor_id'];
				$reportData['is_unplanned'] = 1;
				$reportData['is_approved'] = 1;
				$reportData['work_with'] = $_POST['work_with'];
				$product_array=array();
				if(isset($_POST['products']))
				{
					$reportData['products']=(count($_POST['products'])>0)?serialize($_POST['products']):"";
				}
				$sample_array=array();
				if(isset($_POST['sample_id']))
				{
					foreach($_POST['sample_id'] as $key => $sample_id)
					if($sample_id != "" )$sample_array[$sample_id] = $_POST['sample_qty'][$key];
					
					$reportData['samples']=(count($sample_array)>0)?serialize($sample_array):"";
				}
				$gift_array=array();
				if(isset($_POST['gift_id']))
				{
					foreach($_POST['gift_id'] as $key => $gift_id)
					if($gift_id != "" )$gift_array[$gift_id] = $_POST['gift_qty'][$key];
					
					$reportData['gifts']=(count($gift_array)>0)?serialize($gift_array):"";
				}
				
				if(isset($_POST['discussion']))
				$reportData['discussion']=$_POST['discussion'];
				if(isset($_POST['visit_time']))
				$reportData['visit_time']=$_POST['visit_time'];
				if(isset($_POST['business']) && $_POST['business'] !="")
				$reportData['business']=$_POST['business'];

				$success_msg = "Unplanned Doctor(s) Saved Successfully";
			}
			elseif($data['work_type_id'] == "" && isset($_POST['chemist_id']))
			{
				$reportData = $data;
				$reportData['chemist_id'] = $_POST['chemist_id'];
				$success_msg = "Chemist(s) Saved Successfully";
			}
			elseif($data['work_type_id'] == "" && isset($_POST['stockist_id']))
			{
				$reportData = $data;
				$reportData['stockist_id'] = $_POST['stockist_id'];
				$success_msg = "Stockist Saved Successfully";
			}
			elseif($data['work_type_id'] != 2 && $data['work_type_id'] != "")
			{
				$reportData = $data;
				$success_msg = "Report Saved Successfull";
				$noflash=true;
			}
				
			$workPlan = $this->WorkPlans->patchEntity($workPlan, $reportData);
			if ($this->WorkPlans->save($workPlan)) {
				if(isset($reportData['gifts']) && !empty($reportData['gifts']))
				$this->saveIssuedGifts($gift_array, $workPlan, null);

				if(isset($reportData['samples']) && !empty($reportData['samples']))
				$this->saveIssuedSamples($sample_array, $workPlan, null);

				if(!$noflash) $this->Flash->success(__($success_msg));
				echo json_encode(array("status"=>1,"msg"=>$success_msg)); exit;
			}
			else
			{$this->Flash->error(__('The report could not be saved. Please, try again.'));echo json_encode(array("status"=>0,"msg"=>'The report could not be saved. Please, try again.')); exit;}
			
        }
		exit;   
     }

    public function mrsAddReportLeave()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$workPlan = $this->WorkPlans->newEntity();
        if ($this->request->is('post')) {
			$data = array('user_id' => $uid, 'work_type_id' => $_POST['work_type_id'], 'city_id' => $_POST['city_id']);
			$data['plan_reason'] = isset($_POST['plan_reason'])? $_POST['plan_reason'] : "";
			$data['plan_details'] = isset($_POST['plan_details'])? $_POST['plan_details'] : "";
			$data['is_reported'] = 1;
			$data['start_date'] = $_POST['start_date']." 00:00:00";
			if( $_POST['end_date']=="")$_POST['end_date'] = $_POST['start_date'];
			$data['end_date'] = $_POST['end_date']." 23:59:00";
			$data['last_updated'] = date("Y-m-d H:i:s");
			
			

            list($status, $error)=$this->_checkLeaveReport($data['start_date'],$data['end_date']);
            if(!$status)
            {echo json_encode(array("status"=>$status,"error"=>$error)); exit;}
			
				
			$dates = $this->_datePeriod($data['start_date'], $data['end_date']);
			foreach ($dates as $date)
			{
				$plan_data = $data;
				$plan_data['start_date'] = $date." 00:00:00";
				$plan_data['end_date'] = $date." 23:59:00";
				$workPlans_array[] = $plan_data;
			}

			$entities = $this->WorkPlans->newEntities($workPlans_array);
			$_results = $this->WorkPlans->saveMany($entities);
			
			echo json_encode(array("status"=>1,"error"=>"")); exit;
				
		}
		exit;
	}
	
	public function mrsAddPgoReport()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$workPlan = $this->WorkPlans->newEntity();
		$doctor = $this->PgOthers->newEntity();
        
		if ($this->request->is('post')) {
		$reportDate = $_POST['start_date'];
			$city = $this->Cities->find()->where(['id =' => $_POST['city_id']])->first();
			$docArray = array('name' => $_POST['name'], 'city_id' => $_POST['city_id'], 'speciality_id' => $_POST['speciality_id'], 'state_id' => $city->state_id);
			$doctor = $this->PgOthers->patchEntity($doctor, $docArray);
			$doctor->user_id=$uid;
			//debug($doctor);exit;
			if ($this->PgOthers->save($doctor)) {
				$doctor_id = $doctor->id;
				$reportData = array('user_id' => $uid, 'pgother_id' => $doctor_id, 'work_type_id' => $_POST['work_type_id'], 'start_date' => $_POST['start_date'], 'city_id' => $_POST['city_id']);
				$reportData['start_date'] = $_POST['start_date']." 00:00:00";
				$reportData['end_date'] = $_POST['start_date']." 23:59:00";
				$reportData['is_reported'] = 1;
				$reportData['last_updated'] = date("Y-m-d H:i:s");
				$reportData['is_approved'] = 1;
				$reportData['work_with'] = $_POST['work_with'];
				$product_array=array();
					if(isset($_POST['products']))
					{
						$reportData['products']=(count($_POST['products'])>0)?serialize($_POST['products']):"";
					}
				$sample_array=array();
					if(isset($_POST['sample_id']))
					{
						foreach($_POST['sample_id'] as $key => $sample_id)
						if($sample_id != "" )$sample_array[$sample_id] = $_POST['sample_qty'][$key];
						
						$reportData['samples']=(count($sample_array)>0)?serialize($sample_array):"";
					}
					$gift_array=array();
					if(isset($_POST['gift_id']))
					{
						foreach($_POST['gift_id'] as $key => $gift_id)
						if($gift_id != "" )$gift_array[$gift_id] = $_POST['gift_qty'][$key];
						
						$reportData['gifts']=(count($gift_array)>0)?serialize($gift_array):"";
					}
					
					if(isset($_POST['discussion']))
					$reportData['discussion']=$_POST['discussion'];
					if(isset($_POST['visit_time']))
					$reportData['visit_time']=$_POST['visit_time'];
					if(isset($_POST['business']))
					$reportData['business']=$_POST['business'];
				
				$workPlan = $this->WorkPlans->patchEntity($workPlan, $reportData);
				if ($this->WorkPlans->save($workPlan)) {
					if(isset($reportData['gifts']) && !empty($reportData['gifts']))
					$this->saveIssuedGifts($gift_array, $workPlan, "pg");

					if(isset($reportData['samples']) && !empty($reportData['samples']))
					$this->saveIssuedSamples($sample_array, $workPlan, "pg");

					$this->Flash->success(__("Non-Listed Doctor Saved to Report Successfull"));
					return $this->redirect(['controller' => 'Mrs','action' => 'dailyReportPgo','?' => ['date' => $reportDate]]);
				}
			}
			else
			{
				$this->Flash->error(__('Non-Listed Doctor could not be saved. Please, try again.'));
				return $this->redirect(['controller' => 'Mrs','action' => 'dailyReportPgo','?' => ['date' => $reportDate]]);
			}
			
        }
			$this->Flash->error(__('Something went wrong. Please, try again.'));
			return $this->redirect(['controller' => 'Mrs','action' => 'dailyReportField']);
   
     }

    public function mrsDeleteReport()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$id = $_POST['id'];
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$workPlan = $this->WorkPlans->get($id, [
				'contain' => []
			]);
			if($workPlan->is_planned == 1 && $workPlan->work_type_id == 2)
			{
				$reportData['products'] = "";
				$reportData['samples'] = "";
				$reportData['gifts'] = "";
				$reportData['visit_time'] = null;
				$reportData['business'] = null;
				$reportData['discussion'] = null;
				$reportData['is_reported'] = 0;
				$workPlan = $this->WorkPlans->patchEntity($workPlan, $reportData);
				$action = $this->WorkPlans->save($workPlan);
			}
			else
			{
				$action = $this->WorkPlans->delete($workPlan);
			}
			if (isset($action)) {
				$this->Flash->success(__('Deleted Successfully.'));
				echo json_encode(array("status"=>1,"msg"=>"Report Saved Successfull")); exit;
			}
			
        }
            $this->Flash->error(__('Unable to delete. Please, try again.'));
			echo json_encode(array("status"=>0,"msg"=>"Unable to delete. Please, try again.")); exit;
     }

    public function finalSaveDailyReport()
	{
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);

        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//pj($data); exit;
			$return = 'dailyReport';
			if(isset($data['return']))
			$return = $data['return'];
			$reportDate = $data['date'];
			$workPlan_ids = array();
			if(isset($data['workplan_id']))
			$workPlan_ids = array_keys($data['workplan_id']);
			if(count($workPlan_ids)<1)
				{
					$this->Flash->error(__('No reports to save.'));
					return $this->redirect(['controller' => 'mrs','action' => $return,'?' => ['date' => $reportDate]]);
				}
			foreach($workPlan_ids as $workPlan_id)
			{	
				$reportData=array();
				$workPlan = $this->WorkPlans->get($workPlan_id, [
					'contain' => []
				]);
				$reportData['is_submitted'] = 1;
				if(isset($data['visit_time'][$workPlan_id]))
				$reportData['visit_time'] = $data['visit_time'][$workPlan_id];
				if(isset($data['business'][$workPlan_id]))
				$reportData['business'] = $data['business'][$workPlan_id];
				
				$reportData['last_updated'] = date("Y-m-d H:i:s");
			
				//pj($reportData);exit;

				$workPlan = $this->WorkPlans->patchEntity($workPlan, $reportData);
				if ($this->WorkPlans->save($workPlan)) {
				}
				else
				{
					$this->Flash->error(__('Something went wrong. Please, try again.'));
					return $this->redirect(['controller' => 'Mrs','action' => $return,'?' => ['date' => $reportDate]]);
				}
					
			} //exit;
			
			$uid = $this->Auth->user('id');
			$lead_id = $this->Auth->user('lead_id');
			$workPlanSubmit = $this->WorkPlanSubmit->newEntity();
				$data=array('date' => $reportDate, 'user_id' => $uid, 'lead_id' => $lead_id );
				$workPlanSubmit = $this->WorkPlanSubmit->patchEntity($workPlanSubmit, $data);
				if ($this->WorkPlanSubmit->save($workPlanSubmit)) {
					$this->Flash->success(__('Reports Submited.'));
					return $this->redirect(['controller' => 'Mrs','action' => $return,'?' => ['date' => $reportDate]]);
				}
				
			$this->Flash->error(__('Failed. Please, try again.'));
			return $this->redirect(['controller' => 'Mrs','action' => $return,'?' => ['date' => $reportDate]]);
        }
	}
	
	public function saveIssuedSamples($sample_array, $workPlan, $type)
	{
		$uid = $this->Auth->user('id');
		foreach ($sample_array as  $sample => $count)
		{
			$haveSample = $this->IssuedSamples->find('all')->where(['plan_id =' => $workPlan->id, 'product_id =' => $sample])->first();
			if($haveSample)
			{
				$issuedSample = $this->IssuedSamples->get($haveSample->id);
				$issuedSample = $this->IssuedSamples->patchEntity($issuedSample, ['count'=> $count ]);
			}
			else
			{
				$issuedSample = $this->IssuedSamples->newEntity();
				$issuedSample = $this->IssuedSamples->patchEntity($issuedSample, ['plan_id' => $workPlan->id, 'product_id' => $sample, 'user_id' => $uid, 'count'=> $count ]);
				if(is_null($type))
				$issuedSample['doctor_id'] = $workPlan->doctor_id;
				else
				$issuedSample['pgother_id'] = $workPlan->pgother_id;
			}
			$this->IssuedSamples->save($issuedSample);
		}
	}
	
	public function saveIssuedGifts($gift_array, $workPlan, $type)
	{
		$uid = $this->Auth->user('id');
		foreach ($gift_array as  $gift => $count)
		{
			$haveGift = $this->IssuedGifts->find('all')->where(['plan_id =' => $workPlan->id, 'gift_id =' => $gift])->first();
			if($haveGift)
			{
				$issuedGift = $this->IssuedGifts->get($haveGift->id);
				$issuedGift = $this->IssuedGifts->patchEntity($issuedGift, ['count'=> $count ]);
			}
			else
			{
				$issuedGift = $this->IssuedGifts->newEntity();
				$issuedGift = $this->IssuedGifts->patchEntity($issuedGift, ['plan_id' => $workPlan->id, 'gift_id' => $gift, 'user_id' => $uid, 'doctor_id'=> $workPlan->doctor_id, 'count'=> $count ]);
				if(is_null($type))
				$IssuedGifts['doctor_id'] = $workPlan->doctor_id;
				else
				$IssuedGifts['pgother_id'] = $workPlan->pgother_id;
			}
			$this->IssuedGifts->save($issuedGift);
		}
	}
	
	public function deleteIssuedSamples($samples, $workPlan)
	{
		$uid = $this->Auth->user('id');
		$condition = array('IssuedSamples.product_id in' => $samples, 'IssuedSamples.plan_id =' => $workPlan->id );
		$this->IssuedSamples->deleteAll($condition,false); 
	}

	public function deleteIssuedGifts($gifts, $workPlan)
	{
		$uid = $this->Auth->user('id');
		$condition = array('IssuedGifts.gift_id in' => $gifts, 'IssuedGifts.plan_id =' => $workPlan->id );
		$this->IssuedGifts->deleteAll($condition,false); 
	}
	
	protected function _checkLeave($start_date, $end_date, $work_type_id, $id)
    {
		$uid = $this->Auth->user('id');
		if($work_type_id ==1)
		{
			$workPlans = $this->WorkPlans->find()->where(['start_date <=' => $start_date,'end_date >=' => $start_date])->orWhere(['start_date <=' => $end_date,'end_date >=' => $end_date])->andWhere(['id <>' => $id, 'user_id =' => $uid])->toarray();
			if(count($workPlans)>0)
			return array(0,'Remove existing plans to plan this day as leave.');
		}
		else
		{
			$workPlans = $this->WorkPlans->find()->where(['start_date =' => $start_date,'work_type_id =' => 1,'id <>' => $id, 'user_id =' => $uid])->toarray();
			if(count($workPlans)>0)
			return array(0,'You cannot plan on leave days.');
		}
		return array(1,'');
    }

	protected function _checkLeaveReport($start_date, $end_date)
    {
		$uid = $this->Auth->user('id');
		$workPlans = $this->WorkPlans->find()->where(['start_date <=' => $start_date,'end_date >=' => $start_date])->orWhere(['start_date <=' => $end_date,'end_date >=' => $end_date])->andWhere(['is_missed =' => '0', 'user_id =' => $uid])->toarray();
		if(count($workPlans)>0)
		return array(0,'Remove plans or reports saved on selected date(s) to report as leave.');
		
		return array(1,'');
    }

	protected function _hasLeave($start_date)
    {
		$uid = $this->Auth->user('id');
		$workPlans = $this->WorkPlans->find()->where(['start_date =' => $start_date,'work_type_id =' => 1, 'user_id =' => $uid])->toarray();
		if(count($workPlans)>0)
		return true;

		return false;
    }


}
