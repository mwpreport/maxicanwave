<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * IssuedSamples Controller
 *
 * @property \App\Model\Table\IssuedSamplesTable $IssuedSamples
 *
 * @method \App\Model\Entity\IssuedSample[] paginate($object = null, array $settings = [])
 */
class IssuedSamplesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'Users', 'Doctors']
        ];
        $issuedSamples = $this->paginate($this->IssuedSamples);

        $this->set(compact('issuedSamples'));
        $this->set('_serialize', ['issuedSamples']);
    }*/

    /**
     * View method
     *
     * @param string|null $id Issued Sample id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    
    public function view($id = null)
    {
        $issuedSample = $this->IssuedSamples->get($id, [
            'contain' => ['Products', 'Users', 'Doctors']
        ]);

        $this->set('issuedSample', $issuedSample);
        $this->set('_serialize', ['issuedSample']);
    } */

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
    
    public function add()
    {
        $issuedSample = $this->IssuedSamples->newEntity();
        if ($this->request->is('post')) {
            $issuedSample = $this->IssuedSamples->patchEntity($issuedSample, $this->request->getData());
            if ($this->IssuedSamples->save($issuedSample)) {
                $this->Flash->success(__('The issued sample has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issued sample could not be saved. Please, try again.'));
        }
        $products = $this->IssuedSamples->Products->find('list', ['limit' => 200]);
        $users = $this->IssuedSamples->Users->find('list', ['limit' => 200]);
        $doctors = $this->IssuedSamples->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('issuedSample', 'products', 'users', 'doctors'));
        $this->set('_serialize', ['issuedSample']);
    } */

    /**
     * Edit method
     *
     * @param string|null $id Issued Sample id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     
    public function edit($id = null)
    {
        $issuedSample = $this->IssuedSamples->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issuedSample = $this->IssuedSamples->patchEntity($issuedSample, $this->request->getData());
            if ($this->IssuedSamples->save($issuedSample)) {
                $this->Flash->success(__('The issued sample has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issued sample could not be saved. Please, try again.'));
        }
        $products = $this->IssuedSamples->Products->find('list', ['limit' => 200]);
        $users = $this->IssuedSamples->Users->find('list', ['limit' => 200]);
        $doctors = $this->IssuedSamples->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('issuedSample', 'products', 'users', 'doctors'));
        $this->set('_serialize', ['issuedSample']);
    }*/

    /**
     * Delete method
     *
     * @param string|null $id Issued Sample id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issuedSample = $this->IssuedSamples->get($id);
        if ($this->IssuedSamples->delete($issuedSample)) {
            $this->Flash->success(__('The issued sample has been deleted.'));
        } else {
            $this->Flash->error(__('The issued sample could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    } */
}
