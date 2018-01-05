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

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
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
		  array('controller'=>'Mrs', 'action'=>'*')
		)
	  );
	  
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
 		$user_role = $this->Auth->user('role');
 		$this->isAuthorized();

        $this->set("role",$user_role);
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
				  if($permission['action'] == $request['action'])
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
		  $user_role = $this->Auth->user('role');
			  if(!$this->verifyRole($user_role)){
				$this->Flash->error("You do not have permission.");
				$this->redirect(['controller' => 'Mrs', 'action' => 'dashboard']);
			  }
		}
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
