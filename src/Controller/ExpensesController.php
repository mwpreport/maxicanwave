<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Expenses Controller
 *
 * @property \App\Model\Table\ExpensesTable $Expenses
 *
 * @method \App\Model\Entity\Expense[] paginate($object = null, array $settings = [])
 */
class ExpensesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'WorkPlanSubmit', 'ExpenseTypes']
        ];
        $expenses = $this->paginate($this->Expenses);

        $this->set(compact('expenses'));
        $this->set('_serialize', ['expenses']);
    }

    /**
     * View method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expense = $this->Expenses->get($id, [
            'contain' => ['Users', 'WorkPlanSubmit', 'ExpenseTypes', 'OtherExpenses', 'TravelExpenses']
        ]);

        $this->set('expense', $expense);
        $this->set('_serialize', ['expense']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $expense = $this->Expenses->newEntity();
        if ($this->request->is('post')) {
            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());
            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('The expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $users = $this->Expenses->Users->find('list', ['limit' => 200]);
        $workPlanSubmit = $this->Expenses->WorkPlanSubmit->find('list', ['limit' => 200]);
        $expenseTypes = $this->Expenses->ExpenseTypes->find('list', ['limit' => 200]);
        $this->set(compact('expense', 'users', 'workPlanSubmit', 'expenseTypes'));
        $this->set('_serialize', ['expense']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $expense = $this->Expenses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());
            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('The expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $users = $this->Expenses->Users->find('list', ['limit' => 200]);
        $workPlanSubmit = $this->Expenses->WorkPlanSubmit->find('list', ['limit' => 200]);
        $expenseTypes = $this->Expenses->ExpenseTypes->find('list', ['limit' => 200]);
        $this->set(compact('expense', 'users', 'workPlanSubmit', 'expenseTypes'));
        $this->set('_serialize', ['expense']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expense = $this->Expenses->get($id);
        if ($this->Expenses->delete($expense)) {
            $this->Flash->success(__('The expense has been deleted.'));
        } else {
            $this->Flash->error(__('The expense could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
