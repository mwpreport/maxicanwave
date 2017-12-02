<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ChemistsRelation Controller
 *
 * @property \App\Model\Table\ChemistsRelationTable $ChemistsRelation
 *
 * @method \App\Model\Entity\ChemistsRelation[] paginate($object = null, array $settings = [])
 */
class ChemistsRelationController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Chemists']
        ];
        $chemistsRelation = $this->paginate($this->ChemistsRelation);

        $this->set(compact('chemistsRelation'));
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * View method
     *
     * @param string|null $id Chemists Relation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemistsRelation = $this->ChemistsRelation->get($id, [
            'contain' => ['Users', 'Chemists']
        ]);

        $this->set('chemistsRelation', $chemistsRelation);
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemistsRelation = $this->ChemistsRelation->newEntity();
        if ($this->request->is('post')) {
            $chemistsRelation = $this->ChemistsRelation->patchEntity($chemistsRelation, $this->request->getData());
            if ($this->ChemistsRelation->save($chemistsRelation)) {
                $this->Flash->success(__('The chemists relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chemists relation could not be saved. Please, try again.'));
        }
        $users = $this->ChemistsRelation->Users->find('list', ['limit' => 200]);
        $chemists = $this->ChemistsRelation->Chemists->find('list', ['limit' => 200]);
        $this->set(compact('chemistsRelation', 'users', 'chemists'));
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Chemists Relation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemistsRelation = $this->ChemistsRelation->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemistsRelation = $this->ChemistsRelation->patchEntity($chemistsRelation, $this->request->getData());
            if ($this->ChemistsRelation->save($chemistsRelation)) {
                $this->Flash->success(__('The chemists relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chemists relation could not be saved. Please, try again.'));
        }
        $users = $this->ChemistsRelation->Users->find('list', ['limit' => 200]);
        $chemists = $this->ChemistsRelation->Chemists->find('list', ['limit' => 200]);
        $this->set(compact('chemistsRelation', 'users', 'chemists'));
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Chemists Relation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemistsRelation = $this->ChemistsRelation->get($id);
        if ($this->ChemistsRelation->delete($chemistsRelation)) {
            $this->Flash->success(__('The chemists relation has been deleted.'));
        } else {
            $this->Flash->error(__('The chemists relation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
