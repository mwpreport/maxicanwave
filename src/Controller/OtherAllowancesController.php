<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OtherAllowances Controller
 *
 * @property \App\Model\Table\OtherAllowancesTable $OtherAllowances
 *
 * @method \App\Model\Entity\OtherAllowance[] paginate($object = null, array $settings = [])
 */
class OtherAllowancesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $otherAllowances = $this->paginate($this->OtherAllowances);

        $this->set(compact('otherAllowances'));
        $this->set('_serialize', ['otherAllowances']);
    }

    /**
     * View method
     *
     * @param string|null $id Other Allowance id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $otherAllowance = $this->OtherAllowances->get($id, [
            'contain' => []
        ]);

        $this->set('otherAllowance', $otherAllowance);
        $this->set('_serialize', ['otherAllowance']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $otherAllowance = $this->OtherAllowances->newEntity();
        if ($this->request->is('post')) {
            $otherAllowance = $this->OtherAllowances->patchEntity($otherAllowance, $this->request->getData());
            if ($this->OtherAllowances->save($otherAllowance)) {
                $this->Flash->success(__('The other allowance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The other allowance could not be saved. Please, try again.'));
        }
        $this->set(compact('otherAllowance'));
        $this->set('_serialize', ['otherAllowance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Other Allowance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $otherAllowance = $this->OtherAllowances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $otherAllowance = $this->OtherAllowances->patchEntity($otherAllowance, $this->request->getData());
            if ($this->OtherAllowances->save($otherAllowance)) {
                $this->Flash->success(__('The other allowance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The other allowance could not be saved. Please, try again.'));
        }
        $this->set(compact('otherAllowance'));
        $this->set('_serialize', ['otherAllowance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Other Allowance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $otherAllowance = $this->OtherAllowances->get($id);
        if ($this->OtherAllowances->delete($otherAllowance)) {
            $this->Flash->success(__('The other allowance has been deleted.'));
        } else {
            $this->Flash->error(__('The other allowance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
