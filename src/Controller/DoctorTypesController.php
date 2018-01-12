<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DoctorTypes Controller
 *
 * @property \App\Model\Table\DoctorTypesTable $DoctorTypes
 *
 * @method \App\Model\Entity\DoctorType[] paginate($object = null, array $settings = [])
 */
class DoctorTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $doctorTypes = $this->paginate($this->DoctorTypes);

        $this->set(compact('doctorTypes'));
        $this->set('_serialize', ['doctorTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Doctor Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doctorType = $this->DoctorTypes->get($id, [
            'contain' => []
        ]);

        $this->set('doctorType', $doctorType);
        $this->set('_serialize', ['doctorType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doctorType = $this->DoctorTypes->newEntity();
        if ($this->request->is('post')) {
            $doctorType = $this->DoctorTypes->patchEntity($doctorType, $this->request->getData());
            if ($this->DoctorTypes->save($doctorType)) {
                $this->Flash->success(__('The doctor type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor type could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorType'));
        $this->set('_serialize', ['doctorType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctor Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doctorType = $this->DoctorTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorType = $this->DoctorTypes->patchEntity($doctorType, $this->request->getData());
            if ($this->DoctorTypes->save($doctorType)) {
                $this->Flash->success(__('The doctor type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor type could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorType'));
        $this->set('_serialize', ['doctorType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctor Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorType = $this->DoctorTypes->get($id);
        if ($this->DoctorTypes->delete($doctorType)) {
            $this->Flash->success(__('The doctor type has been deleted.'));
        } else {
            $this->Flash->error(__('The doctor type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
