<?php
namespace App\Controller;

use App\Controller\AppController;

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
	protected function _checkLeave($start_date, $id)
    {
		$workPlans = $this->WorkPlans->find()->where(['start_date <=' => $start_date,'end_date >=' => $start_date,'work_type_id =' => 1,'id <>' => $id])->toarray();
		if(count($workPlans)>0)
		return true;
    }
    
	protected function _leaveCheck($start_date, $end_date, $id)
    {
		$workPlans = $this->WorkPlans->find()->where(['start_date <=' => $start_date,'end_date >=' => $start_date])->orWhere(['start_date <=' => $end_date,'end_date >=' => $end_date])->andWhere(['id <>' => $id])->toarray();
		if(count($workPlans)>0)
		return true;
	
    }


    public function mrsView($id = null)
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
        $workPlan = $this->WorkPlans->find()->contain(['Doctors'])->where(['user_id' => $uid]);
		//$city->has('state') ? $this->Html->link($city->state->name, ['controller' => 'States', 'action' => 'view', $city->state->id]) : '';
		foreach($workPlan as $event)
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
            if( $_POST['end_date']=="" || $data['work_type_id'] !=1 )$_POST['end_date'] = $_POST['start_date'];

            $data['end_date'] = $_POST['end_date']." 23:59:00";
            
            if($data['work_type_id'] !=1)
			{
				if($this->_checkLeave($data['start_date'],0))
				{
				echo json_encode(array("status"=>0,"error"=>'You cannot plan on leave days.')); exit;
				}
				
			}
			else
			{
				if($this->_leaveCheck($data['start_date'],$data['end_date'],0))
				{
				echo json_encode(array("status"=>0,"error"=>'Remove existing plans to plan this day as leave.')); exit;
				}
			}
			
            
			if(isset($_POST['doctor_id']))
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
			else
			{
				$workPlan = $this->WorkPlans->patchEntity($workPlan, $data);
				if ($this->WorkPlans->save($workPlan)) {
					$id = $workPlan->id;
					$WorkTypes = $this->WorkPlans->WorkTypes->find()->select(['name', 'color'])->where(['id =' => $workPlan->work_type_id])->first();
					$returnArray[] = array('id'=>$id, 'start'=>$workPlan->start_date ,'end'=>$workPlan->end_date ,'title'=>$WorkTypes['name'], 'color'=>$WorkTypes['color']); 
					echo json_encode(array("status"=>1,"events"=>$returnArray)); exit;
				}
				else
				{echo json_encode(array("status"=>1,"error"=>'The work plan could not be saved. Please, try again.')); exit;}
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
            if( $_POST['end_date']=="" || $workPlan->work_type_id !=1 )$_POST['end_date'] = $_POST['start_date'];
            $workPlan->end_date = $_POST['end_date']." 23:59:00";
			
            if($workPlan['work_type_id'] !=1)
			{
				if($this->_checkLeave($workPlan['start_date'],$workPlan->id))
				{
				echo json_encode(array("status"=>0,"error"=>'You cannot plan on leave days.')); exit;
				}
				
			}
			else
			{
				if($this->_leaveCheck($workPlan['start_date'],$workPlan['end_date'],$workPlan->id))
				{
				echo json_encode(array("status"=>0,"error"=>'Remove existing plans to plan this day as leave.')); exit;
				}
			}

			
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
		
		$WorkPlansTable = $this->WorkPlans;
		//pj($WorkPlans); exit;
		if ($WorkPlansTable->updateAll( array('start_date' => $start_date,'end_date' => $end_date), array('id IN' => $id))) {
			$returnArray = array('success' => "1",'eventIDs' => $id);
		}
		echo json_encode($returnArray); 
		exit;   
     }

	
}
