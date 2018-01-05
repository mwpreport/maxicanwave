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
		$this->paginate = [
            'contain' => ['Roles', 'States', 'Cities']
        ];
        $users = $this->paginate($this->Users);

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
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $roles = $this->Users->Roles->find('list');
        $states = $this->Users->States->find('list');
        $this->set(compact('user', 'roles', 'states'));

        $this->set('_serialize', ['user']);
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
        $roles = $this->Users->Roles->find('list');
        $states = $this->Users->States->find('list');
        $cities = $this->Users->Cities->find('list')->where(['state_id =' => $user['state_id']])->toarray();
        $this->set(compact('user', 'roles', 'states', 'cities'));
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
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
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
                return $this->redirect(array('controller' => 'mrs', 'action' => 'dashboard'));
            }else{
               return $this->redirect($this->Auth->logout()); 
            }
        }
    }   
    
    public function logout() {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
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
	
}
