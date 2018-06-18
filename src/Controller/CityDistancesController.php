<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CityDistances Controller
 *
 * @property \App\Model\Table\CityDistancesTable $CityDistances
 *
 * @method \App\Model\Entity\CityDistance[] paginate($object = null, array $settings = [])
 */
class CityDistancesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

      $this->paginate = [
          'contain' => ['CitiesFrom','CitiesTo']
      ];
        $cityDistances = $this->paginate($this->CityDistances);

        //pr($cityDistances);exit;

        $this->set(compact('cityDistances'));
        $this->set('_serialize', ['cityDistances']);
    }

    /**
     * View method
     *
     * @param string|null $id City Distance id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cityDistance = $this->CityDistances->get($id, [
            'contain' => ['CitiesFrom','CitiesTo']
        ]);

        $this->set('cityDistance', $cityDistance);
        $this->set('_serialize', ['cityDistance']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Cities');
        $cityDistance = $this->CityDistances->newEntity();
        if ($this->request->is('post')) {
              $cityDistance = $this->CityDistances->find('all',[
                'conditions'=>[
                  'city_from' => $this->request->data['city_from'],
                  'city_to' => $this->request->data['city_to']
                ]
              ])->first();
              if(!$cityDistance){
                $cityDistance = $this->CityDistances->patchEntity($cityDistance, $this->request->getData());
                if ($this->CityDistances->save($cityDistance)) {
                    $this->Flash->success(__('The city distance has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
               $this->Flash->error(__('The city distance could not be saved. Please, try again.'));
             }else {
               $this->Flash->error(__('The city distance has been saved already. Please, try again.'));
             }
        }
        $cities = $this->Cities->find('list', ['keyField' => 'id','valueField' => 'city_name']);
        $this->set(compact('cityDistance', 'cities'));
        $this->set('_serialize', ['cityDistance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id City Distance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Cities');
        $cityDistance = $this->CityDistances->get($id, [
            'contain' => ['CitiesFrom','CitiesTo']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cityDistance = $this->CityDistances->patchEntity($cityDistance, $this->request->getData());
            if ($this->CityDistances->save($cityDistance)) {
                $this->Flash->success(__('The city distance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city distance could not be saved. Please, try again.'));
        }
        $cities = $this->Cities->find('list', ['keyField' => 'id','valueField' => 'city_name']);
        $this->set(compact('cityDistance', 'cities'));
        $this->set('_serialize', ['cityDistance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id City Distance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cityDistance = $this->CityDistances->get($id);
        if ($this->CityDistances->delete($cityDistance)) {
            $this->Flash->success(__('The city distance has been deleted.'));
        } else {
            $this->Flash->error(__('The city distance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
