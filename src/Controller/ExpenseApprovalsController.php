<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExpenseApprovals Controller
 *
 * @property \App\Model\Table\ExpenseApprovalsTable $ExpenseApprovals
 *
 * @method \App\Model\Entity\ExpenseApproval[] paginate($object = null, array $settings = [])
 */
class ExpenseApprovalsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Leads']
        ];
        $expenseApprovals = $this->paginate($this->ExpenseApprovals);

        $this->set(compact('expenseApprovals'));
        $this->set('_serialize', ['expenseApprovals']);
    }

    /**
     * View method
     *
     * @param string|null $id Expense Approval id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expenseApproval = $this->ExpenseApprovals->get($id, [
            'contain' => ['Users', 'Leads']
        ]);

        $this->set('expenseApproval', $expenseApproval);
        $this->set('_serialize', ['expenseApproval']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $expenseApproval = $this->ExpenseApprovals->newEntity();
        if ($this->request->is('post')) {
            $expenseApproval = $this->ExpenseApprovals->patchEntity($expenseApproval, $this->request->getData());
            if ($this->ExpenseApprovals->save($expenseApproval)) {
                $this->Flash->success(__('The expense approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense approval could not be saved. Please, try again.'));
        }
        $users = $this->ExpenseApprovals->Users->find('list', ['limit' => 200]);
        $leads = $this->ExpenseApprovals->Leads->find('list', ['limit' => 200]);
        $this->set(compact('expenseApproval', 'users', 'leads'));
        $this->set('_serialize', ['expenseApproval']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Expense Approval id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $expenseApproval = $this->ExpenseApprovals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expenseApproval = $this->ExpenseApprovals->patchEntity($expenseApproval, $this->request->getData());
            if ($this->ExpenseApprovals->save($expenseApproval)) {
                $this->Flash->success(__('The expense approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense approval could not be saved. Please, try again.'));
        }
        $users = $this->ExpenseApprovals->Users->find('list', ['limit' => 200]);
        $leads = $this->ExpenseApprovals->Leads->find('list', ['limit' => 200]);
        $this->set(compact('expenseApproval', 'users', 'leads'));
        $this->set('_serialize', ['expenseApproval']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Expense Approval id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expenseApproval = $this->ExpenseApprovals->get($id);
        if ($this->ExpenseApprovals->delete($expenseApproval)) {
            $this->Flash->success(__('The expense approval has been deleted.'));
        } else {
            $this->Flash->error(__('The expense approval could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
