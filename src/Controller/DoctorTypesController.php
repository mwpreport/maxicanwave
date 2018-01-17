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
    public function index()
    {
        $doctorTypes = $this->paginate($this->DoctorTypes);

        $this->set(compact('doctorTypes'));
        $this->set('_serialize', ['doctorTypes']);
    }

    public function view($id = null)
    {
        $doctorType = $this->DoctorTypes->get($id, [
            'contain' => []
        ]);

        $this->set('doctorType', $doctorType);
        $this->set('_serialize', ['doctorType']);
    }

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
	*/
}
