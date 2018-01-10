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
            'contain' => ['States', 'Cities', 'ChemistsRelation']
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
        $chemist = $this->Chemists->newEntity();
        if ($this->request->is('post')) {
            $chemist = $this->Chemists->patchEntity($chemist, $this->request->getData());
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
        $this->request->allowMethod(['post', 'delete']);
        $chemist = $this->Chemists->get($id);
        if ($this->Chemists->delete($chemist)) {
            $this->Flash->success(__('The chemist has been deleted.'));
        } else {
            $this->Flash->error(__('The chemist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function mrsGetChemists()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$city = $data['city'];
		$chemists = $this->Chemists
			->find()
			->notMatching('ChemistsRelation', function ($q) use ($uid) {
				return $q->where(['ChemistsRelation.user_id' => $uid]);
			})->where(['city_id =' => $city]);
		$chemists->toarray();
		$listHtml='<option value="">Select Chemist</option>';
		foreach ($chemists as $chemist)
		$listHtml.='<option value="'.$chemist['id'].'">'.$chemist['name'].'</option>';
		
		echo $listHtml; exit;
    }
    
    public function getChemistsOption()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$city = $data['city'];
		$uid = $data['user'];
		$chemists = $this->Chemists
			->find()
			->notMatching('ChemistsRelation', function ($q) use ($uid) {
				return $q->where(['ChemistsRelation.user_id' => $uid]);
			})->where(['city_id =' => $city]);
		$chemists->toarray();
		$listHtml='';
		foreach ($chemists as $chemist)
		$listHtml.='<option value="'.$chemist['id'].'">'.$chemist['name'].'</option>';
		
		$returnArray = array('success' => "1",'chemist_id' => $listHtml);
		echo json_encode($returnArray); 
		exit;
    }
    
    public function mrsGetChemist()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		
		$chemist = $this->Chemists->get($data['id'], [
            'contain' => ['States', 'Cities']
        ]);
        
		$listHtml =  "";
        if($chemist){
			$listHtml ='<li>
				<div class="col-md-2">
					<label>Name</label>
				</div>
				<div class="col-md-10">
					<p>'.$chemist->name.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Contact Person</label>
				</div>
				<div class="col-md-10">
					<p>'.$chemist->contact_person.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Contact</label>
				</div>
				<div class="col-md-10">
					<p>Email : '.$chemist->email.', Mobile : '.$chemist->email.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Address</label>
				</div>
				<div class="col-md-10">
					<p>'.$chemist->door_no.' - '.$chemist->street.',<br> '.$chemist->area.',<br> '.$chemist->city->city_name.', '.$chemist->state->state_code.', '.$chemist->pincode.'</p>
				</div>
			</li>';
			
		}
		

		echo $listHtml; exit;
    }

}
