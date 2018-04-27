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
        $assignedGifts = $this->paginate($this->AssignedGifts);

        $this->set(compact('assignedGifts'));
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
        $assignedGift = $this->AssignedGifts->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			$haveGift = $this->AssignedGifts->find('all')->where(['user_id =' => $data['user_id'], 'product_id =' => $data['product_id']])->first();
			if($haveGift)
			{$assignedGift = $this->AssignedGifts->get($haveGift->id); $data['count'] = $data['count']+$haveGift['count'];}
            $assignedGift = $this->AssignedGifts->patchEntity($assignedGift, $data);
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
