<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WorkPlanApproval Controller
 *
 * @property \App\Model\Table\WorkPlanApprovalTable $WorkPlanApproval
 *
 * @method \App\Model\Entity\WorkPlanApproval[] paginate($object = null, array $settings = [])
 */
class WorkPlanApprovalController extends AppController
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
        $workPlanApproval = $this->paginate($this->WorkPlanApproval);

        $this->set(compact('workPlanApproval'));
        $this->set('_serialize', ['workPlanApproval']);
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
        $workPlanApproval = $this->WorkPlanApproval->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('workPlanApproval', $workPlanApproval);
        $this->set('_serialize', ['workPlanApproval']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $workPlanApproval = $this->WorkPlanApproval->newEntity();
        if ($this->request->is('post')) {
            $workPlanApproval = $this->WorkPlanApproval->patchEntity($workPlanApproval, $this->request->getData());
            if ($this->WorkPlanApproval->save($workPlanApproval)) {
                $this->Flash->success(__('The work plan approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work plan approval could not be saved. Please, try again.'));
        }
        $users = $this->WorkPlanApproval->Users->find('list', ['limit' => 200]);
        $this->set(compact('workPlanApproval', 'users'));
        $this->set('_serialize', ['workPlanApproval']);
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
        $workPlanApproval = $this->WorkPlanApproval->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workPlanApproval = $this->WorkPlanApproval->patchEntity($workPlanApproval, $this->request->getData());
            if ($this->WorkPlanApproval->save($workPlanApproval)) {
                $this->Flash->success(__('The work plan approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work plan approval could not be saved. Please, try again.'));
        }
        $users = $this->WorkPlanApproval->Users->find('list', ['limit' => 200]);
        $this->set(compact('workPlanApproval', 'users'));
        $this->set('_serialize', ['workPlanApproval']);
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
        $workPlanApproval = $this->WorkPlanApproval->get($id);
        if ($this->WorkPlanApproval->delete($workPlanApproval)) {
            $this->Flash->success(__('The work plan approval has been deleted.'));
        } else {
            $this->Flash->error(__('The work plan approval could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
