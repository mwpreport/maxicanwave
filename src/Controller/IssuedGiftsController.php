<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * IssuedGifts Controller
 *
 * @property \App\Model\Table\IssuedGiftsTable $IssuedGifts
 *
 * @method \App\Model\Entity\IssuedGift[] paginate($object = null, array $settings = [])
 */
class IssuedGiftsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gifts', 'Users', 'Doctors']
        ];
        $issuedGifts = $this->paginate($this->IssuedGifts);

        $this->set(compact('issuedGifts'));
        $this->set('_serialize', ['issuedGifts']);
    }*/

    /**
     * View method
     *
     * @param string|null $id Issued Gift id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     
    public function view($id = null)
    {
        $issuedGift = $this->IssuedGifts->get($id, [
            'contain' => ['Gifts', 'Users', 'Doctors']
        ]);

        $this->set('issuedGift', $issuedGift);
        $this->set('_serialize', ['issuedGift']);
    }*/

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     
    public function add()
    {
        $issuedGift = $this->IssuedGifts->newEntity();
        if ($this->request->is('post')) {
            $issuedGift = $this->IssuedGifts->patchEntity($issuedGift, $this->request->getData());
            if ($this->IssuedGifts->save($issuedGift)) {
                $this->Flash->success(__('The issued gift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issued gift could not be saved. Please, try again.'));
        }
        $gifts = $this->IssuedGifts->Gifts->find('list', ['limit' => 200]);
        $users = $this->IssuedGifts->Users->find('list', ['limit' => 200]);
        $doctors = $this->IssuedGifts->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('issuedGift', 'gifts', 'users', 'doctors'));
        $this->set('_serialize', ['issuedGift']);
    }*/

    /**
     * Edit method
     *
     * @param string|null $id Issued Gift id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     
    public function edit($id = null)
    {
        $issuedGift = $this->IssuedGifts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issuedGift = $this->IssuedGifts->patchEntity($issuedGift, $this->request->getData());
            if ($this->IssuedGifts->save($issuedGift)) {
                $this->Flash->success(__('The issued gift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issued gift could not be saved. Please, try again.'));
        }
        $gifts = $this->IssuedGifts->Gifts->find('list', ['limit' => 200]);
        $users = $this->IssuedGifts->Users->find('list', ['limit' => 200]);
        $doctors = $this->IssuedGifts->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('issuedGift', 'gifts', 'users', 'doctors'));
        $this->set('_serialize', ['issuedGift']);
    }*/

    /**
     * Delete method
     *
     * @param string|null $id Issued Gift id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issuedGift = $this->IssuedGifts->get($id);
        if ($this->IssuedGifts->delete($issuedGift)) {
            $this->Flash->success(__('The issued gift has been deleted.'));
        } else {
            $this->Flash->error(__('The issued gift could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
