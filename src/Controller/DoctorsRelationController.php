<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DoctorsRelation Controller
 *
 * @property \App\Model\Table\DoctorsRelationTable $DoctorsRelation
 *
 * @method \App\Model\Entity\DoctorsRelation[] paginate($object = null, array $settings = [])
 */
class DoctorsRelationController extends AppController
{
	
	 public function initialize() {
        parent::initialize();
        $this->loadModel('Config');
		$this->loadModel('States');
		$this->loadModel('Doctors');
		$this->loadModel('DoctorTypes');

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Doctors', 'DoctorTypes']
        ];
		
		if(isset($_GET['user']))
        $filterUser = $_GET['user'];
		else
		$filterUser = 0;
	
        $doctorsRelation = $this->paginate($this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $filterUser]));
		$users = $this->Users->find('all')->where(['Users.role_id =' => 5,'Users.is_active =' => 1, 'Users.is_deleted =' => 0])->toarray();

        $this->set(compact('doctorsRelation', 'users', 'filterUser'));
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * View method
     *
     * @param string|null $id Doctors Relation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doctorsRelation = $this->DoctorsRelation->get($id, [
            'contain' => ['Users', 'Doctors', 'DoctorTypes']
        ]);

        $this->set('doctorsRelation', $doctorsRelation);
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
			$rData=array('user_id'=>$_POST['user_id'],'doctor_ids'=>$_POST['doctor_id'],'class'=>$_POST['class']);
			$uid = $rData['user_id'];
			$previous_count = $this->DoctorsRelation->find()->where(['user_id =' => $uid])->count();
			$doctorsCount=count($rData['doctor_ids']);
			$totalCount=$previous_count+$doctorsCount;
			$relationLimit = $this->Config->find()->select('value')->where(['scope' => 'mr_doctors_limit'])->first();
			if ($this->request->is('post') && $totalCount < $relationLimit->value) {
				foreach ($rData['doctor_ids'] as $doctor_id){
					$doctorsRelation = $this->DoctorsRelation->newEntity();
					$data = array('user_id'=>$rData['user_id'],'doctor_id'=>$doctor_id,'class'=>$rData['class']);
					$doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $data);
					$data_count = $this->DoctorsRelation->find()->where(['user_id =' => $uid, 'doctor_id =' => $doctor_id])->count();
					if($data_count<1)
					{
						if ($this->DoctorsRelation->save($doctorsRelation)) {
							$doctors = $this->Doctors->get($doctorsRelation['doctor_id']);
							$doctors = $this->Doctors->patchEntity($doctors, ['class' => $doctorsRelation['class']]);
							$this->Doctors->save($doctors);
						}
						else
						{
							$this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
							return $this->redirect(['action' => 'index']);
						}
					}
				}
				$this->Flash->success(__('The doctors relation(s) has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			else
			{
				$this->Flash->error(__('You have reached you limit.'));
				return $this->redirect(['action' => 'index']);
			}
        }
		$doctorTypes = $this->DoctorTypes->find('list')->toarray();
		$states = $this->States->find('list')->toarray();
        $this->set(compact('doctorsRelation', 'states', 'doctorTypes'));
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctors Relation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doctorsRelation = $this->DoctorsRelation->get($id, [
            'contain' => ['Users','Doctors']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $this->request->getData());
            if ($this->DoctorsRelation->save($doctorsRelation)) {
				$doctors = $this->Doctors->get($doctorsRelation['doctor_id']);
				$doctors = $this->Doctors->patchEntity($doctors, ['class' => $doctorsRelation['class']]);
				$this->Doctors->save($doctors);
                $this->Flash->success(__('The doctors relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
        }
		$uid = $doctorsRelation->user_id;
		$userCity = $doctorsRelation->user->city_id;
        
		$doctors=array($doctorsRelation->doctor_id => $doctorsRelation->doctor->name);
        $users = $this->DoctorsRelation->Users->find('list')->where(['city_id =' => $userCity]);
        $doctorRel = $this->Doctors
			->find()
			->notMatching('DoctorsRelation', function ($q) use ($uid) {
				return $q->where(['DoctorsRelation.user_id' => $uid]);
			})->where(['city_id =' => $userCity])->toarray();
		foreach ($doctorRel as $doctor)
		$doctors[$doctor['id']]=$doctor['name'];
		$doctorTypes = $this->DoctorTypes->find('list')->toarray();
        $this->set(compact('doctorsRelation', 'users', 'doctors', 'doctorTypes'));
        $this->set('_serialize', ['doctorsRelation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctors Relation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorsRelation = $this->DoctorsRelation->get($id);
        if ($this->DoctorsRelation->delete($doctorsRelation)) {
            $this->Flash->success(__('The doctors relation has been deleted.'));
        } else {
            $this->Flash->error(__('The doctors relation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function mrsAdd()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$row_count = $this->DoctorsRelation->find()->where(['user_id =' => $uid])->count();
		$relationLimit = $this->Config->find()->select('value')->where(['scope' => 'mr_doctors_limit'])->first();
        $doctorsRelation = $this->DoctorsRelation->newEntity();
        if ($this->request->is('post') && $row_count < $relationLimit->value) {
			$data=array('user_id'=>$uid,'doctor_id'=>$_POST['doctor_id'],'class'=>$_POST['class']);
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $data);
			$data_count = $this->DoctorsRelation->find()->where(['user_id =' => $uid, 'doctor_id =' => $data['doctor_id']])->count();
            if($data_count<1)
            {
				if ($this->DoctorsRelation->save($doctorsRelation)) {
					$id = $doctorsRelation->id;
					$doctors = $this->Doctors->get($data['doctor_id']);
					$doctors = $this->Doctors->patchEntity($doctors, ['class' => $data['class']]);
					$this->Doctors->save($doctors);
					$returnArray = array('id'=>$id, 'status'=>'success'); 
					$this->Flash->success(__('The doctors relation has been saved.'));
				}
				else
				$this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
			}
			else
			$this->Flash->error(__('The relation already exists. Please, try again.'));
        }
        else
        $this->Flash->error(__('You have reached you limit.'));
        
        return $this->redirect(['controller' => 'Mrs','action' => 'doctorList']);
    }
    
    public function mrsUpdate($id = null)
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$id = $_POST['id'];
        $doctorsRelation = $this->DoctorsRelation->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data =$this->request->getData();
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $data);
            if ($this->DoctorsRelation->save($doctorsRelation)) {
				$doctors = $this->Doctors->get($data['doctor_id']);
				$doctors = $this->Doctors->patchEntity($doctors, ['class' => $data['class']]);
				$this->Doctors->save($doctors);
                $this->Flash->success(__('The doctors relation has been saved.'));
                return $this->redirect(['controller' => 'Mrs','action' => 'doctorList']);
            }
            $this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
        }
    }

    public function mrsDelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorsRelation = $this->DoctorsRelation->get($id);
        if ($this->DoctorsRelation->delete($doctorsRelation)) {
            $this->Flash->success(__('The doctors relation has been deleted.'));
        } else {
            $this->Flash->error(__('The doctors relation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Mrs','action' => 'doctorList']);
    }
    
    public function mrsGetRelation()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$data = $this->request->data;
		$doctorsRelation = $this->DoctorsRelation->get($data['id'], [
            'contain' => ['Doctors']
        ]);
        
		$returnArray = array('success' => "1",'id' => $doctorsRelation->id,'city' => $doctorsRelation->doctor->city_id,'speciality' => $doctorsRelation->doctor->speciality_id,'doctor' => '<option value="'.$doctorsRelation->doctor->id.'" selected>'.$doctorsRelation->doctor->name.'</option>','class' => $doctorsRelation->class);
		echo json_encode($returnArray); 
		exit;   
     }   

}
