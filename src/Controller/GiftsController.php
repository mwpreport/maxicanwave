<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Gifts Controller
 *
 * @property \App\Model\Table\GiftsTable $Gifts
 *
 * @method \App\Model\Entity\Gift[] paginate($object = null, array $settings = [])
 */
class GiftsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $gifts = $this->paginate($this->Gifts);

        $this->set(compact('gifts'));
        $this->set('_serialize', ['gifts']);
    }

    /**
     * View method
     *
     * @param string|null $id Gift id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gift = $this->Gifts->get($id, [
            'contain' => []
        ]);

        $this->set('gift', $gift);
        $this->set('_serialize', ['gift']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gift = $this->Gifts->newEntity();
        if ($this->request->is('post')) {
            $gift = $this->Gifts->patchEntity($gift, $this->request->getData());
            if ($this->Gifts->save($gift)) {
                $this->Flash->success(__('The gift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gift could not be saved. Please, try again.'));
        }
        $this->set(compact('gift'));
        $this->set('_serialize', ['gift']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gift id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gift = $this->Gifts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gift = $this->Gifts->patchEntity($gift, $this->request->getData());
            if ($this->Gifts->save($gift)) {
                $this->Flash->success(__('The gift has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gift could not be saved. Please, try again.'));
        }
        $this->set(compact('gift'));
        $this->set('_serialize', ['gift']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Gift id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gift = $this->Gifts->get($id);
        if ($this->Gifts->delete($gift)) {
            $this->Flash->success(__('The gift has been deleted.'));
        } else {
            $this->Flash->error(__('The gift could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
