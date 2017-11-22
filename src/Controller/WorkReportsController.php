<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WorkReports Controller
 *
 * @property \App\Model\Table\WorkReportsTable $WorkReports
 *
 * @method \App\Model\Entity\WorkReport[] paginate($object = null, array $settings = [])
 */
class WorkReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'WorkTypes', 'Plans', 'Cities', 'Doctors']
        ];
        $workReports = $this->paginate($this->WorkReports);

        $this->set(compact('workReports'));
        $this->set('_serialize', ['workReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Work Report id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workReport = $this->WorkReports->get($id, [
            'contain' => ['Users', 'WorkTypes', 'Plans', 'Cities', 'Doctors']
        ]);

        $this->set('workReport', $workReport);
        $this->set('_serialize', ['workReport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $workReport = $this->WorkReports->newEntity();
        if ($this->request->is('post')) {
            $workReport = $this->WorkReports->patchEntity($workReport, $this->request->getData());
            if ($this->WorkReports->save($workReport)) {
                $this->Flash->success(__('The work report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work report could not be saved. Please, try again.'));
        }
        $users = $this->WorkReports->Users->find('list', ['limit' => 200]);
        $workTypes = $this->WorkReports->WorkTypes->find('list', ['limit' => 200]);
        $plans = $this->WorkReports->Plans->find('list', ['limit' => 200]);
        $cities = $this->WorkReports->Cities->find('list', ['limit' => 200]);
        $doctors = $this->WorkReports->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('workReport', 'users', 'workTypes', 'plans', 'cities', 'doctors'));
        $this->set('_serialize', ['workReport']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Work Report id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $workReport = $this->WorkReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workReport = $this->WorkReports->patchEntity($workReport, $this->request->getData());
            if ($this->WorkReports->save($workReport)) {
                $this->Flash->success(__('The work report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work report could not be saved. Please, try again.'));
        }
        $users = $this->WorkReports->Users->find('list', ['limit' => 200]);
        $workTypes = $this->WorkReports->WorkTypes->find('list', ['limit' => 200]);
        $plans = $this->WorkReports->Plans->find('list', ['limit' => 200]);
        $cities = $this->WorkReports->Cities->find('list', ['limit' => 200]);
        $doctors = $this->WorkReports->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('workReport', 'users', 'workTypes', 'plans', 'cities', 'doctors'));
        $this->set('_serialize', ['workReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Work Report id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workReport = $this->WorkReports->get($id);
        if ($this->WorkReports->delete($workReport)) {
            $this->Flash->success(__('The work report has been deleted.'));
        } else {
            $this->Flash->error(__('The work report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
