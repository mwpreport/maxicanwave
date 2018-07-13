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
	public function initialize() {
        parent::initialize();
		$this->loadComponent('Auth');
		$this->loadComponent('Date');
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Specialities', 'Qualifications', 'States', 'Cities']
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
            'contain' => ['Specialities', 'Qualifications', 'States', 'Cities']
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
		$uid = $this->Auth->user('id');
        $doctor = $this->Doctors->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['dob'] = $this->Date->db($data['dob']);
			$data['dow'] = $this->Date->db($data['dow']);
            $doctor = $this->Doctors->patchEntity($doctor, $data);
            $doctor->user_id=$uid;
            if ($this->Doctors->save($doctor)) {
				$this->generateCode($doctor->id);
                $this->Flash->success(__('The doctor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'));
        }
        $specialities = $this->Doctors->Specialities->find('list');
		$qualifications = $this->Doctors->Qualifications->find('list');
        $states = $this->Doctors->States->find('list');
        $this->set(compact('doctor', 'specialities', 'qualifications', 'states', 'cities'));
        $this->set('_serialize', ['doctor']);
    }
	
	public function generateCode($id)
    {
		$doctor = $this->Doctors->get($id, [
            'contain' => ['States']
        ]);
		$data['code'] = "DC".$doctor->state->state_code.sprintf("%05s",$id);
		$doctor = $this->Doctors->patchEntity($doctor, $data);
            $this->Doctors->save($doctor);
            return;
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
			$data = $this->request->getData();
			$data['dob'] = $this->Date->db($data['dob']);
			$data['dow'] = $this->Date->db($data['dow']);
            $doctor = $this->Doctors->patchEntity($doctor, $data);
            if ($this->Doctors->save($doctor)) {
                $this->Flash->success(__('The doctor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'));
        }
        $specialities = $this->Doctors->Specialities->find('list');
        $qualifications = $this->Doctors->Qualifications->find('list');
        $states = $this->Doctors->States->find('list');
        $cities = $this->Doctors->Cities->find('list')->where(['state_id =' => $doctor['state_id']])->toarray();
        $this->set(compact('doctor', 'specialities', 'qualifications', 'states', 'cities'));
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
            'contain' => ['Specialities', 'States', 'Cities', 'DoctorsRelation', 'Qualifications']
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
					<p>'.$doctor->qualification->name.', '.$doctor->add_qualification.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Contact</label>
				</div>
				<div class="col-md-10">
					<p>Email : '.$doctor->email.', Mobile : '.$doctor->email.'</p>
				</div>
			</li>
			<li>
				<div class="col-md-2">
					<label>Address</label>
				</div>
				<div class="col-md-10">
					<p>'.$doctor->clinic_name.',<br> '.$doctor->door_no.' - '.$doctor->street.',<br> '.$doctor->area.',<br> '.$doctor->city->city_name.' - '.$doctor->pincode.', '.$doctor->state->state_code.'</p>
				</div>
			</li>';
			
		}
		

		echo $listHtml; exit;
    }

    public function viewDoctorProfile()
    {
		$this->viewBuilder()->layout('iframe');
		$data = $this->request->query;
		$doctor = $this->Doctors->get($data['id'], [
            'contain' => ['Specialities', 'Qualifications', 'States', 'Cities']
        ]);

        $this->set('doctor', $doctor);
        $this->set('_serialize', ['doctor']);
    }

}
