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
    public function doctorList(){
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Doctor List');        
    }
    public function doctorSelection(){
        $this->viewBuilder()->layout('medicalrep');
        $this->set('title', 'Doctor Visit Report');        
    }      
}
