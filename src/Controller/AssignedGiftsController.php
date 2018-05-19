<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssignedGifts Controller
 *
 * @property \App\Model\Table\AssignedGiftsTable $AssignedGifts
 *
 * @method \App\Model\Entity\AssignedGift[] paginate($object = null, array $settings = [])
 */
class AssignedGiftsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->loadModel('Users');
		$this->loadModel('IssuedGifts');
    }       
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gifts', 'Users']
        ];
		$authuser = $this->Auth->user();

        if(isset($_GET['user']))
        $filterUser = $_GET['user'];
        else
        $filterUser = 0;
		
		$gifts = $this->AssignedGifts->find('all');
		$gifts = $gifts->select(['id' => 'gift_id', 'name' => 'Gifts.name', 'count' => $gifts->func()->sum('AssignedGifts.count')])->where(['AssignedGifts.user_id' => $filterUser])->contain(['Gifts'])->group('AssignedGifts.gift_id');

		
		$i_gifts = $this->IssuedGifts->find('all');
		$i_gifts = $i_gifts->select(['id' => 'gift_id' , 'count' => $i_gifts->func()->sum('IssuedGifts.count')])->where(['IssuedGifts.user_id' => $filterUser])->group('IssuedGifts.gift_id')->toarray();
		foreach($i_gifts as $gift) $i_gift[$gift->id] = $gift->count;

        $assignedGifts = $this->paginate($gifts);
		$users = $this->Users->find('all')->where(['Users.role_id =' => '5','Users.is_active =' => 1, 'Users.is_deleted =' => 0]);
		if($authuser['role_id'] != 1)
		$users = $users->where(['Users.lead_id =' => $authuser['id']]);

        $this->set(compact('assignedGifts','users', 'filterUser', 'i_gift'));
        $this->set('_serialize', ['assignedGifts']);
    }

    /**
     * View method
     *
     * @param string|null $id Assigned Gift id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assignedGift = $this->AssignedGifts->get($id, [
            'contain' => ['Gifts', 'Users']
        ]);

        $this->set('assignedGift', $assignedGift);
        $this->set('_serialize', ['assignedGift']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$authuser = $this->Auth->user();

        if(isset($_GET['user']))
        $filterUser = $_GET['user'];
        else
        $filterUser = 0;

		$assignedGift = $this->AssignedGifts->newEntity();

        if ($this->request->is('post')) {
			$data = $this->request->getData();
/* 			$haveGift = $this->AssignedGifts->find('all')->where(['user_id =' => $data['user_id'], 'gift_id =' => $data['gift_id']])->first();
			if($haveGift)
			{$assignedGift = $this->AssignedGifts->get($haveGift->id); $data['count'] = $data['count']+$haveGift['count'];}
 */            $assignedGift = $this->AssignedGifts->patchEntity($assignedGift, $data);
            if ($this->AssignedGifts->save($assignedGift)) {
                $this->Flash->success(__('The gift has been saved.'));

                return $this->redirect(['action' => 'index', '?' => ['user' => $assignedSample->user_id]]);
            }
            $this->Flash->error(__('The gift could not be saved. Please, try again.'));
        }
        $gifts = $this->AssignedGifts->Gifts->find('list');
        $users = $this->Users->find('all')->where(['Users.role_id =' => '5']);
		if($authuser['role_id'] != 1)
		$users = $users->where(['Users.lead_id =' => $authuser['id']]);
        $this->set(compact('assignedGift', 'gifts', 'users', 'filterUser'));
        $this->set('_serialize', ['assignedGift']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assigned Gift id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assignedGift = $this->AssignedGifts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignedGift = $this->AssignedGifts->patchEntity($assignedGift, $this->request->getData());
            if ($this->AssignedGifts->save($assignedGift)) {
                $this->Flash->success(__('The gift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gift could not be saved. Please, try again.'));
        }
        $gifts = $this->AssignedGifts->Gifts->find('list');
        $users = $this->Users->find('list')->where(['Users.role_id =' => '5'])->toarray();
        $this->set(compact('assignedGift', 'gifts', 'users'));
        $this->set('_serialize', ['assignedGift']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assigned Gift id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assignedGift = $this->AssignedGifts->get($id);
        if ($this->AssignedGifts->delete($assignedGift)) {
            $this->Flash->success(__('The assigned gift has been deleted.'));
        } else {
            $this->Flash->error(__('The assigned gift could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
