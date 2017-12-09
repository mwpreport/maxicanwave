<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WorkTypes Controller
 *
 * @property \App\Model\Table\WorkTypesTable $WorkTypes
 *
 * @method \App\Model\Entity\WorkType[] paginate($object = null, array $settings = [])
 */
class WorkTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $workTypes = $this->paginate($this->WorkTypes);

        $this->set(compact('workTypes'));
        $this->set('_serialize', ['workTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Work Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workType = $this->WorkTypes->get($id, [
            'contain' => ['WorkPlans', 'WorkReports']
        ]);

        $this->set('workType', $workType);
        $this->set('_serialize', ['workType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $workType = $this->WorkTypes->newEntity();
        if ($this->request->is('post')) {
            $workType = $this->WorkTypes->patchEntity($workType, $this->request->getData());
            if ($this->WorkTypes->save($workType)) {
                $this->Flash->success(__('The work type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work type could not be saved. Please, try again.'));
        }
        $this->set(compact('workType'));
        $this->set('_serialize', ['workType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Work Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $workType = $this->WorkTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workType = $this->WorkTypes->patchEntity($workType, $this->request->getData());
            if ($this->WorkTypes->save($workType)) {
                $this->Flash->success(__('The work type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work type could not be saved. Please, try again.'));
        }
        $this->set(compact('workType'));
        $this->set('_serialize', ['workType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Work Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workType = $this->WorkTypes->get($id);
        if ($this->WorkTypes->delete($workType)) {
            $this->Flash->success(__('The work type has been deleted.'));
        } else {
            $this->Flash->error(__('The work type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
