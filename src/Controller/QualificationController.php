<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Qualification Controller
 *
 * @property \App\Model\Table\QualificationTable $Qualification
 *
 * @method \App\Model\Entity\Qualification[] paginate($object = null, array $settings = [])
 */
class QualificationController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $qualification = $this->paginate($this->Qualification);

        $this->set(compact('qualification'));
        $this->set('_serialize', ['qualification']);
    }

    /**
     * View method
     *
     * @param string|null $id Qualification id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $qualification = $this->Qualification->get($id, [
            'contain' => []
        ]);

        $this->set('qualification', $qualification);
        $this->set('_serialize', ['qualification']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $qualification = $this->Qualification->newEntity();
        if ($this->request->is('post')) {
            $qualification = $this->Qualification->patchEntity($qualification, $this->request->getData());
            if ($this->Qualification->save($qualification)) {
                $this->Flash->success(__('The qualification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The qualification could not be saved. Please, try again.'));
        }
        $this->set(compact('qualification'));
        $this->set('_serialize', ['qualification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Qualification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $qualification = $this->Qualification->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $qualification = $this->Qualification->patchEntity($qualification, $this->request->getData());
            if ($this->Qualification->save($qualification)) {
                $this->Flash->success(__('The qualification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The qualification could not be saved. Please, try again.'));
        }
        $this->set(compact('qualification'));
        $this->set('_serialize', ['qualification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Qualification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $qualification = $this->Qualification->get($id);
        if ($this->Qualification->delete($qualification)) {
            $this->Flash->success(__('The qualification has been deleted.'));
        } else {
            $this->Flash->error(__('The qualification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
