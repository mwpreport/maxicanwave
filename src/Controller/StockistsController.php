<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Stockists Controller
 *
 * @property \App\Model\Table\StockistsTable $Stockists
 *
 * @method \App\Model\Entity\Stockist[] paginate($object = null, array $settings = [])
 */
class StockistsController extends AppController
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
        $stockists = $this->paginate($this->Stockists);

        $this->set(compact('stockists'));
        $this->set('_serialize', ['stockists']);
    }

    /**
     * View method
     *
     * @param string|null $id Stockist id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockist = $this->Stockists->get($id, [
            'contain' => ['States', 'Cities']
        ]);

        $this->set('stockist', $stockist);
        $this->set('_serialize', ['stockist']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$uid = $this->Auth->user('id');
        $stockist = $this->Stockists->newEntity();
        if ($this->request->is('post')) {
            $stockist = $this->Stockists->patchEntity($stockist, $this->request->getData());
            $stockist->user_id=$uid;
            if ($this->Stockists->save($stockist)) {
				$this->generateCode($stockist->id);
                $this->Flash->success(__('The stockist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockist could not be saved. Please, try again.'));
        }
        $states = $this->Stockists->States->find('list');
        $this->set(compact('stockist', 'states'));
        $this->set('_serialize', ['stockist']);
    }

	public function generateCode($id)
    {
		$stockist = $this->Stockists->get($id, [
            'contain' => ['States']
        ]);
		$data['code'] = "ST".$stockist->state->state_code.sprintf("%05s",$id);
		$stockist = $this->Stockists->patchEntity($stockist, $data);
            $this->Stockists->save($stockist);
            return;
    }

    /**
     * Edit method
     *
     * @param string|null $id Stockist id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockist = $this->Stockists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockist = $this->Stockists->patchEntity($stockist, $this->request->getData());
            if ($this->Stockists->save($stockist)) {
                $this->Flash->success(__('The stockist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stockist could not be saved. Please, try again.'));
        }
        $states = $this->Stockists->States->find('list');
        $cities = $this->Stockists->Cities->find('list')->where(['state_id =' => $stockist['state_id']])->toarray();
        $this->set(compact('stockist', 'states', 'cities'));
        $this->set('_serialize', ['stockist']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Stockist id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockist = $this->Stockists->get($id);
        if ($this->Stockists->delete($stockist)) {
            $this->Flash->success(__('The stockist has been deleted.'));
        } else {
            $this->Flash->error(__('The stockist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
}
