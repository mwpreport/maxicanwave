<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssignedSamples Controller
 *
 * @property \App\Model\Table\AssignedSamplesTable $AssignedSamples
 *
 * @method \App\Model\Entity\AssignedSample[] paginate($object = null, array $settings = [])
 */
class AssignedSamplesController extends AppController
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
            'contain' => ['Products', 'Users']
        ];
        $assignedSamples = $this->paginate($this->AssignedSamples);

        $this->set(compact('assignedSamples'));
        $this->set('_serialize', ['assignedSamples']);
    }

    /**
     * View method
     *
     * @param string|null $id Assigned Sample id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assignedSample = $this->AssignedSamples->get($id, [
            'contain' => ['Products', 'Users']
        ]);

        $this->set('assignedSample', $assignedSample);
        $this->set('_serialize', ['assignedSample']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assignedSample = $this->AssignedSamples->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			$haveSample = $this->AssignedSamples->find('all')->where(['user_id =' => $data['user_id'], 'product_id =' => $data['product_id']])->first();
			if($haveSample)
			{$assignedSample = $this->AssignedSamples->get($haveSample->id); $data['count'] = $data['count']+$haveSample['count'];}
            $assignedSample = $this->AssignedSamples->patchEntity($assignedSample, $data);
            if ($this->AssignedSamples->save($assignedSample)) {
                $this->Flash->success(__('The assigned sample has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assigned sample could not be saved. Please, try again.'));
        }
        $products = $this->AssignedSamples->Products->find('list');
        $users = $this->Users->find('list')->where(['Users.role_id =' => '5'])->toarray();
        $this->set(compact('assignedSample', 'products', 'users'));
        $this->set('_serialize', ['assignedSample']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assigned Sample id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assignedSample = $this->AssignedSamples->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignedSample = $this->AssignedSamples->patchEntity($assignedSample, $this->request->getData());
            if ($this->AssignedSamples->save($assignedSample)) {
                $this->Flash->success(__('The assigned sample has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assigned sample could not be saved. Please, try again.'));
        }
        $products = $this->AssignedSamples->Products->find('list');
        $users = $this->Users->find('list')->where(['Users.role_id =' => '5'])->toarray();
        $this->set(compact('assignedSample', 'products', 'users'));
        $this->set('_serialize', ['assignedSample']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assigned Sample id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assignedSample = $this->AssignedSamples->get($id);
        if ($this->AssignedSamples->delete($assignedSample)) {
            $this->Flash->success(__('The assigned sample has been deleted.'));
        } else {
            $this->Flash->error(__('The assigned sample could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
