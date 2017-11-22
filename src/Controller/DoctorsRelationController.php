<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DoctorsRelation Controller
 *
 * @property \App\Model\Table\DoctorsRelationTable $DoctorsRelation
 *
 * @method \App\Model\Entity\DoctorsRelation[] paginate($object = null, array $settings = [])
 */
class DoctorsRelationController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Doctors']
        ];
        $doctorsRelation = $this->paginate($this->DoctorsRelation);

        $this->set(compact('doctorsRelation'));
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * View method
     *
     * @param string|null $id Doctors Relation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doctorsRelation = $this->DoctorsRelation->get($id, [
            'contain' => ['Users', 'Doctors']
        ]);

        $this->set('doctorsRelation', $doctorsRelation);
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doctorsRelation = $this->DoctorsRelation->newEntity();
        if ($this->request->is('post')) {
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $this->request->getData());
            if ($this->DoctorsRelation->save($doctorsRelation)) {
                $this->Flash->success(__('The doctors relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
        }
        $users = $this->DoctorsRelation->Users->find('list', ['limit' => 200]);
        $doctors = $this->DoctorsRelation->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('doctorsRelation', 'users', 'doctors'));
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctors Relation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doctorsRelation = $this->DoctorsRelation->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $this->request->getData());
            if ($this->DoctorsRelation->save($doctorsRelation)) {
                $this->Flash->success(__('The doctors relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
        }
        $users = $this->DoctorsRelation->Users->find('list', ['limit' => 200]);
        $doctors = $this->DoctorsRelation->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('doctorsRelation', 'users', 'doctors'));
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctors Relation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorsRelation = $this->DoctorsRelation->get($id);
        if ($this->DoctorsRelation->delete($doctorsRelation)) {
            $this->Flash->success(__('The doctors relation has been deleted.'));
        } else {
            $this->Flash->error(__('The doctors relation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
