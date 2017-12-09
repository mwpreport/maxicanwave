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
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Doctors']
        ];
        $doctorsRelation = $this->paginate($this->DoctorsRelation);

        $this->set(compact('doctorsRelation'));
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
            'contain' => ['Users', 'Doctors']
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
        $doctorsRelation = $this->DoctorsRelation->newEntity();
        if ($this->request->is('post')) {
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $this->request->getData());
            if ($this->DoctorsRelation->save($doctorsRelation)) {
                $this->Flash->success(__('The doctors relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
        }
        $users = $this->DoctorsRelation->Users->find('list', ['limit' => 200]);
        $doctors = $this->DoctorsRelation->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('doctorsRelation', 'users', 'doctors'));
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $this->request->getData());
            if ($this->DoctorsRelation->save($doctorsRelation)) {
                $this->Flash->success(__('The doctors relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
        }
        $users = $this->DoctorsRelation->Users->find('list', ['limit' => 200]);
        $doctors = $this->DoctorsRelation->Doctors->find('list', ['limit' => 200]);
        $this->set(compact('doctorsRelation', 'users', 'doctors'));
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
		$row_count = $this->DoctorsRelation->find()->where(['is_active' => true, 'user_id =' => $uid])->count();
		$relationLimit = $this->Config->find()->select('value')->where(['scope' => 'mr_doctors_limit'])->first();
        $doctorsRelation = $this->DoctorsRelation->newEntity();
        if ($this->request->is('post') && $row_count < $relationLimit->value) {
			$data=array('user_id'=>$uid,'doctor_id'=>$_POST['doctor'],'class'=>$_POST['class'],'is_active'=>1);
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $data);
            
            if ($this->DoctorsRelation->save($doctorsRelation)) {
				$id = $doctorsRelation->id;
				$returnArray = array('id'=>$id, 'status'=>'success'); 
				$this->Flash->success(__('The doctors relation has been saved.'));
            }
            else
            $this->Flash->error(__('The doctors relation could not be saved. Please, try again.'));
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
            $doctorsRelation = $this->DoctorsRelation->patchEntity($doctorsRelation, $this->request->getData());
            if ($this->DoctorsRelation->save($doctorsRelation)) {
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
