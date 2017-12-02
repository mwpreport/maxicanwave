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
        $this->loadModel('States');
        $this->loadModel('Cities');
        $this->loadModel('Doctors');
        $this->loadModel('Chemists');
        $this->loadModel('WorkPlans');
        $this->loadModel('WorkReports');
        $this->loadModel('WorkTypes');
        $this->loadModel('LeaveTypes');
        $this->loadModel('DoctorsRelation');
        $this->loadModel('ChemistsRelation');
		
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
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Doctor Visit Report');        
    }      
    public function chemistList(){
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Chemist List');
    }
    public function dailyReport(){
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Daily Report');        
    }
	
	public function monthlyplan(){
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Monthly Plan');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $workTypes = $this->WorkTypes->find()->toarray();
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $doctorsRelation = $this->DoctorsRelation->find('all')->where(['user_id =' => $uid])->contain(['Doctors']);
        $leaveTypes = $this->LeaveTypes->find()->toarray();
        $this->set(compact('userCity', 'workTypes', 'leaveTypes', 'cities', 'doctorsRelation'));        
    }
    public function doctorList(){
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Doctor List');        
    }
    public function doctorSelection(){
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Doctor Visit Report');        
    }      
}
