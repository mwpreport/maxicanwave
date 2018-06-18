<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OtherExpenses Controller
 *
 * @property \App\Model\Table\OtherExpensesTable $OtherExpenses
 *
 * @method \App\Model\Entity\OtherExpense[] paginate($object = null, array $settings = [])
 */
class OtherExpensesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Expenses']
        ];
        $otherExpenses = $this->paginate($this->OtherExpenses);

        $this->set(compact('otherExpenses'));
        $this->set('_serialize', ['otherExpenses']);
    }

    /**
     * View method
     *
     * @param string|null $id Other Expense id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $otherExpense = $this->OtherExpenses->get($id, [
            'contain' => ['Expenses']
        ]);

        $this->set('otherExpense', $otherExpense);
        $this->set('_serialize', ['otherExpense']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $otherExpense = $this->OtherExpenses->newEntity();
        if ($this->request->is('post')) {
            $otherExpense = $this->OtherExpenses->patchEntity($otherExpense, $this->request->getData());
            if ($this->OtherExpenses->save($otherExpense)) {
                $this->Flash->success(__('The other expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The other expense could not be saved. Please, try again.'));
        }
        $expenses = $this->OtherExpenses->Expenses->find('list', ['limit' => 200]);
        $this->set(compact('otherExpense', 'expenses'));
        $this->set('_serialize', ['otherExpense']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Other Expense id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $otherExpense = $this->OtherExpenses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $otherExpense = $this->OtherExpenses->patchEntity($otherExpense, $this->request->getData());
            if ($this->OtherExpenses->save($otherExpense)) {
                $this->Flash->success(__('The other expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The other expense could not be saved. Please, try again.'));
        }
        $expenses = $this->OtherExpenses->Expenses->find('list', ['limit' => 200]);
        $this->set(compact('otherExpense', 'expenses'));
        $this->set('_serialize', ['otherExpense']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Other Expense id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $otherExpense = $this->OtherExpenses->get($id);
        if ($this->OtherExpenses->delete($otherExpense)) {
            $this->Flash->success(__('The other expense has been deleted.'));
        } else {
            $this->Flash->error(__('The other expense could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
