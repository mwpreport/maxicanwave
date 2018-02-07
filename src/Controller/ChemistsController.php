<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Chemists Controller
 *
 * @property \App\Model\Table\ChemistsTable $Chemists
 *
 * @method \App\Model\Entity\Chemist[] paginate($object = null, array $settings = [])
 */
class ChemistsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['States', 'Cities']
        ];
        $chemists = $this->paginate($this->Chemists);

        $this->set(compact('chemists'));
        $this->set('_serialize', ['chemists']);
    }

    /**
     * View method
     *
     * @param string|null $id Chemist id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemist = $this->Chemists->get($id, [
            'contain' => ['States', 'Cities']
        ]);

        $this->set('chemist', $chemist);
        $this->set('_serialize', ['chemist']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$uid = $this->Auth->user('id');
        $chemist = $this->Chemists->newEntity();
        if ($this->request->is('post')) {
            $chemist = $this->Chemists->patchEntity($chemist, $this->request->getData());
            $chemist->user_id=$uid;
            if ($this->Chemists->save($chemist)) {
                $this->Flash->success(__('The chemist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chemist could not be saved. Please, try again.'));
        }
        $states = $this->Chemists->States->find('list');
        $this->set(compact('chemist', 'states'));
        $this->set('_serialize', ['chemist']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Chemist id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemist = $this->Chemists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemist = $this->Chemists->patchEntity($chemist, $this->request->getData());
            if ($this->Chemists->save($chemist)) {
                $this->Flash->success(__('The chemist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chemist could not be saved. Please, try again.'));
        }
        $states = $this->Chemists->States->find('list');
        $cities = $this->Chemists->Cities->find('list')->where(['state_id =' => $chemist['state_id']])->toarray();
        $this->set(compact('chemist', 'states', 'cities'));
        $this->set('_serialize', ['chemist']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Chemist id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {        
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $this->request->allowMethod(['post', 'delete']);
        $chemist = $this->Chemists->get($id);
        if ($this->Chemists->delete($chemist)) {
            $this->Flash->success(__('The chemist has been deleted.'));
        } else {
            $this->Flash->error(__('The chemist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
        
}
