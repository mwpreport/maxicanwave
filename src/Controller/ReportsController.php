<?php

namespace App\Controller;
use Cake\Core\Configure;

use App\Controller\AppController;
use Cake\Event\Event;
use DateTime;
use DatePeriod;
use DateInterval;


/**
 * Mrs Controller
 */
class ReportsController extends AppController {
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
        $this->loadModel('WorkPlanSubmit');
        $this->loadModel('WorkReports');
        $this->loadModel('WorkTypes');
        $this->loadModel('LeaveTypes');
        $this->loadModel('DoctorsRelation');
        $this->loadModel('DoctorTypes');
        $this->loadModel('Products');
        $this->loadModel('Gifts');
        $this->loadModel('AssignedSamples');
        $this->loadModel('IssuedSamples');
        $this->loadModel('AssignedGifts');
        $this->loadModel('IssuedGifts');
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        if($this->Auth->User()) {
            $currentUserid = $this->Auth->user('id');
        }else{
            return $this->redirect($this->Auth->logout()); 
        }
    }    
    
    public function index()
    {
        $this->set('title', 'Reports');
    }

    public function plan()
    {
        $this->set('title', 'Plan Summary');
    }

    public function planSummary(){
		if(!isset($_REQUEST['type']))
		return $this->redirect(['controller' => 'Reports', 'action' => 'index']);
		
		if(isset($_REQUEST['page-type']))
		{$wrapper = "content";}
		else
		{$wrapper = "ajax";$this->viewBuilder()->layout('iframe');}
		
		
        $this->set('title', 'Plan Summary');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $specialities = $this->Specialities->find('all')->toarray();
		$doctorTypes = $this->DoctorTypes->find('all')->toarray();
		if(isset($_REQUEST['month']) && isset($_REQUEST['year']))
		{
			$m = $_REQUEST['month'];
			$y = $_REQUEST['year'];
			$month = date('M, Y', strtotime($y."-".$m."-01"));
		}
		else
		{
			$month = date('M, Y');
			$m = date("m",strtotime("+1 month"));
			$y = date("Y");
		}
		$start_date = $y."-".$m."-01";
		$end_date = $y."-".$m."-31";
		foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
		$filter = $_REQUEST['type'];
		
        $doctors = $this->paginate($this->DoctorsRelation->find('all')->contain(['DoctorTypes','Doctors.Specialities','Doctors.Cities'])->where(['DoctorsRelation.user_id =' => $uid])->order(['DoctorsRelation.id' => 'ASC']))->toArray();

		foreach($doctors as $doctor) $visits[$doctor->doctor_id] = $this->getVisits($doctor->doctor_id,$uid,$start_date,$end_date);
        //pj($visits);
		$this->set(compact('userCity', 'cities', 'specialities', 'class', 'visits', 'doctors', 'month', 'filter', 'wrapper'));        

		
    }      

    public function getVisits($doctor_id,$uid,$start_date,$end_date){
		$WorkPlansD = $this->WorkPlans->find('all')
		->contain(['WorkTypes', 'Cities', 'Doctors.Specialities'])	
		->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_reported <>' => '1', 'WorkPlans.doctor_id =' => $doctor_id, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_planned =' => '1'])
		->where(['WorkPlans.start_date >=' => $start_date])
		->andWhere(['WorkPlans.start_date <=' => $end_date])->toArray();
		$visits = array_map(function($d) { return date("d", strtotime($d->start_date)); }, $WorkPlansD);
		return (implode("/",$visits));
	}
	
    public function dailyPlan()
    {
        $this->set('title', 'Daily Plan');
    }

    public function dailyPlanReport()
    {
		if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']))
		{
			$start_date = $_REQUEST['start_date'];
			$end_date = $_REQUEST['end_date'];

			//echo $date; exit;
			$this->set('title', 'Daily Report');
			$uid = $this->Auth->user('id');
			$lead_id = $this->Auth->user('lead_id');
			
			$userCity = $this->Auth->user('city_id');
			$user =  $this->Users->get($uid, [ 'contain' => ['Roles', 'States', 'Cities'] ]);
			$state_id = $this->Auth->user('state_id');
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$specialities = $this->Specialities->find('all')->toarray();
			$doctorTypes = $this->DoctorTypes->find('all')->toarray();
			foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
			
			$dates = $this->_datePeriod($start_date, $end_date);
			$workPlansDate = array();
			foreach($dates as $date)
			{
				$plandate= $date." 00:00:00";
				$WorkPlansD = $this->WorkPlans
				->find('all')
				->contain(['WorkTypes', 'Cities', 'Doctors.Specialities'])	
				->where(['WorkPlans.user_id =' => $uid])
				->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.start_date =' => $plandate])->toArray();
				$WorkPlans = $this->WorkPlans
				->find('all')
				->contain(['WorkTypes', 'Cities'])	
				->where(['WorkPlans.user_id =' => $uid,'WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.work_type_id <>' => 2])->andWhere(['WorkPlans.work_type_id <>' => 1])->toArray();
				$WorkPlansL = $this->WorkPlans
				->find('all')
				->contain(['LeaveTypes'])	
				->contain(['WorkTypes', 'Cities'])	
				->where(['WorkPlans.user_id =' => $uid,'WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.work_type_id =' => 1])->toArray();

				if($WorkPlansD)
				$workPlansDate[$date]['field'] = $WorkPlansD;
				if($WorkPlans)
				$workPlansDate[$date]['other'] = $WorkPlans;
				if($WorkPlansL)
				$workPlansDate[$date]['leave'] = $WorkPlansL;
				
				if(!$WorkPlansD && !$WorkPlans && !$WorkPlansL)
				{
					if($this->isSunday($date))
					$workPlansDate[$date]['sunday'] = "Sunday";
					else
					$workPlansDate[$date]['nil'] = "";
				}
				
			}
			
			$this->set(compact('user', 'userCity', 'cities', 'specialities', 'class', 'workPlansDate', 'dates', 'start_date', 'end_date'));        
			
		}
		else
		return $this->redirect(['controller' => 'Reports', 'action' => 'dailyPlan']);
    }

    public function dailyReport()
    {
        $this->set('title', 'Daily Plan');
    }

    public function dailyReportDetails()
    {
		if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']))
		{
			$start_date = $_REQUEST['start_date'];
			$end_date = $_REQUEST['end_date'];

			//echo $date; exit;
			$this->set('title', 'Daily Report');
			$uid = $this->Auth->user('id');
			$lead_id = $this->Auth->user('lead_id');
			
			$userCity = $this->Auth->user('city_id');
			$user =  $this->Users->get($uid, [ 'contain' => ['Roles', 'States', 'Cities'] ]);
			$state_id = $this->Auth->user('state_id');
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$specialities = $this->Specialities->find('all')->toarray();
			$products = $this->Products->find('all')->toarray();
			$doctorTypes = $this->DoctorTypes->find('all')->toarray();
			foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
			$samples = $this->Products->find('all')->toarray();
			$gifts = $this->Gifts->find('all')->toarray();

			
			$dates = $this->_datePeriod($start_date, $end_date);
			$workPlansDate = array();
			foreach($dates as $date)
			{
				$plandate= $date." 00:00:00";
			$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Doctors', 'Doctors.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_planned =' => 1])->toArray();
			
			$WorkPlansUD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Doctors', 'Doctors.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_unplanned =' => 1])->toArray();
			
			$WorkPlansPD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'PgOthers', 'PgOthers.Specialities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1', 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.pgother_id IS NOT' => null, 'WorkPlans.work_type_id IS' => null])->toArray();
			
			$WorkPlans = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1', 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.work_type_id <>' => 2])->andWhere(['WorkPlans.work_type_id <>' => 1])->toArray();

			$WorkPlansL = $this->WorkPlans
			->find('all')
			->contain(['LeaveTypes'])	
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1','WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.work_type_id =' => 1])->toArray();
			
			$WorkPlansC = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Chemists'])	
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.chemist_id IS NOT' => null])->toArray();
			
			$WorkPlansS = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Stockists'])	 
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $plandate, 'WorkPlans.stockist_id IS NOT' => null])->toArray();

				if($WorkPlansD)
				$workPlansDate[$date]['field'] = $WorkPlansD;
				if($WorkPlansUD)
				$workPlansDate[$date]['un_field'] = $WorkPlansUD;
				if($WorkPlansPD)
				$workPlansDate[$date]['pg_field'] = $WorkPlansPD;
				if($WorkPlansC)
				$workPlansDate[$date]['chemist'] = $WorkPlansC;
				if($WorkPlansS)
				$workPlansDate[$date]['stockist'] = $WorkPlansS;
				if($WorkPlans)
				$workPlansDate[$date]['other'] = $WorkPlans;
				if($WorkPlansL)
				$workPlansDate[$date]['leave'] = $WorkPlansL;
				
				if(!$WorkPlansD && !$WorkPlans && !$WorkPlansL)
				{
					if($this->isSunday($date))
					$workPlansDate[$date]['sunday'] = "Sunday";
					else
					$workPlansDate[$date]['nil'] = "";
				}
				
			}
			
			$this->set(compact('user', 'userCity', 'cities', 'specialities', 'class', 'products', 'samples', 'gifts', 'workPlansDate', 'dates', 'start_date', 'end_date'));        
			
		}
		else
		return $this->redirect(['controller' => 'Reports', 'action' => 'dailyPlan']);
    }
       
    public function doctorVisit()
    {
        $this->set('title', 'Doctor Visit Reprot');
    }

    public function doctorVisitReport(){
		if(!isset($_REQUEST['month']))
		return $this->redirect(['controller' => 'Reports', 'action' => 'doctorVisit']);
		
        $this->viewBuilder()->layout('iframe');
        $this->set('title', 'Doctor Visit Reprot');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Users->get($uid, [ 'contain' => ['Roles', 'States', 'Cities'] ]);
		$state_id = $this->Auth->user('state_id');
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $specialities = $this->Specialities->find('all')->toarray();
		$doctorTypes = $this->DoctorTypes->find('all')->toarray();
		
		$months = $_REQUEST['month'];
		$visits = array();
        $doctors = $this->paginate($this->DoctorsRelation->find('all')->contain(['DoctorTypes','Doctors.Specialities','Doctors.Cities'])->where(['DoctorsRelation.user_id =' => $uid])->order(['DoctorsRelation.id' => 'ASC']))->toArray();
		foreach ($months as $month) {
			list($M,$m,$y) = explode("-",date('M-m-y', strtotime("-$month month")));
			$start_date = $y."-".$m."-01";
			$end_date = $y."-".$m."-31";
			foreach($doctors as $doctor) 
			$visits[$M."-".$y][$doctor->doctor_id] = $this->getVisits($doctor->doctor_id,$uid,$start_date,$end_date);

		}
		foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
		

        //pj($visits);
		$this->set(compact('userCity', 'cities', 'specialities', 'class', 'visits', 'doctors', 'user'));        

		
    }      

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

	protected function isSunday($date) {
		$weekDay = date('w', strtotime($date));
		return ($weekDay == 0);
	}

	}
