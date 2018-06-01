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
			$user =  $this->Auth->user;
			$state_id = $this->Auth->user('state_id');
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$specialities = $this->Specialities->find('all')->toarray();
			$doctorTypes = $this->DoctorTypes->find('all')->toarray();
			foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
			
			$dates = $this->_datePeriod($start_date, $end_date);
			$WorkPlan_Date = array();
			foreach($dates as $date)
			{
				$plandate= $date." 00:00:00";
				$WorkPlansD = $this->WorkPlans
				->find('all')
				->contain(['WorkTypes', 'Cities', 'Doctors.Specialities'])	
				->where(['WorkPlans.user_id =' => $uid])
				->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.start_date =' => $plandate])->toArray();
				$WorkPlan_Date[$date] = $WorkPlansD;
				$WorkPlansD = array();
			}
			
			$this->set(compact('userCity', 'cities', 'specialities', 'class', 'WorkPlan_Date', 'dates'));        
			
		}
		else
		return $this->redirect(['controller' => 'Reports', 'action' => 'dailyPlan']);
    }

    public function reportSummary(){

		
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


	}
