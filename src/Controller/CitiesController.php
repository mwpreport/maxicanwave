<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 *
 * @method \App\Model\Entity\City[] paginate($object = null, array $settings = [])
 */
class CitiesController extends AppController
{

     public function initialize() {
        parent::initialize();
        $this->loadModel('States');
    }

   /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['States']
        ];
        if(isset($_GET['state']))
        $filterState = $_GET['state'];
        else
        $filterState = $this->Auth->user('state_id');
        
		$uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        

        $cities = $this->paginate($this->Cities->find('all')->where(['state_id =' => $filterState]));
        $states = $this->States->find('all')->toarray();

        $this->set(compact('cities','states', 'filterState'));
        $this->set('_serialize', ['cities']);
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => ['States', 'Chemists', 'Doctors', 'Users', 'WorkPlans', 'WorkReports']
        ]);

        $this->set('city', $city);
        $this->set('_serialize', ['city']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $city = $this->Cities->newEntity();
        if ($this->request->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $states = $this->Cities->States->find('list', ['limit' => 200]);
        $this->set(compact('city', 'states'));
        $this->set('_serialize', ['city']);
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $states = $this->Cities->States->find('list', ['limit' => 200]);
        $this->set(compact('city', 'states'));
        $this->set('_serialize', ['city']);
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('The city has been deleted.'));
        } else {
            $this->Flash->error(__('The city could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function getCitiesOption()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$cities = $this->Cities->find('all')->where(['state_id =' => $data['state']])->toarray();
        $citiesHtml = '<option value="">Select City</option>';
        foreach ($cities as $city)
        $citiesHtml.='<option value="'.$city['id'].'">'.$city['city_name'].'</option>';
        
        $returnArray = array('success' => "1",'cities' => $citiesHtml);
		echo json_encode($returnArray); 
		exit;   

    }

}
