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
        $this->loadModel('Workreports');
        $this->loadModel('WorkTypes');
        $this->loadModel('Users');
        $this->loadModel('City');
        $this->loadModel('Doctors');
        $this->loadModel('Roles');
		$this->loadModel('Products');
		
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
	
	protected function _checkLeave($start_date, $end_date, $work_type_id, $id)
    {
		if($work_type_id ==1)
		{
			$workPlans = $this->WorkPlans->find()->where(['start_date <=' => $start_date,'end_date >=' => $start_date])->orWhere(['start_date <=' => $end_date,'end_date >=' => $end_date])->andWhere(['id <>' => $id])->toarray();
			if(count($workPlans)>0)
			return array(0,'Remove existing plans to plan this day as leave.');
		}
		else
		{
			$workPlans = $this->WorkPlans->find()->where(['start_date =' => $start_date,'work_type_id =' => 1,'id <>' => $id])->toarray();
			if(count($workPlans)>0)
			return array(0,'You cannot plan on leave days.');
		}
		return array(1,'');
    }


    public function mrsView($id = null)
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
        $startDate=$_GET['start']." 00:00:00";
        $endDate=$_GET['end']." 23:59:00";
        $workPlans = $this->WorkPlans->find()->contain(['Doctors'])
					->where(['start_date >= ' => $startDate,'end_date < ' => $endDate])
					->where(['WorkPlans.user_id' => $uid]);
        
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
			$data['start_date'] = $_POST['start_date']." 00:00:00";
			if( $_POST['end_date']=="")$_POST['end_date'] = $_POST['start_date'];
			$data['end_date'] = $_POST['end_date']." 23:59:00";
			
			

            list($status, $error)=$this->_checkLeave($data['start_date'],$data['end_date'],$data['work_type_id'],0);
            if(!$status)
            {echo json_encode(array("status"=>$status,"error"=>$error)); exit;}
			
			
            
			if($data['work_type_id'] ==1)
			{
				
				$dates[]=$this->_datePeriod($data['start_date'], $data['end_date']);
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
		->contain(['WorkTypes', 'Cities'])	
		->where(['WorkPlans.user_id =' => $uid])
		->where(['WorkPlans.start_date =' => $start_date])->toArray();
		$html = "";
		if(count($WorkPlans))
		{
			$i=1;$html.='<table class="table table-striped table-bordered table-hover"><thead><tr><th>S.No</th><th>Work Type</th><th>City</th></tr></thead><tbody>';
			foreach ($WorkPlans as $WorkPlan)
			{
				$html.='<tr><td class="text-center">'.$i.'</td><td><input type="hidden" name="selected_plan_id[]" value="'.$WorkPlan->id.'">'.$WorkPlan->work_type->name.'</td><td>'.$WorkPlan->city->city_name.'</td></tr>';
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
		->contain(['WorkTypes', 'Cities'])	
		->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.work_type_id <>' => 1])
		->where(['WorkPlans.start_date =' => $start_date])->toArray();
		$html = "";
		if(count($WorkPlans))
		{
			$i=1;$html.='<table class="table table-striped table-bordered table-hover"><thead><tr><th>S.No</th><th>Work Type</th><th>City</th></tr></thead><tbody>';
			foreach ($WorkPlans as $WorkPlan)
			{
				$html.='<tr><td class="text-center">'.$i.'</td><td><input type="hidden" name="selected_plan_id[]" value="'.$WorkPlan->id.'">'.$WorkPlan->work_type->name.'</td><td>'.$WorkPlan->city->city_name.'</td></tr>';
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
		$id = $_POST['selected_plan_id'];
		$start_date = $_POST['copyto']." 00:00:00";
        $end_date = $_POST['copyto']." 23:59:00";
		$returnArray = array();
		
		$workPlan = $this->WorkPlans->find()
			->where(['id IN' => $id])->first();
		
		if($workPlan['work_type_id'] !=1)
		{
			if($this->_checkLeave($start_date,$workPlan->id))
			{
			echo json_encode(array("success"=>0,"error"=>'You cannot move plans to leave days.')); exit;
			}
		}

		$WorkPlansTable = $this->WorkPlans;
		if ($WorkPlansTable->updateAll( array('start_date' => $start_date,'end_date' => $end_date), array('id IN' => $id))) {
			$returnArray = array('success' => "1",'eventIDs' => $id);
		}
		echo json_encode($returnArray); 
		exit;   
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

        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			$reportDate = $data['reportDate'];
			$workPlan_ids = array_keys($data['workplan_id']);
			foreach($workPlan_ids as $workPlan_id)
			{	
				$reportData=array();
				$workPlan = $this->WorkPlans->get($workPlan_id, [
					'contain' => []
				]);
				if(isset($data['work_with'][$workPlan_id]))
				$reportData['work_with']=$data['work_with'][$workPlan_id];
			
				if(isset($data['missed_reason'][$workPlan_id]) && $data['missed_reason'][$workPlan_id] != "")
				{
					$reportData['missed_reason']=$data['missed_reason'][$workPlan_id];
					$reportData['is_missed'] = 1;
				}
				if(isset($data['is_cancelled'][$workPlan_id]))
				$reportData['is_cancelled']=$data['is_cancelled'][$workPlan_id];
			
				if(isset($data['pdt_val'][$workPlan_id]) && $data['pdt_val'][$workPlan_id] != "")
				$reportData['products']=serialize(explode(",",$data['pdt_val'][$workPlan_id]));
			
				$reportData['is_reported'] = 1;
				$reportData['last_updated'] = date("Y-m-d H:i:s");
			
			//pj($reportData);exit;

				$workPlan = $this->WorkPlans->patchEntity($workPlan, $reportData);
				if ($this->WorkPlans->save($workPlan)) {
				}
				else
				{
					$this->Flash->error(__('The work plan could not be saved. Please, try again.'));
					return $this->redirect(['controller' => 'mrs','action' => 'daily-report','?' => ['date' => $reportDate]]);
				}
					
			} //exit;
			$this->Flash->success(__('The work plan has been saved.'));
			return $this->redirect(['controller' => 'mrs','action' => 'daily-report','?' => ['date' => $reportDate]]);
        }
	}

    public function mrsAddReport()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$workPlan = $this->WorkPlans->newEntity();
        if ($this->request->is('post')) {
			$data = array('user_id' => $uid, 'work_type_id' => $_POST['work_type_id'], 'start_date' => $_POST['start_date'], 'city_id' => $_POST['city_id']);
			$data['start_date'] = $_POST['start_date']." 00:00:00";
			$data['end_date'] = $_POST['start_date']." 23:59:00";
			$data['is_reported'] = 1;
			$data['last_updated'] = date("Y-m-d H:i:s");
			
			/*
            list($status, $error)=$this->_checkLeave($data['start_date'],$data['end_date'],$data['work_type_id'],0);
            if(!$status)
            {echo json_encode(array("status"=>$status,"msg"=>$error)); exit;}
            */
			if($data['work_type_id'] == "" && !isset($_POST['chemist_id']) && !isset($_POST['stockist_id']))
			{echo json_encode(array("status"=>0,"msg"=>'The report could not be saved. Please, try again.')); exit;}
            
			if($data['work_type_id'] ==1)
			{
				// for emergency leave
			}
			elseif($data['work_type_id'] == 2 && isset($_POST['doctor_id']))
			{
				$doctor_ids = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : array();
				foreach ($doctor_ids as $doctor_id)
				{
					$plan_data = $data;
					$plan_data['doctor_id'] = $doctor_id;
					$plan_data['is_unplanned'] = 1;
					$plan_data['is_approved'] = 1;
					$workPlans_array[] = $plan_data;
				}

				$entities = $this->WorkPlans->newEntities($workPlans_array);
				$_results = $this->WorkPlans->saveMany($entities);
				$this->Flash->success(__('Unplanned Doctor(s) Saved Successfully'));
				echo json_encode(array("status"=>1,"msg"=>"Unplanned Doctor(s) Saved Successfully")); exit;
			}
			elseif($data['work_type_id'] == "" && isset($_POST['chemist_id']))
			{
				$chemist_ids = isset($_POST['chemist_id']) ? $_POST['chemist_id'] : array();
				foreach ($chemist_ids as $chemist_id)
				{
					$plan_data = $data;
					$plan_data['chemist_id'] = $chemist_id;
					$workPlans_array[] = $plan_data;
				}

				$entities = $this->WorkPlans->newEntities($workPlans_array);
				$_results = $this->WorkPlans->saveMany($entities);
				$this->Flash->success(__("Chemist(s) Saved Successfully"));
				echo json_encode(array("status"=>1,"msg"=>"Chemist(s) Saved Successfully")); exit;
			}
			elseif($data['work_type_id'] == "" && isset($_POST['stockist_id']))
			{
				$stockist_ids = isset($_POST['stockist_id']) ? $_POST['stockist_id'] : array();
				foreach ($stockist_ids as $stockist_id)
				{
					$plan_data = $data;
					$plan_data['stockist_id'] = $stockist_id;
					$workPlans_array[] = $plan_data;
				}

				$entities = $this->WorkPlans->newEntities($workPlans_array);
				$_results = $this->WorkPlans->saveMany($entities);
				$this->Flash->success(__("Stockist(s) Saved Successfully"));
				echo json_encode(array("status"=>1,"msg"=>"Stockist(s) Saved Successfully")); exit;
			}
			elseif($data['work_type_id'] != 2 && $data['work_type_id'] != 1 && $data['work_type_id'] != "")
			{
				$workPlan = $this->WorkPlans->patchEntity($workPlan, $data);
				if ($this->WorkPlans->save($workPlan)) {
					$id = $workPlan->id;
					$WorkTypes = $this->WorkPlans->WorkTypes->find()->select(['name', 'color'])->where(['id =' => $workPlan->work_type_id])->first();
					$returnArray[] = array('id'=>$id, 'start'=>$workPlan->start_date ,'end'=>$workPlan->end_date ,'title'=>$WorkTypes['name'], 'color'=>$WorkTypes['color']); 
					$this->Flash->success(__("Report Saved Successfull"));
					echo json_encode(array("status"=>1,"msg"=>"Report Saved Successfull")); exit;
				}
				else
				{$this->Flash->error(__('The report could not be saved. Please, try again.'));echo json_encode(array("status"=>0,"msg"=>'The report could not be saved. Please, try again.')); exit;}
			}
			
        }
		exit;   
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
            $workPlan = $this->WorkPlans->patchEntity($workPlan, array('is_deleted' => '1'));
            if ($this->WorkPlans->save($workPlan)) {
                $this->Flash->success(__('Deleted Successfully.'));
				echo json_encode(array("status"=>1,"msg"=>"Report Saved Successfull")); exit;
            }
        }
            $this->Flash->error(__('Unable to delete. Please, try again.'));
			echo json_encode(array("status"=>0,"msg"=>"Unable to delete. Please, try again.")); exit;
     }
}
