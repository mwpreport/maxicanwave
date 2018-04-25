<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WorkPlanSubmit Controller
 *
 * @property \App\Model\Table\WorkPlanSubmitTable $WorkPlanSubmit
 *
 * @method \App\Model\Entity\WorkPlanSubmit[] paginate($object = null, array $settings = [])
 */
class WorkPlanSubmitController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $workPlanSubmit = $this->paginate($this->WorkPlanSubmit);

        $this->set(compact('workPlanSubmit'));
        $this->set('_serialize', ['workPlanSubmit']);
    }

    /**
     * View method
     *
     * @param string|null $id Work Plan Approval id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workPlanSubmit = $this->WorkPlanSubmit->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('workPlanSubmit', $workPlanSubmit);
        $this->set('_serialize', ['workPlanSubmit']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $workPlanSubmit = $this->WorkPlanSubmit->newEntity();
        if ($this->request->is('post')) {
            $workPlanSubmit = $this->WorkPlanSubmit->patchEntity($workPlanSubmit, $this->request->getData());
            if ($this->WorkPlanSubmit->save($workPlanSubmit)) {
                $this->Flash->success(__('The work plan approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work plan approval could not be saved. Please, try again.'));
        }
        $users = $this->WorkPlanSubmit->Users->find('list', ['limit' => 200]);
        $this->set(compact('workPlanSubmit', 'users'));
        $this->set('_serialize', ['workPlanSubmit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Work Plan Approval id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $workPlanSubmit = $this->WorkPlanSubmit->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workPlanSubmit = $this->WorkPlanSubmit->patchEntity($workPlanSubmit, $this->request->getData());
            if ($this->WorkPlanSubmit->save($workPlanSubmit)) {
                $this->Flash->success(__('The work plan approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work plan approval could not be saved. Please, try again.'));
        }
        $users = $this->WorkPlanSubmit->Users->find('list', ['limit' => 200]);
        $this->set(compact('workPlanSubmit', 'users'));
        $this->set('_serialize', ['workPlanSubmit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Work Plan Approval id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workPlanSubmit = $this->WorkPlanSubmit->get($id);
        if ($this->WorkPlanSubmit->delete($workPlanSubmit)) {
            $this->Flash->success(__('The work plan approval has been deleted.'));
        } else {
            $this->Flash->error(__('The work plan approval could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
