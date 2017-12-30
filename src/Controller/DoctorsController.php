<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Doctors Controller
 *
 * @property \App\Model\Table\DoctorsTable $Doctors
 *
 * @method \App\Model\Entity\Doctor[] paginate($object = null, array $settings = [])
 */
class DoctorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Specialities', 'States', 'Cities']
        ];
        $doctors = $this->paginate($this->Doctors);

        $this->set(compact('doctors'));
        $this->set('_serialize', ['doctors']);
    }

    /**
     * View method
     *
     * @param string|null $id Doctor id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doctor = $this->Doctors->get($id, [
            'contain' => ['Specialities', 'States', 'Cities', 'DoctorsRelation', 'WorkPlans', 'WorkReports']
        ]);

        $this->set('doctor', $doctor);
        $this->set('_serialize', ['doctor']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doctor = $this->Doctors->newEntity();
        if ($this->request->is('post')) {
            $doctor = $this->Doctors->patchEntity($doctor, $this->request->getData());
            if ($this->Doctors->save($doctor)) {
                $this->Flash->success(__('The doctor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'));
        }
        $specialities = $this->Doctors->Specialities->find('list');
        $states = $this->Doctors->States->find('list');
        $this->set(compact('doctor', 'specialities', 'states', 'cities'));
        $this->set('_serialize', ['doctor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doctor = $this->Doctors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctor = $this->Doctors->patchEntity($doctor, $this->request->getData());
            if ($this->Doctors->save($doctor)) {
                $this->Flash->success(__('The doctor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'));
        }
        $specialities = $this->Doctors->Specialities->find('list');
        $states = $this->Doctors->States->find('list');
        $cities = $this->Doctors->Cities->find('list')->where(['state_id =' => $doctor['state_id']])->toarray();
        $this->set(compact('doctor', 'specialities', 'states', 'cities'));
        $this->set('_serialize', ['doctor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctor = $this->Doctors->get($id);
        if ($this->Doctors->delete($doctor)) {
            $this->Flash->success(__('The doctor has been deleted.'));
        } else {
            $this->Flash->error(__('The doctor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function mrsGetDoctors()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$city = $data['city'];
		$doctors = $this->Doctors
			->find()
			->notMatching('DoctorsRelation', function ($q) use ($uid) {
				return $q->where(['DoctorsRelation.user_id' => $uid]);
			})->where(['city_id =' => $city]);
		if($data['speciality']!="")
		$doctors->where(['speciality_id =' => $data['speciality']]);
		$doctors->toarray();
		$listHtml='<option value="">Select Doctor</option>';
		foreach ($doctors as $doctor)
		$listHtml.='<option value="'.$doctor['id'].'">'.$doctor['name'].'</option>';
		
		echo $listHtml; exit;
    }
	
    public function getDoctorsOption()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		$uid = $this->Auth->user('id');
		$city = $data['city'];
		$uid = $data['user'];
		$doctors = $this->Doctors
			->find()
			->notMatching('DoctorsRelation', function ($q) use ($uid) {
				return $q->where(['DoctorsRelation.user_id' => $uid]);
			})->where(['city_id =' => $city]);
		$doctors->toarray();
		$listHtml='';
		foreach ($doctors as $doctor)
		$listHtml.='<option value="'.$doctor['id'].'">'.$doctor['name'].'</option>';
		
		$returnArray = array('success' => "1",'doctor_id' => $listHtml);
		echo json_encode($returnArray); 
		exit;
    }
    
    public function mrsGetDoctor()
    {
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$data = $this->request->data;
		
		$doctor = $this->Doctors->get($data['id'], [
            'contain' => ['Specialities', 'States', 'Cities', 'DoctorsRelation', 'WorkPlans', 'WorkReports']
        ]);
        
		$listHtml =  "";
        if($doctor){
			$listHtml ='<li>
				<div class="col-md-2">
					<label>Name</label>
				</div>
				<div class="col-md-10">
					<p>'.$doctor->name.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Speciality</label>
				</div>
				<div class="col-md-10">
					<p>'.$doctor->speciality->name.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Qualification</label>
				</div>
				<div class="col-md-10">
					<p>'.$doctor->qualification.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Address</label>
				</div>
				<div class="col-md-10">
					<p>'.$doctor->address.', '.$doctor->city->city_name.', '.$doctor->state->state_code.', '.$doctor->pincode.'</p>
				</div>
			</li>';
			
		}
		

		echo $listHtml; exit;
    }

}
