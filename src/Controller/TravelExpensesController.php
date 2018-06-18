<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TravelExpenses Controller
 *
 * @property \App\Model\Table\TravelExpensesTable $TravelExpenses
 *
 * @method \App\Model\Entity\TravelExpense[] paginate($object = null, array $settings = [])
 */
class TravelExpensesController extends AppController
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
        $travelExpenses = $this->paginate($this->TravelExpenses);

        $this->set(compact('travelExpenses'));
        $this->set('_serialize', ['travelExpenses']);
    }

    /**
     * View method
     *
     * @param string|null $id Travel Expense id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $travelExpense = $this->TravelExpenses->get($id, [
            'contain' => ['Expenses']
        ]);

        $this->set('travelExpense', $travelExpense);
        $this->set('_serialize', ['travelExpense']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $travelExpense = $this->TravelExpenses->newEntity();
        if ($this->request->is('post')) {
            $travelExpense = $this->TravelExpenses->patchEntity($travelExpense, $this->request->getData());
            if ($this->TravelExpenses->save($travelExpense)) {
                $this->Flash->success(__('The travel expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The travel expense could not be saved. Please, try again.'));
        }
        $expenses = $this->TravelExpenses->Expenses->find('list', ['limit' => 200]);
        $this->set(compact('travelExpense', 'expenses'));
        $this->set('_serialize', ['travelExpense']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Travel Expense id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $travelExpense = $this->TravelExpenses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $travelExpense = $this->TravelExpenses->patchEntity($travelExpense, $this->request->getData());
            if ($this->TravelExpenses->save($travelExpense)) {
                $this->Flash->success(__('The travel expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The travel expense could not be saved. Please, try again.'));
        }
        $expenses = $this->TravelExpenses->Expenses->find('list', ['limit' => 200]);
        $this->set(compact('travelExpense', 'expenses'));
        $this->set('_serialize', ['travelExpense']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Travel Expense id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $travelExpense = $this->TravelExpenses->get($id);
        if ($this->TravelExpenses->delete($travelExpense)) {
            $this->Flash->success(__('The travel expense has been deleted.'));
        } else {
            $this->Flash->error(__('The travel expense could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
