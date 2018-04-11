<?php

namespace App\Controller;
use Cake\Core\Configure;

use App\Controller\AppController;
use Cake\Event\Event;


/**
 * Mrs Controller
 */
class MrsController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Roles');
        $this->loadModel('Specialities');
        $this->loadModel('States');
        $this->loadModel('Cities');
        $this->loadModel('Doctors');
        $this->loadModel('Chemists');
        $this->loadModel('Stockists');
        $this->loadModel('PgOthers');
        $this->loadModel('WorkPlans');
        $this->loadModel('WorkPlanApproval');
        $this->loadModel('WorkReports');
        $this->loadModel('WorkTypes');
        $this->loadModel('LeaveTypes');
        $this->loadModel('DoctorsRelation');
        $this->loadModel('DoctorTypes');
        $this->loadModel('Products');
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        if($this->Auth->User()) {
            $currentUserid = $this->Auth->user('id');
        }else{
            return $this->redirect($this->Auth->logout()); 
        }
    }    
    
    public function dashboard(){
        $this->set('title', 'Doctor Visit Report');        
    }      

    public function doctorList(){
        $this->set('title', 'Doctor List');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $specialities = $this->Specialities->find('all')->toarray();
        $doctorTypes = $this->DoctorTypes->find('all')->toarray();
        $states = $this->States->find('all')->where(['id =' => $state_id])->toarray();
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $doctorsRelation = $this->paginate($this->DoctorsRelation->find('all')->contain(['DoctorTypes','Doctors.Specialities','Doctors.Cities'])->where(['DoctorsRelation.user_id =' => $uid])->order(['DoctorsRelation.id' => 'ASC']));
        $doctors = $this->Doctors
			->find()
			->notMatching('DoctorsRelation', function ($q) use ($uid) {
				return $q->where(['DoctorsRelation.user_id' => $uid]);
			})->where(['city_id =' => $userCity, 'is_approved =' => '1']);
        //pj($doctors);exit;
        $this->set(compact('userCity', 'specialities', 'states', 'cities', 'doctorsRelation', 'doctors', 'doctorTypes'));            
    }
	
    public function doctorSelection(){
        $this->set('title', 'Doctor Visit Report');        
    }      

	public function monthlyplan(){
        $this->viewBuilder()->layout('monthlyplan');
        $this->set('title', 'Monthly Plan');
        $uid = $this->Auth->user('id');
		$lead_id = $this->Auth->user('lead_id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $workTypes = $this->WorkTypes->find()->order(['list' => 'ASC'])->toarray();
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $doctorsRelation = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid, 'Doctors.city_id' => $userCity])->contain(['Doctors']);
        $leaveTypes = $this->LeaveTypes->find()->toarray();
		$thisDate = date("Y")."-".sprintf("%02d", (date("m")+1))."-01";
        $workPlanApproval = $this->WorkPlanApproval->find('all')->where(['WorkPlanApproval.user_id =' => $uid, 'WorkPlanApproval.lead_id =' => $lead_id, 'WorkPlanApproval.date =' => $thisDate])->first();
        $this->set(compact('userCity', 'workTypes', 'leaveTypes', 'cities', 'doctorsRelation', 'workPlanApproval', 'thisDate'));        
    }
    
	public function workPlan($id = null){
		$workPlanApproval = $this->WorkPlanApproval->find('all')->where(['id =' => $id])->first();
		$uid = $this->Auth->user('id');
		if ($workPlanApproval) {
			$this->viewBuilder()->layout('monthlyplan');
			$user = $this->Users->find('all')->where(['id =' => $workPlanApproval->user_id])->first();
			$this->set('title', 'Monthly Plan of '.$user->firstname);
			$user_id = $user->id;
			$lead_id = $user->lead_id;
			$userCity = $user->city_id;
			$state_id = $user->state_id;
			$workTypes = $this->WorkTypes->find()->order(['list' => 'ASC'])->toarray();
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$doctorsRelation = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $user_id, 'Doctors.city_id' => $userCity])->contain(['Doctors']);
			$leaveTypes = $this->LeaveTypes->find()->toarray();
			$thisDate = date("Y")."-".sprintf("%02d", (date("m")+1))."-01";
			$this->set(compact('user_id', 'userCity', 'workTypes', 'leaveTypes', 'cities', 'doctorsRelation', 'workPlanApproval', 'thisDate'));        
		}
		else
		return $this->redirect(["controller" => "Mrs","action" => "workPlanRequests"]);
    }
    
	public function workPlanRequests(){
        $this->set('title', 'Plan Requests for Approval');
        $uid = $this->Auth->user('id');
		$lead_id = $this->Auth->user('lead_id');
		$thisDate = date("Y")."-".sprintf("%02d", (date("m")+1))."-01";
        $workPlansApproval = $this->paginate($this->WorkPlanApproval->find('all')->contain(['Users','Users.States','Users.Cities'])->where(['WorkPlanApproval.lead_id =' => $uid, 'WorkPlanApproval.date =' => $thisDate, 'WorkPlanApproval.is_approved =' => 0, 'WorkPlanApproval.is_rejected =' => 0]));
        $this->set(compact('workPlansApproval', 'thisDate'));        
    }
    
    public function planGetDoctors()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$id = $data['id'];
		$city_id = $data['city_id'];
		$start_date = $data['start_date'];
		
		$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities', 'Doctors'])	
			->select('doctor_id')->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2])->toArray();
		$doctor_ids=array_map(function($d) { return $d->doctor_id; }, $WorkPlansD);
		$doctor_ids[]=0;

		$doctors = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid, 'DoctorsRelation.doctor_id NOT IN' => $doctor_ids, 'Doctors.city_id' => $city_id])->contain(['Doctors']);
		$listHtml='';
		foreach ($doctors as $doctor)
		$listHtml.='<option value="'.$doctor->doctor_id.'">'.$doctor->doctor->name.'</option>';
		echo $listHtml; exit;
    }
    
    public function dailyReport()
    {
        $this->set('title', 'Daily Report');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $specialities = $this->Specialities->find('all')->toarray();
		$products = $this->Products->find('all')->toarray();
		$date = "";
		$workTypes = $this->WorkTypes->find()->where(['WorkTypes.id >' => '2'])->order(['list' => 'ASC'])->toarray();
		$WorkPlans = array();
		$doctorsRelation = array();

		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$start_date = $date." 00:00:00";
			$end_date = $date." 23:59:00";
						
			$WorkPlans = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id <>' => 2])->toArray();
			
		}
		$leaveTypes = $this->LeaveTypes->find()->toarray();
        $this->set(compact('userCity', 'cities', 'specialities', 'leaveTypes', 'products', 'doctorsRelation', 'workTypes', 'WorkPlans', 'date'));        
		
    }

    public function dailyReportField()
    {
        $this->set('title', 'Daily Report');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $specialities = $this->Specialities->find('all')->toarray();
		$products = $this->Products->find('all')->toarray();
		$date = "";
		$workTypes = $this->WorkTypes->find()->where(['WorkTypes.id >' => '2'])->toarray();
		$WorkPlansD = array();
		$WorkPlans = array();
		$doctorsRelation = array();
		$chemists = array();
		$stockists = array();

		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$start_date = $date." 00:00:00";
			$end_date = $date." 23:59:00";
			
			
			$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities', 'Doctors.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2]);
			$reported_doctors=array_map(function($d) { return $d->doctor_id; }, $WorkPlansD->toArray()); $reported_doctors[]=0;
			$WorkPlansD = $WorkPlansD->where(['WorkPlans.is_planned =' => '1'])->toArray();
			$doctorsRelation = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid, 'DoctorsRelation.doctor_id NOT IN' => $reported_doctors, 'Doctors.city_id' => $userCity])->contain(['Doctors'])->toArray();


			
			$WorkPlans = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id <>' => 2])->toArray();
			
			$WorkPlansC = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Chemists'])	
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.chemist_id IS NOT' => null])->toArray();
			$reported_chemists=array_map(function($c) { return $c->chemist_id; }, $WorkPlansC); $reported_chemists[]=0;
			$chemists = $this->Chemists->find('all')->where(['city_id =' => $userCity, 'Chemists.id NOT IN' => $reported_chemists])->toarray();

			
			$WorkPlansS = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Stockists'])	 
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.stockist_id IS NOT' => null])->toArray();
			$reported_stockists=array_map(function($s) { return $s->stockist_id; }, $WorkPlansC); $reported_stockists[]=0;
			$stockists = $this->Stockists->find('all')->where(['city_id =' => $userCity, 'Stockists.id NOT IN' => $reported_stockists])->toarray();
		$leaveTypes = $this->LeaveTypes->find()->toarray();

        $this->set(compact('userCity', 'cities', 'specialities', 'leaveTypes', 'products', 'chemists', 'stockists', 'doctorsRelation', 'workTypes', 'WorkPlansD', 'WorkPlans', 'date'));        
			
		}
		else
		return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport']);
	
		
    }
    
    public function viewDailyReport()
    {
        $this->set('title', 'Daily Report');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
		$products = $this->Products->find('all')->toarray();
		$date = "";
		$html = "";
		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$start_date = $date." 00:00:00";
			$end_date = $date." 23:59:00";
			
			$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Doctors', 'Doctors.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_planned =' => 1])->toArray();
			
			$WorkPlansUD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Doctors', 'Doctors.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_unplanned =' => 1])->toArray();
			
			$WorkPlansPD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'PgOthers', 'PgOthers.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.pgother_id IS NOT' => null, 'WorkPlans.work_type_id IS' => null])->toArray();
			
			$WorkPlans = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid,'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id <>' => 2])->andWhere(['WorkPlans.work_type_id <>' => 1])->toArray();

			$WorkPlansL = $this->WorkPlans
			->find('all')
			->contain(['LeaveTypes'])	
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid,'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id =' => 1])->toArray();
			
			$WorkPlansC = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Chemists'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.chemist_id IS NOT' => null])->toArray();
			
			$WorkPlansS = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Stockists'])	 
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.stockist_id IS NOT' => null])->toArray();
			
		}
		
        $this->set(compact('userCity', 'cities', 'specialities', 'leaveTypes', 'products', 'chemists', 'stockists', 'doctorsRelation', 'workTypes', 'WorkPlans', 'date', 'WorkPlansD', 'WorkPlansUD', 'WorkPlansC', 'WorkPlansS', 'WorkPlansL', 'WorkPlansPD'));        
        
		
    }

    public function finalSubmitReport()
    {
        $this->set('title', 'Final Submit');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
		$products = $this->Products->find('all')->toarray();
		$date = "";
		$html = "";
		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$start_date = $date." 00:00:00";
			$end_date = $date." 23:59:00";
			
			$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Doctors', 'Doctors.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_planned =' => 1])->toArray();
			
			$WorkPlansUD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Doctors', 'Doctors.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_unplanned =' => 1])->toArray();
			
			$WorkPlansPD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'PgOthers', 'PgOthers.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.pgother_id IS NOT' => null, 'WorkPlans.work_type_id IS' => null])->toArray();
			
			$WorkPlans = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid,'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id <>' => 2])->andWhere(['WorkPlans.work_type_id <>' => 1])->toArray();

			$WorkPlansL = $this->WorkPlans
			->find('all')
			->contain(['LeaveTypes'])	
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid,'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id =' => 1])->toArray();
			
			$WorkPlansC = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Chemists'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.chemist_id IS NOT' => null])->toArray();
			
			$WorkPlansS = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Stockists'])	 
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.stockist_id IS NOT' => null])->toArray();
			
		}
		
        $this->set(compact('userCity', 'cities', 'specialities', 'leaveTypes', 'products', 'chemists', 'stockists', 'doctorsRelation', 'workTypes', 'WorkPlans', 'date', 'WorkPlansD', 'WorkPlansUD', 'WorkPlansC', 'WorkPlansS', 'WorkPlansL', 'WorkPlansPD'));        
        
		
    }
	
    public function reportGetDoctors()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$city_id = $data['city_id'];
		$start_date = $data['start_date'];
		
		$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities', 'Doctors'])	
			->select('doctor_id')->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2])->toArray();
		$doctor_ids=array_map(function($d) { return $d->doctor_id; }, $WorkPlansD);
		$doctor_ids[]=0;

		$doctors = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid, 'DoctorsRelation.doctor_id NOT IN' => $doctor_ids, 'Doctors.city_id' => $city_id])->contain(['Doctors']);
		$listHtml='<option value="">Select Doctors</option>';
		foreach ($doctors as $doctor)
		$listHtml.='<option value="'.$doctor->doctor_id.'">'.$doctor->doctor->name.'</option>';
		echo $listHtml; exit;
    }

    public function reportGetChemists()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$city_id = $data['city_id'];
		$start_date = $data['start_date'];
			
		$WorkPlansC = $this->WorkPlans
		->find('all')
		->contain(['Cities', 'Chemists'])	
		->where(['WorkPlans.user_id =' => $uid])
		->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.chemist_id IS NOT' => null])->toArray();
		$chemist_ids=array_map(function($c) { return $c->chemist_id; }, $WorkPlansC);
		$chemist_ids[]=0;
			
		$chemists = $this->Chemists->find('all')->where(['city_id =' => $city_id, 'id NOT IN' => $chemist_ids])->toarray();
		$listHtml='<option value="">Select Chemists</option>';
		foreach ($chemists as $chemist)
		$listHtml.='<option value="'.$chemist['id'].'">'.$chemist['name'].'</option>';
		
		echo $listHtml; exit;
    }

    public function reportGetStockists()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$city_id = $data['city_id'];
		$start_date = $data['start_date'];
		
		$WorkPlansS = $this->WorkPlans
		->find('all')
		->contain(['Cities', 'Stockists'])	 
		->where(['WorkPlans.user_id =' => $uid])
		->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.stockist_id IS NOT' => null])->toArray();
		$stockist_ids=array_map(function($c) { return $c->stockist_id; }, $WorkPlansS);
		$stockist_ids[]=0;
		
		$stockists = $this->Stockists->find('all')->where(['city_id =' => $city_id, 'id NOT IN' => $stockist_ids])->toarray();
		$listHtml='<option value="">Select Stockists</option>';
		foreach ($stockists as $stockist)
		$listHtml.='<option value="'.$stockist['id'].'">'.$stockist['name'].'</option>';
		
		echo $listHtml; exit;
    }

	}
