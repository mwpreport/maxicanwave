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
        $this->loadModel('Expenses');
        $this->loadModel('ExpenseTypes');
        $this->loadModel('DailyAllowances');
        $this->loadModel('CityDistances');
        $this->loadModel('OtherAllowances');
        $this->loadModel('OtherExpenses');
        $this->loadModel('Holidays');        
        $this->loadModel('ExpenseApprovals');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        if($this->Auth->User()) {
            $currentUserid = $this->Auth->user('id');
        }else{
            return $this->redirect($this->Auth->logout());
        }
    }

    public function index(){
        $this->set('title', 'Dashboard');

        $month = date('M - Y');
		$start_date = date('Y-m-01')."00:00:00";
		$end_date = date('Y-m-t')."23:59:59	";

		$uid = $this->Auth->user('id');
		$lead_id = $this->Auth->user('lead_id');
		$user =  $this->Users->get($uid, [ 'contain' => ['Roles', 'States', 'Cities'] ]);

		$dates = $this->_datePeriod($start_date, $end_date);
		$reportedDates = array(0); $doctorCalls = 0; $chemistCalls = 0; $visited = array();

		$today_eod = strtotime(date("Y-m-d 23:59:59")); // or your date as well
		$datediff = $today_eod - strtotime($start_date);
		$coveredDays = round($datediff / (60 * 60 * 24));



		foreach($dates as $date)
		{
			$reportedPlans = $this->WorkPlans->find('list')
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1', 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $date])->toArray();
			if($reportedPlans)$reportedDates[] = "'".date("m/d/Y", strtotime($date))."'";

				$WorkPlansD = $this->WorkPlans
				->find('list')
				->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_planned =' => 1])->toArray();

				$WorkPlansUD = $this->WorkPlans
				->find('list')
				->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_unplanned =' => 1])->toArray();

				$WorkPlansPD = $this->WorkPlans
				->find('list')
				->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1', 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $date, 'WorkPlans.pgother_id IS NOT' => null, 'WorkPlans.work_type_id IS' => null])->toArray();

				$WorkPlansC = $this->WorkPlans
				->find('list')
				->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_submitted =' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $date, 'WorkPlans.chemist_id IS NOT' => null])->toArray();

				$doctorCalls+= count($WorkPlansD) + count($WorkPlansUD) +  count($WorkPlansPD);
				$chemistCalls+= count($WorkPlansC);

		}
		$doctors = $this->paginate($this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid])->order(['DoctorsRelation.id' => 'ASC']))->toArray();
		foreach($doctors as $doctor)
		{
			$visited[] = $doctor->doctor_id;
		}

		$doctorsAvarage = $doctorCalls/$coveredDays;
		$chemistAvarage = $chemistCalls/$coveredDays;
		$doctorsCoverage = count($visited);
		$this->set(compact('user', 'reportedDates', 'doctorsAvarage', 'chemistAvarage', 'doctorsCoverage'));
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
			})->where(['city_id =' => $userCity]);
        //pj($doctors);exit;
        $this->set(compact('userCity', 'specialities', 'states', 'cities', 'doctorsRelation', 'doctors', 'doctorTypes'));
    }

    public function getReports($doctor_id,$uid,$start_date,$end_date){
		$WorkPlansD = $this->WorkPlans->find('all')
		->contain(['WorkTypes', 'Cities', 'Doctors.Specialities'])
		->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.doctor_id =' => $doctor_id, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_submitted =' => '1'])
		->where(['WorkPlans.start_date >=' => $start_date])
		->andWhere(['WorkPlans.start_date <=' => $end_date])->toArray();
		$visits = array_map(function($d) { return date("d", strtotime($d->start_date)); }, $WorkPlansD);
		return (implode("/",$visits));
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
        $holidayArray = $this->holidayArray();
        $this->set(compact('userCity', 'workTypes', 'leaveTypes', 'cities', 'doctorsRelation', 'workPlanApproval', 'thisDate', 'holidayArray'));        

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

	public function workPlanSubmits(){
        $this->set('title', 'Plan Requests for Approval');
        $uid = $this->Auth->user('id');
		$lead_id = $this->Auth->user('lead_id');
		$thisDate = date("Y")."-".sprintf("%02d", (date("m")+1))."-01";
        $workPlansSubmit = $this->paginate($this->WorkPlanSubmit->find('all')->contain(['Users','Users.States','Users.Cities'])->where(['WorkPlanSubmit.lead_id =' => $uid, 'WorkPlanSubmit.date =' => $thisDate, 'WorkPlanSubmit.is_approved =' => 0, 'WorkPlanSubmit.is_rejected =' => 0]));
        $this->set(compact('workPlansSubmit', 'thisDate'));
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
		$lead_id = $this->Auth->user('lead_id');
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
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id <>' => 2])->andWhere(['WorkPlans.work_type_id <>' => 1])->toArray();

			$WorkPlansL = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id =' => 1])->toArray();

			$workPlanSubmit = $this->WorkPlanSubmit->find('all')->where(['WorkPlanSubmit.user_id =' => $uid, 'WorkPlanSubmit.lead_id =' => $lead_id, 'WorkPlanSubmit.date =' => $date])->first();

		}
		$hasLeave = $this->_hasPlannedLeave($date);
		$leaveTypes = $this->LeaveTypes->find()->toarray();
        $this->set(compact('userCity', 'cities', 'specialities', 'leaveTypes', 'products', 'doctorsRelation', 'workTypes', 'WorkPlans', 'WorkPlansL', 'workPlanSubmit', 'date','hasLeave'));

    }

    public function dailyReportField()
    {
		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$this->set('title', 'Daily Report');
			$uid = $this->Auth->user('id');
			$lead_id = $this->Auth->user('lead_id');
			$hasLeave = $this->_hasLeave($date);
			$workPlanSubmit = $this->WorkPlanSubmit->find('all')->where(['WorkPlanSubmit.user_id =' => $uid, 'WorkPlanSubmit.lead_id =' => $lead_id, 'WorkPlanSubmit.date =' => $date])->first();
			if($workPlanSubmit || $hasLeave) {return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport','?' => ['date' => $date]]);}

			$userCity = $this->Auth->user('city_id');
			$user =  $this->Auth->user;
			$state_id = $this->Auth->user('state_id');
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$specialities = $this->Specialities->find('all')->toarray();
			$doctorTypes = $this->DoctorTypes->find('all')->toarray();
			foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
			$products = $this->Products->find('all')->toarray();
			$samples = $this->AssignedSamples->find('all');
			$samples = $samples->select(['id' => 'product_id', 'name' => 'Products.name', 'count' => $samples->func()->sum('AssignedSamples.count')])->where(['AssignedSamples.user_id' => $uid])->contain(['Products'])->group('AssignedSamples.product_id')->toarray();
			$i_samples = $this->IssuedSamples->find('all');
			$i_samples = $i_samples->select(['id' => 'product_id' , 'count' => $i_samples->func()->sum('IssuedSamples.count')])->where(['IssuedSamples.user_id' => $uid])->group('IssuedSamples.product_id')->toarray();
			foreach($i_samples as $sample) $i_sample[$sample->id] = $sample->count;
			$gifts = $this->AssignedGifts->find('all');
			$gifts = $gifts->select(['id' => 'gift_id' , 'name' => 'Gifts.name', 'count' => $gifts->func()->sum('AssignedGifts.count')])->where(['AssignedGifts.user_id' => $uid])->contain(['Gifts'])->group('AssignedGifts.gift_id')->toarray();
			$i_gifts = $this->IssuedGifts->find('all');
			$i_gifts = $i_gifts->select(['id' => 'gift_id' , 'count' => $i_gifts->func()->sum('IssuedGifts.count')])->where(['IssuedGifts.user_id' => $uid])->group('IssuedGifts.gift_id')->toarray();
			foreach($i_gifts as $gift) $i_gift[$gift->id] = $gift->count;
			//pj($i_gift);
			$workTypes = $this->WorkTypes->find()->where(['WorkTypes.id >' => '2'])->toarray();
			$WorkPlansD = array();
			$WorkPlans = array();
			$doctorsRelation = array();
			$chemists = array();
			$stockists = array();
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
			$reported_stockists=array_map(function($s) { return $s->stockist_id; }, $WorkPlansS); $reported_stockists[]=0;
			$stockists = $this->Stockists->find('all')->where(['city_id =' => $userCity, 'Stockists.id NOT IN' => $reported_stockists])->toarray();
		$leaveTypes = $this->LeaveTypes->find()->toarray();

        $this->set(compact('userCity', 'cities', 'specialities', 'class', 'leaveTypes', 'products', 'samples', 'i_sample', 'gifts', 'i_gift', 'chemists', 'stockists', 'doctorsRelation', 'workTypes', 'WorkPlansD', 'WorkPlansUD', 'WorkPlansPD', 'WorkPlansS', 'WorkPlansC', 'WorkPlans', 'date'));

		}
		else
		return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport']);


    }

    public function UnplannedDoctors()
    {
		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$this->set('title', 'Daily Report');
			$uid = $this->Auth->user('id');
			$lead_id = $this->Auth->user('lead_id');
			$hasLeave = $this->_hasLeave($date);
			$workPlanSubmit = $this->WorkPlanSubmit->find('all')->where(['WorkPlanSubmit.user_id =' => $uid, 'WorkPlanSubmit.lead_id =' => $lead_id, 'WorkPlanSubmit.date =' => $date])->first();
			if($workPlanSubmit || $hasLeave) {return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport','?' => ['date' => $date]]);}

			$userCity = $this->Auth->user('city_id');
			$user =  $this->Auth->user;
			$state_id = $this->Auth->user('state_id');
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$specialities = $this->Specialities->find('all')->toarray();
			$doctorTypes = $this->DoctorTypes->find('all')->toarray();
			foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
			$products = $this->Products->find('all')->toarray();
			$samples = $this->AssignedSamples->find('all');
			$samples = $samples->select(['id' => 'product_id', 'name' => 'Products.name', 'count' => $samples->func()->sum('AssignedSamples.count')])->where(['AssignedSamples.user_id' => $uid])->contain(['Products'])->group('AssignedSamples.product_id')->toarray();
			$i_samples = $this->IssuedSamples->find('all');
			$i_samples = $i_samples->select(['id' => 'product_id' , 'count' => $i_samples->func()->sum('IssuedSamples.count')])->where(['IssuedSamples.user_id' => $uid])->group('IssuedSamples.product_id')->toarray();
			foreach($i_samples as $sample) $i_sample[$sample->id] = $sample->count;
			$gifts = $this->AssignedGifts->find('all');
			$gifts = $gifts->select(['id' => 'gift_id' , 'name' => 'Gifts.name', 'count' => $gifts->func()->sum('AssignedGifts.count')])->where(['AssignedGifts.user_id' => $uid])->contain(['Gifts'])->group('AssignedGifts.gift_id')->toarray();
			$i_gifts = $this->IssuedGifts->find('all');
			$i_gifts = $i_gifts->select(['id' => 'gift_id' , 'count' => $i_gifts->func()->sum('IssuedGifts.count')])->where(['IssuedGifts.user_id' => $uid])->group('IssuedGifts.gift_id')->toarray();
			foreach($i_gifts as $gift) $i_gift[$gift->id] = $gift->count;
			//pj($i_gift);
			$workTypes = $this->WorkTypes->find()->where(['WorkTypes.id >' => '2'])->toarray();
			$WorkPlansD = array();
			$WorkPlansUD = array();
			$doctorsRelation = array();
			$chemists = array();
			$stockists = array();
			$start_date = $date." 00:00:00";
			$end_date = $date." 23:59:00";


			$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities', 'Doctors.Specialities'])
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_approved =' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2]);
			$reported_doctors=array_map(function($d) { return $d->doctor_id; }, $WorkPlansD->toArray()); $reported_doctors[]=0;
			$WorkPlansD = $WorkPlansD->where(['WorkPlans.is_planned =' => '1'])->toArray();
			$doctorsRelation = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid, 'DoctorsRelation.doctor_id NOT IN' => $reported_doctors, 'Doctors.city_id' => $userCity])->contain(['Doctors.Specialities'])->toArray();

			$WorkPlansUD = $this->WorkPlans
			->find('all')
			->contain(['Cities', 'Doctors', 'Doctors.Specialities'])
			->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_missed <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2, 'WorkPlans.is_unplanned =' => 1])->toArray();


        $this->set(compact('userCity', 'cities', 'specialities', 'class', 'leaveTypes', 'products', 'samples', 'i_sample', 'gifts', 'i_gift', 'doctorsRelation', 'workTypes', 'WorkPlansUD','date'));

		}
		else
		return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport']);


    }

    public function viewDailyReport()
    {
		if(isset($_GET['date']))
		{
			$this->viewBuilder()->layout('iframe');
			$date = $_GET['date'];
			//echo $date; exit;
			$this->set('title', 'Daily Report');
			$uid = $this->Auth->user('id');
			$lead_id = $this->Auth->user('lead_id');
			$hasLeave = $this->_hasLeave($date);
			$workPlanSubmit = $this->WorkPlanSubmit->find('all')->where(['WorkPlanSubmit.user_id =' => $uid, 'WorkPlanSubmit.lead_id =' => $lead_id, 'WorkPlanSubmit.date =' => $date])->first();
			if($workPlanSubmit || $hasLeave) {return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport','?' => ['date' => $date]]);}

			$userCity = $this->Auth->user('city_id');
			$user =  $this->Auth->user;
			$state_id = $this->Auth->user('state_id');
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$doctorTypes = $this->DoctorTypes->find('all')->toarray();
			foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
			$products = $this->Products->find('all')->toarray();
			$samples = $this->Products->find('all')->toarray();
			$gifts = $this->Gifts->find('all')->toarray();
			$html = "";
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

			$this->set(compact('userCity', 'cities', 'class', 'products', 'samples',  'gifts', 'chemists', 'stockists', 'doctorsRelation', 'workTypes', 'WorkPlans', 'date', 'WorkPlansD', 'WorkPlansUD', 'WorkPlansC', 'WorkPlansS', 'WorkPlansL', 'WorkPlansPD'));
		}
		else
		return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport']);

    }

    public function finalSubmitReport()
    {
		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$this->set('title', 'Final Submit');
			$uid = $this->Auth->user('id');
			$lead_id = $this->Auth->user('lead_id');
			$hasLeave = $this->_hasLeave($date);
			$hasUnSavedPlans = $this->_hasUnSavedPlans($date);
			$workPlanSubmit = $this->WorkPlanSubmit->find('all')->where(['WorkPlanSubmit.user_id =' => $uid, 'WorkPlanSubmit.lead_id =' => $lead_id, 'WorkPlanSubmit.date =' => $date])->first();
			if($workPlanSubmit) {return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport','?' => ['date' => $date]]);}

			$userCity = $this->Auth->user('city_id');
			$user =  $this->Auth->user;
			$state_id = $this->Auth->user('state_id');
			$cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
			$products = $this->Products->find('all')->toarray();
			$doctorTypes = $this->DoctorTypes->find('all')->toarray();
			foreach($doctorTypes as $doctorType) $class[$doctorType->id] = $doctorType->name;
			$samples = $this->Products->find('all')->toarray();
			$gifts = $this->Gifts->find('all')->toarray();
			$html = "";
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

			$this->set(compact('userCity', 'cities', 'class', 'products', 'samples', 'gifts', 'chemists', 'stockists', 'doctorsRelation', 'workTypes', 'WorkPlans', 'date', 'WorkPlansD', 'WorkPlansUD', 'WorkPlansC', 'WorkPlansS', 'WorkPlansL', 'WorkPlansPD', 'hasUnSavedPlans'));
		}
		else
		return $this->redirect(['controller' => 'Mrs', 'action' => 'dailyReport']);

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
			->where(['WorkPlans.is_deleted <>' => '1', 'WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2]);
		$doctor_ids=array_map(function($d) { return $d->doctor_id; }, $WorkPlansD->toArray());
		$doctor_ids[]=0;

		$doctors = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid, 'DoctorsRelation.doctor_id NOT IN' => $doctor_ids, 'Doctors.city_id' => $city_id])->contain(['Doctors.Specialities']);
		$listHtml='<option value="">Select Doctors</option>';
		foreach ($doctors as $doctor)
		$listHtml.='<option value="'.$doctor->doctor_id.'" data-spec="'.$doctor->doctor->speciality->name.'">'.$doctor->doctor->name.'</option>';
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

    public function reports()
    {
        $this->set('title', 'Reports');

    }

    public function expenses(){

        $current_year = date("Y");
        $months = [1 => 'January',2 => 'Feburary',3 => 'March',4 => 'April',5 => 'May',6 => 'June',7 => 'July',8 => 'August',9 => 'September',10 => 'October',11 => 'November',12 => 'December'];
        $years= [$current_year   => $current_year,$current_year-1 => $current_year-1,$current_year-2 => $current_year-2,$current_year-3 => $current_year-3,$current_year-4 => $current_year-4];
        $this->loadModel('Expenses');

        $expense = $this->Expenses->newEntity();
        if($this->request->is('post')){

          $uid = $this->Auth->user('id');
          $lead_id = $this->Auth->user('lead_id');
          $month = $this->request->data['month'];
          $year = $this->request->data['year'];
          $month_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
          $month_in_text = $months[$month];
          $workPlanSubmit = $this->WorkPlanSubmit->find('all')
          ->contain([
          'Expenses.ExpenseTypes',
          'Expenses.OtherExpenses',
          'Expenses.TravelExpenses.WorkTypes' ,
          'Expenses.TravelExpenses.CitiesFrom',
          'Expenses.TravelExpenses.CitiesTo'
          ])
          ->where(['WorkPlanSubmit.user_id =' => $uid, 'WorkPlanSubmit.lead_id =' => $lead_id, 'Month(date) =' => $month, 'Year(date) =' => $year ])->order(['WorkPlanSubmit.id' => 'ASC']);

          //Store Expense Approval Informations
          $expenseApproval = $this->ExpenseApprovals->find()->where(['user_id =' => $uid,'lead_id ='=> $lead_id,'Month(date) =' => $month, 'Year(date) =' => $year])->first();
          if(isset($this->request->data['approve_request'])){
            $this->request->data['date']=$this->request->data['year']."-".$this->request->data['month'].'-1';
            $this->request->data['user_id']=$uid;
            $this->request->data['lead_id']=$lead_id;
            if(empty($expenseApproval)){
              $expenseApprovalsEntity = $this->ExpenseApprovals->newEntity();
              $expenseApprovalpatchEntity=  $this->ExpenseApprovals->patchEntity($expenseApprovalsEntity, $this->request->data);
  						if ($this->ExpenseApprovals->save($expenseApprovalpatchEntity)) {
  							$this->Flash->success(__('The expense approval has been created'));
  						}
            }else {
              $this->request->data['id']=$expenseApproval->id;
              $this->request->data['is_rejected']=0;
              $expenseApprovalpatchEntity=  $this->ExpenseApprovals->patchEntity($expenseApproval, $this->request->data);
  						if ($this->ExpenseApprovals->save($expenseApprovalpatchEntity)) {
  							$this->Flash->success(__('The expense approval has been updated'));
  						}
            }
            $expenseApproval = $this->ExpenseApprovals->find()->where(['user_id =' => $uid,'lead_id ='=> $lead_id,'Month(date) =' => $month, 'Year(date) =' => $year])->first();
          }
          $this->set(compact('month_days','month','month_in_text','year', 'workPlanSubmit','expenseApproval'));//pr($workPlanSubmit->toArray());

        }
        $this->set('title', 'Daily Report');
        $this->set(compact('years', 'months', 'expense'));
    }

	public function editExpense(){

		$cities=[];
		$uid = $this->Auth->user('id');
		$role_id = $this->Auth->user('role_id');
		if($this->request->getQuery('date')){
			$workPlanSubmit = $this->WorkPlanSubmit->find()
			->contain(['Expenses.ExpenseTypes','Expenses.TravelExpenses','Expenses.OtherExpenses','Expenses.TravelExpenses.CitiesFrom','Expenses.TravelExpenses.CitiesTo','Expenses.OtherExpenses.OtherAllowances'])
			->where(['WorkPlanSubmit.user_id =' => $uid, 'WorkPlanSubmit.date' => $this->request->getQuery('date')])
			->first();
			if($workPlanSubmit){
				$expense = $workPlanSubmit['expense'];
				if($this->request->is(['patch', 'post', 'put'])){ //pr($this->request->data);
					$this->request->data['work_plan_submit_id'] = $workPlanSubmit -> id;
					if($expense){
						$oldexpense = $this->Expenses->patchEntity($expense, $this->request->data);
            //pr($oldexpense);exit;
						if ($this->Expenses->save($oldexpense)) {
							$this->Flash->success(__('The expense has been updated.'));
						}
					}else{
						$this->request->data['work_plan_submit_id'] = $workPlanSubmit -> id;
						$this->request->data['expense_date'] = $workPlanSubmit -> date;
						$this->request->data['user_id'] = $uid;
						if(isset($this->request->data['other_expenses'])){
							$this->request->data['daily_allowance'] = 0;
							$this->request->data['expense_type_id'] = 1;
						}

						$expenseNewEntity = $this->Expenses->newEntity();
						$expensepatchEntity = $this->Expenses->patchEntity($expenseNewEntity, $this->request->data,['associated' => ['TravelExpenses','OtherExpenses']]);
						if ($this->Expenses->save($expensepatchEntity)) {
							$this->Flash->success(__('The expense has been saved.'));
						}
					}
					return $this->redirect(['action' => 'editExpense?date='.$this->request->getQuery('date')]);
				}
				$WorkPlans = $this->WorkPlans->find('all')->contain(['Cities','WorkTypes'])
				->where(['WorkPlans.start_date =' => $this->request->getQuery('date'),'WorkPlans.user_id =' => $uid])
				->order(['work_type_id' => 'DESC'])
				->hydrate(false)
				->toArray();
				if(count($WorkPlans) ){
					$cities = array_column(array_column($WorkPlans, 'city'), 'city_name', 'id');
					$worktypes = array_column(array_column($WorkPlans, 'work_type'), 'id');
				}
				$userCity = $this->Cities->find()->where(['id' => $this->Auth->user('city_id')])->first();
				$cities[$userCity->id]=$userCity->city_name;

				$expenseTypes = $this->Expenses->ExpenseTypes->find('list', ['limit' => 200]);
				$dailyAllowances = $this->DailyAllowances->find('list',['keyField' => 'cost','valueField' => 'cost'])->where(['role_id' => $role_id]);
				$otherAllowances = $this->OtherAllowances->find('list',['keyField' => 'id','valueField' => 'name']);

				$this->set(compact('expense','WorkPlans','expenseTypes','cities','worktypes','dailyAllowances','otherAllowances'));
				$this->set('title', 'Edit Expense');

			}else {
				return $this->redirect(['action' => 'dashboard']);
			}
		}else{
			return $this->redirect(['action' => 'dashboard']);
		}

	}

	/**
	* Delete method
	*
	* @param string|null $id Other Expense id.
	* @return \Cake\Http\Response|null Redirects to index.
	* @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	*/
	public function OtherExpensedelete($id = null)
	{
		//$this->request->allowMethod(['post', 'delete']);
		$otherExpense = $this->OtherExpenses->get($id);
		if ($this->OtherExpenses->delete($otherExpense)) {
			$this->Flash->success(__('The other expense has been deleted.'));
		} else {
			$this->Flash->error(__('The other expense could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'edit-expense?date='.$this->request->getQuery('date')]);
	}

  public function ExpenseApprovalRequests(){
        $this->set('title', 'Expense Approval Requests');
        $uid = $this->Auth->user('id');
	      $lead_id = $this->Auth->user('lead_id');
        $expenseApprovals = $this->paginate($this->ExpenseApprovals->find('all')->contain(['Users','Users.States','Users.Cities'])->where(['ExpenseApprovals.lead_id =' => $uid, 'ExpenseApprovals.is_approved =' => 0, 'ExpenseApprovals.is_rejected =' => 0]));
        $this->set(compact('expenseApprovals'));

    }

    public function ExpenseApprovalRequest($id){

      $current_year = date("Y");
      $months = [1 => 'January',2 => 'Feburary',3 => 'March',4 => 'April',5 => 'May',6 => 'June',7 => 'July',8 => 'August',9 => 'September',10 => 'October',11 => 'November',12 => 'December'];
      $years= [$current_year   => $current_year,$current_year-1 => $current_year-1,$current_year-2 => $current_year-2,$current_year-3 => $current_year-3,$current_year-4 => $current_year-4];
      $this->loadModel('Expenses');

      $expense = $this->Expenses->newEntity();
      if($this->request->is('post') || !empty($id)){

        $uid = $this->Auth->user('id');
        $lead_id = $this->Auth->user('lead_id');

        $expenseApproval = $this->ExpenseApprovals->find()->where(['id'=>$id])->first();
        if($expenseApproval){

          $month = (int)date("m", strtotime($expenseApproval->date));
          $year = date("Y", strtotime($expenseApproval->date));
          $expense_user_id =  $expenseApproval->user_id;

          $month_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
          $month_in_text = $months[$month];
          $workPlanSubmit = $this->WorkPlanSubmit->find('all')
          ->contain([
          'Expenses.ExpenseTypes',
          'Expenses.OtherExpenses',
          'Expenses.TravelExpenses.WorkTypes' ,
          'Expenses.TravelExpenses.CitiesFrom',
          'Expenses.TravelExpenses.CitiesTo'
          ])
          ->where(['WorkPlanSubmit.user_id =' => $expense_user_id, 'WorkPlanSubmit.lead_id =' => $uid, 'Month(date) =' => $month, 'Year(date) =' => $year ])->order(['WorkPlanSubmit.id' => 'ASC']);

          //Store Expense Approval Informations
          if(isset($this->request->data['approve_request'])){
              $expense_changes = $this->request->data['expenses'];
              foreach($expense_changes as $expense_change){
                $expense = $this->Expenses->find()->where(['id' => $expense_change['id']])->first();
                $expensePatchEntity=$this->Expenses->patchEntity($expense,$expense_change);                
                $this->Expenses->save($expensePatchEntity);
              }
              unset($this->request->data['expenses']);
              if(isset($this->request->data['is_approved'])){
                $this->request->data['is_approved']=1;
              }else{
                $this->request->data['is_rejected']=1;
              }
              $this->request->data['id']=$expenseApproval->id;
              $expenseApprovalpatchEntity=  $this->ExpenseApprovals->patchEntity($expenseApproval, $this->request->data);
              if ($this->ExpenseApprovals->save($expenseApprovalpatchEntity)) {
                $this->Flash->success(__('The expense approval has been updated'));
                return $this->redirect(["controller" => "Mrs","action" => "ExpenseApprovalRequest",$id]);
              }
          }
          $this->set(compact('month_days','month','month_in_text','year', 'workPlanSubmit','expenseApproval'));//pr($workPlanSubmit->toArray());
        }else {

        }

      }
      $this->set('title', 'Daily Report');
      $this->set(compact('years', 'months', 'expense'));
    }

	protected function _hasLeave($start_date)
    {
		$uid = $this->Auth->user('id');
		$workPlans = $this->WorkPlans->find()->where(['start_date =' => $start_date,'work_type_id =' => 1, 'user_id =' => $uid])->first();
		if(count($workPlans)>0)
		return $workPlans->id;

		return false;
    }

	protected function _hasPlannedLeave($start_date)
    {
		$uid = $this->Auth->user('id');
		$workPlans = $this->WorkPlans->find()->where(['WorkPlans.is_missed <>' => '1', 'WorkPlans.is_planned =' => '1', 'WorkPlans.is_approved =' => '1', 'start_date =' => $start_date,'work_type_id =' => 1, 'user_id =' => $uid])->first();
		if(count($workPlans)>0)
		return $workPlans->id;

		return false;
    }

	protected function _hasUnSavedPlans($start_date)
    {
		$uid = $this->Auth->user('id');
		$workPlans = $this->WorkPlans->find()->where(['start_date =' => $start_date, 'user_id =' => $uid, 'is_reported =' => 0])->toArray();
		if(count($workPlans)>0)
		return true;

		return false;
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

    public function getReportedVisits($doctor_id,$uid,$start_date,$end_date){
		$WorkPlansD = $this->WorkPlans->find('all')
		->contain(['WorkTypes', 'Cities', 'Doctors.Specialities'])
		->where(['WorkPlans.user_id =' => $uid, 'WorkPlans.is_deleted <>' => '1', 'WorkPlans.is_reported =' => '1', 'WorkPlans.doctor_id =' => $doctor_id, 'WorkPlans.work_type_id =' => 2])
		->where(['WorkPlans.start_date >=' => $start_date])
		->andWhere(['WorkPlans.start_date <=' => $end_date])->toArray();
		$visits = array_map(function($d) { return date("d", strtotime($d->start_date)); }, $WorkPlansD);
		return (implode("/",$visits));
	}

    public function getcityDistance(){
      if($this->request->is('Ajax')){
        $distance = $this->CityDistances->find()
        ->where(['city_from' => $this->request->data['from'],'city_to' => $this->request->data['to']])
        ->orWhere(['city_from' => $this->request->data['to'],'city_to' => $this->request->data['from']])
        ->first();
        $city_distance = 0;
        if($distance){
          $city_distance = $distance['km'];
        }
        $response=[
          'status' => 1,
          'distance' => $city_distance,
          'km_fare' => 2
        ];
        echo json_encode($response);exit;
      }
    }
    
    public function holidayArray()
    {
		$start_date=date("Y-01-01");
		$end_date=date("Y-12-31");
		$date_array = array();
        $holidays = $this->Holidays->find()->where(['date >=' => $start_date])->andWhere(['date <=' => $end_date])->toArray();
        foreach($holidays as $holiday)
        $date_array[date("Y-m-d", strtotime($holiday['date']))]=$holiday['name'];
        return (json_encode($date_array)); 
    }
}
