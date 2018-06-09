<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie', ['expires' => '1 day']);
		$this->loadModel('Users');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
			'authorize' => ['Controller'], // Added this line
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer() // If unauthorized, return them to page they were just on
        ]);
        $this->Auth->allow(['forgotPassword', 'confirmation']);
        // Allow the display action so our pages controller
        // continues to work.
        $this->Auth->allow(['display']);
        /* Change the menu accordingly */
    }
    public $permissions = array(
		'1' => '*',
		'2' => '*',
		'3' => '*',
		'4' => '*',
		'5' =>array(
		  array('controller'=>'Users', 'action'=>['login','logout','account']),
		  array('controller'=>'Mrs', 'action'=> '*'),
		  array('controller'=>'Reports', 'action'=> '*'),
		  array('controller'=>'Doctors', 'action'=>['mrsGetDoctors','mrsGetDoctor','getDoctorsOption','viewDoctorProfile']),
		  array('controller'=>'DoctorsRelation', 'action'=>['mrsAdd','mrsUpdate','mrsDelete','mrsGetRelation']),
		  array('controller'=>'Chemists', 'action'=>['index','add','view','edit']),
		  array('controller'=>'WorkPlans', 'action'=> '*'),
		  array('controller'=>'Cities', 'action'=>['getCitiesOption'])
		)
	  );
	  
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
 		$user_role = $this->Auth->user('role_id');
		if($this->Auth->user())
		$user = $this->Users->get($this->Auth->user('id'), ['contain' => ['Roles']]);
		else
		$user ="";	

        $this->set("role",$user_role);
        $this->set("authuser",$user);
	}
	
	public function verifyRole($role){
		$request = $this->request->params;
		  if($this->permissions[$role] == '*'){
			return true;
		  }else{
			foreach($this->permissions[$role] as $permission){
			  if($permission['controller'] == $request['controller'])
			  {
				if($permission['action'] == '*'){
				  return true;
				}
				else{
				  if(in_array($request['action'],$permission['action']))
					return true;
				  else
					return false;
				}
			  }
			}
		  }
	}
   
    public function isAuthorized(){
		if($this->Auth->user()){
		  $user = $this->Auth->user();
		  if($user['is_deleted']==1){
			$this->redirect($this->Auth->logout()); return false;
		  }
		  elseif($user['is_active']==0){
			$this->redirect($this->Auth->logout()); return false;
		  }
		  else
		  {
			if(!$this->verifyRole($user['role_id'])){
			$this->redirect(['controller' => 'Mrs', 'action' => 'index']);
			return false;
			}
		  }
		}
		return true;
	}     

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production. You should instead set "_serialize"
        // in each action as required.
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
