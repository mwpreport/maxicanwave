<?php
namespace App\Controller;
use Cake\Core\Configure;

use Cake\Mailer\Email;
use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->loadModel('Users');
        $this->Auth->allow(['logout', 'signup', 'login','add']);
    }       

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$authuser = $this->Auth->user();
		$this->paginate = [
            'contain' => ['Roles', 'States', 'Cities'],
			'conditions' => ['Users.id <>' => $authuser['id'],'Users.role_id >' => $authuser['role_id'],'Users.is_deleted =' => 0]
        ];
        $users = $this->paginate($this->Users);
		foreach ($users as $user)
		$this->generateCode($user->id);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'States', 'Cities']
        ]);
		foreach ($user as $user)
		$this->generateCode($use->id);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$authuser = $this->Auth->user();
		$city_id = $authuser['city_id'];
		$state_id = $authuser['state_id'];
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
				$this->generateCode($user->id);
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $roles = $this->Users->Roles->find('list')->where(['id >' => $authuser['role_id']])->toarray();
        $states = $this->Users->States->find('list');
        $cities = $this->Users->Cities->find('list')->where(['state_id =' => $state_id])->toarray();
        $this->set(compact('user', 'roles', 'states','cities','state_id'));

        $this->set('_serialize', ['user']);
    }

	public function generateCode($id)
    {
		$user = $this->Users->get($id, [
            'contain' => ['States']
        ]);
		$data['code'] = "MWP".$user->state->state_code.sprintf("%05s",$id);
		$user = $this->Users->patchEntity($user, $data);
            $this->Users->save($user);
            return;
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$authuser = $this->Auth->user();
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list')->where(['id >' => $authuser['role_id']])->toarray();
        $states = $this->Users->States->find('list');
        $cities = $this->Users->Cities->find('list')->where(['state_id =' => $user['state_id']])->toarray();
        $leadRole = $user['role_id']-1;
        $leads = $users = $this->Users->find('list')->where(['role_id =' => $leadRole])->toarray();
        $this->set(compact('user', 'roles', 'states', 'cities', 'leads'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
		if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, array('is_deleted' => 1));
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function login(){
        $this->viewBuilder()->layout('register');
        $this->set('title', 'Login Page');
        if ($this->request->is('post')) {
            $requestData = $this->request->getData();         
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(array('controller' => 'mrs', 'action' => 'index'));
            }else{
				$this->Flash->error("Invalid Email or Password.");
				return $this->redirect($this->Auth->logout()); 
            }
        }
    }   
    
    public function logout() {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    } 

	public function account()
    {
		$authuser = $this->Auth->user();
		$uid = $authuser['id'];
        $user = $this->Users->get($uid, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Profile information has been saved.'));

                return $this->redirect(['action' => 'account']);
            }
            $this->Flash->error(__('Something went wrong. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list')->where(['id >' => $authuser['role_id']])->toarray();
        $states = $this->Users->States->find('list');
        $cities = $this->Users->Cities->find('list')->where(['state_id =' => $user['state_id']])->toarray();
        $this->set(compact('user', 'roles', 'states', 'cities'));
        $this->set('_serialize', ['user']);
    }   
	
	public function changePassword()
    {
        $user =$this->Users->get($this->Auth->user('id'));
        if (!empty($this->request->data)) {
            $user = $this->Users->patchEntity($user, [
                    'old_password'  => $this->request->data['old_password'],
                    'password'      => $this->request->data['password1'],
                    'password1'     => $this->request->data['password1'],
                    'password2'     => $this->request->data['password2']
                ],
                ['validate' => 'password']
            );
            if ($this->Users->save($user)) {
                $this->Flash->success('The password is successfully changed');
                return $this->redirect(['action' => 'change-password']);
            } else {
                $this->Flash->error('There was an error during the save!');
            }
        }
        $this->set('user',$user);
    }
	
    /**
     * Allow a user to request a password reset.
     * @return
     */
    public function forgotPassword() {
        $this->viewBuilder()->layout('register');
        $this->set('title', 'Retrieve Password');
        if (!empty($this->data)) {
            $user = $this->User->findByUsername($this->data['User']['username']);
            if (empty($user)) {
                $this->Session->setflash('Sorry, the username entered was not found.');
                $this->redirect('/users/forgot_password');
            } else {
                $user = $this->__generatePasswordToken($user);
                if ($this->User->save($user) && $this->__sendForgotPasswordEmail($user['User']['id'])) {
                    $this->Session->setflash('Password reset instructions have been sent to your email address.
						You have 24 hours to complete the request.');
                    $this->redirect('/users/login');
                }
            }
        }
    }

    /**
     * Allow user to reset password if $token is valid.
     * @return
     */
    public function reset_password_token($reset_password_token = null) {
        $this->viewBuilder()->layout('register');
        $this->set('title', 'Reset Password');
        if (empty($this->data)) {
            $this->data = $this->User->findByResetPasswordToken($reset_password_token);
            if (!empty($this->data['User']['reset_password_token']) && !empty($this->data['User']['token_created_at']) &&
            $this->__validToken($this->data['User']['token_created_at'])) {
                $this->data['User']['id'] = null;
                $_SESSION['token'] = $reset_password_token;
            } else {
                $this->Session->setflash('The password reset request has either expired or is invalid.');
                $this->redirect('/users/login');
            }
        } else {
            if ($this->data['User']['reset_password_token'] != $_SESSION['token']) {
                $this->Session->setflash('The password reset request has either expired or is invalid.');
                $this->redirect('/users/login');
            }

            $user = $this->User->findByResetPasswordToken($this->data['User']['reset_password_token']);
            $this->User->id = $user['User']['id'];

            if ($this->User->save($this->data, array('validate' => 'only'))) {
                $this->data['User']['reset_password_token'] = $this->data['User']['token_created_at'] = null;
                if ($this->User->save($this->data) && $this->__sendPasswordChangedEmail($user['User']['id'])) {
                    unset($_SESSION['token']);
                    $this->Session->setflash('Your password was changed successfully. Please login to continue.');
                    $this->redirect('/users/login');
                }
            }
        }
    }

    /**
     * Generate a unique hash / token.
     * @param Object User
     * @return Object User
     */
    public function __generatePasswordToken($user) {
        if (empty($user)) {
            return null;
        }

        // Generate a random string 100 chars in length.
        $token = "";
        for ($i = 0; $i < 100; $i++) {
            $d = rand(1, 100000) % 2;
            $d ? $token .= chr(rand(33,79)) : $token .= chr(rand(80,126));
        }

        (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;

        // Generate hash of random string
        $hash = Security::hash($token, 'sha256', true);;
        for ($i = 0; $i < 20; $i++) {
            $hash = Security::hash($hash, 'sha256', true);
        }

        $user['User']['reset_password_token'] = $hash;
        $user['User']['token_created_at']     = date('Y-m-d H:i:s');

        return $user;
    }

    /**
     * Validate token created at time.
     * @param String $token_created_at
     * @return Boolean
     */
    public function __validToken($token_created_at) {
        $expired = strtotime($token_created_at) + 86400;
        $time = strtotime("now");
        if ($time < $expired) {
            return true;
        }
        return false;
    }

    /**
     * Sends password reset email to user's email address.
     * @param $id
     * @return
     */
    public function __sendForgotPasswordEmail($id = null) {
        if (!empty($id)) {
            $this->User->id = $id;
            $User = $this->User->read();

            $this->Email->to 		= $User['User']['email'];
            $this->Email->subject 	= 'Password Reset Request - DO NOT REPLY';
            $this->Email->replyTo 	= 'do-not-reply@example.com';
            $this->Email->from 		= 'Do Not Reply <do-not-reply@example.com>';
            $this->Email->template 	= 'reset_password_request';
            $this->Email->sendAs 	= 'both';
            $this->set('User', $User);
            $this->Email->send();

            return true;
        }
        return false;
    }

    /**
     * Notifies user their password has changed.
     * @param $id
     * @return
     */
    public function __sendPasswordChangedEmail($id = null) {
        if (!empty($id)) {
            $this->User->id = $id;
            $User = $this->User->read();

            $this->Email->to 		= $User['User']['email'];
            $this->Email->subject 	= 'Password Changed - DO NOT REPLY';
            $this->Email->replyTo 	= 'do-not-reply@example.com';
            $this->Email->from 		= 'Do Not Reply <do-not-reply@example.com>';
            $this->Email->template 	= 'password_reset_success';
            $this->Email->sendAs 	= 'both';
            $this->set('User', $User);
            $this->Email->send();

            return true;
        }
        return false;
    }

    public function getUsersOption()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$users = $this->Users->find('all')->where(['city_id =' => $data['city']])->toarray();
        $usersHtml = '<option value="">Select Users</option>';
        foreach ($users as $user)
        $usersHtml.='<option value="'.$user['id'].'">'.$user['firstname']." ".$user['lastname'].'</option>';
        
        $returnArray = array('success' => "1",'user' => $usersHtml);
		echo json_encode($returnArray); 
		exit;   

    }

    public function getLeadsOption()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$leadRole = $data['role']-1;
		$users = $this->Users->find('all')->where(['role_id =' => $leadRole])->toarray();
        $leadsHtml = '<option value="">Select Users</option>';
        foreach ($users as $user)
        $leadsHtml.='<option value="'.$user['id'].'">'.$user['firstname']." ".$user['lastname'].'</option>';
        
        $returnArray = array('success' => "1",'leads' => $leadsHtml);
		echo json_encode($returnArray); 
		exit;    

    }
	
}
