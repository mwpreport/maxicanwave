<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DailyAllowances Controller
 *
 * @property \App\Model\Table\DailyAllowancesTable $DailyAllowances
 *
 * @method \App\Model\Entity\DailyAllowance[] paginate($object = null, array $settings = [])
 */
class DailyAllowancesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ExpenseTypes', 'Roles']
        ];
        $dailyAllowances = $this->paginate($this->DailyAllowances);

        $this->set(compact('dailyAllowances'));
        $this->set('_serialize', ['dailyAllowances']);
    }

    /**
     * View method
     *
     * @param string|null $id Daily Allowance id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dailyAllowance = $this->DailyAllowances->get($id, [
            'contain' => ['ExpenseTypes', 'Roles']
        ]);

        $this->set('dailyAllowance', $dailyAllowance);
        $this->set('_serialize', ['dailyAllowance']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dailyAllowance = $this->DailyAllowances->newEntity();
        if ($this->request->is('post')) {
          $dailyAllowance = $this->DailyAllowances->find('all',[
            'conditions'=>[
              'expense_type_id' => $this->request->data['expense_type_id'],
              'role_id' => $this->request->data['role_id']
            ]
          ])->first();
          if(!$dailyAllowance){
            $dailyAllowance = $this->DailyAllowances->patchEntity($dailyAllowance, $this->request->getData());
            if ($this->DailyAllowances->save($dailyAllowance)) {
                $this->Flash->success(__('The daily allowance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The daily allowance could not be saved. Please, try again.'));
          }else{
            $this->Flash->error(__('The daily allowance has been saved already. Please, try again.'));
          }
        }
        $expenseTypes = $this->DailyAllowances->ExpenseTypes->find('list', ['limit' => 200]);
        $roles = $this->DailyAllowances->Roles->find('list', ['limit' => 200]);
        $this->set(compact('dailyAllowance', 'expenseTypes', 'roles'));
        $this->set('_serialize', ['dailyAllowance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Daily Allowance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dailyAllowance = $this->DailyAllowances->get($id, [
            'contain' => ['ExpenseTypes', 'Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dailyAllowance = $this->DailyAllowances->patchEntity($dailyAllowance, $this->request->getData());
            if ($this->DailyAllowances->save($dailyAllowance)) {
                $this->Flash->success(__('The daily allowance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The daily allowance could not be saved. Please, try again.'));
        }
        $expenseTypes = $this->DailyAllowances->ExpenseTypes->find('list', ['limit' => 200]);
        $roles = $this->DailyAllowances->Roles->find('list', ['limit' => 200]);
        $this->set(compact('dailyAllowance', 'expenseTypes', 'roles'));
        $this->set('_serialize', ['dailyAllowance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Daily Allowance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dailyAllowance = $this->DailyAllowances->get($id);
        if ($this->DailyAllowances->delete($dailyAllowance)) {
            $this->Flash->success(__('The daily allowance has been deleted.'));
        } else {
            $this->Flash->error(__('The daily allowance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
