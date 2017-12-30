<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ChemistsRelation Controller
 *
 * @property \App\Model\Table\ChemistsRelationTable $ChemistsRelation
 *
 * @method \App\Model\Entity\ChemistsRelation[] paginate($object = null, array $settings = [])
 */
class ChemistsRelationController extends AppController
{

	 public function initialize() {
        parent::initialize();
        $this->loadModel('Config');
		$this->loadModel('States');
		$this->loadModel('Chemists');

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Chemists']
        ];
        $chemistsRelation = $this->paginate($this->ChemistsRelation);

        $this->set(compact('chemistsRelation'));
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * View method
     *
     * @param string|null $id Chemists Relation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemistsRelation = $this->ChemistsRelation->get($id, [
            'contain' => ['Users', 'Chemists']
        ]);

        $this->set('chemistsRelation', $chemistsRelation);
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemistsRelation = $this->ChemistsRelation->newEntity();
        if ($this->request->is('post')) {
            $rData=array('user_id'=>$_POST['user_id'],'chemist_ids'=>$_POST['chemist_id'],'is_active'=>1);
			$uid = $rData['user_id'];
			$previous_count = $this->ChemistsRelation->find()->where(['is_active' => true, 'user_id =' => $uid])->count();
			$chemistsCount=count($rData['chemist_ids']);
			$totalCount=$previous_count+$chemistsCount;
			$relationLimit = $this->Config->find()->select('value')->where(['scope' => 'mr_chemists_limit'])->first();
			$chemistsRelation = $this->ChemistsRelation->newEntity();
			if ($this->request->is('post') && $totalCount < $relationLimit->value) {
				foreach ($rData['chemist_ids'] as $chemist_id){
					$data = array('user_id'=>$rData['user_id'],'chemist_id'=>$chemist_id,'is_active'=>1);
					$chemistsRelation = $this->ChemistsRelation->patchEntity($chemistsRelation, $data);
					$data_count = $this->ChemistsRelation->find()->where(['user_id =' => $uid, 'chemist_id =' => $chemist_id])->count();
					if($data_count<1)
					{
						//print_r($data); exit;
						if ($this->ChemistsRelation->save($chemistsRelation)) {
							$id = $chemistsRelation->id;
							$returnArray = array('id'=>$id, 'status'=>'success'); 
							$this->Flash->success(__('The chemists relation(s) has been saved.'));
							return $this->redirect(['action' => 'index']);
						}
						else
						$this->Flash->error(__('The chemists relation could not be saved. Please, try again.'));
					}
				}
			}
			else
			$this->Flash->error(__('You have reached you limit.'));
        }
        $states = $this->States->find('list')->toarray();
        $this->set(compact('chemistsRelation', 'states'));
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Chemists Relation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemistsRelation = $this->ChemistsRelation->get($id, [
            'contain' => ['Users','Chemists']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemistsRelation = $this->ChemistsRelation->patchEntity($chemistsRelation, $this->request->getData());
            if ($this->ChemistsRelation->save($chemistsRelation)) {
                $this->Flash->success(__('The chemists relation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chemists relation could not be saved. Please, try again.'));
        }
        $uid = $chemistsRelation->user_id;
		$userCity = $chemistsRelation->user->city_id;
        
		$chemists=array($chemistsRelation->chemist_id => $chemistsRelation->chemist->name);
        $users = $this->ChemistsRelation->Users->find('list')->where(['city_id =' => $userCity]);
        $chemistRel = $this->Chemists
			->find()
			->notMatching('ChemistsRelation', function ($q) use ($uid) {
				return $q->where(['ChemistsRelation.user_id' => $uid]);
			})->where(['city_id =' => $userCity])->toarray();
		foreach ($chemistRel as $chemist)
		$chemists[$chemist['id']]=$chemist['name'];
        $this->set(compact('chemistsRelation', 'users', 'chemists'));
        $this->set('_serialize', ['chemistsRelation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Chemists Relation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemistsRelation = $this->ChemistsRelation->get($id);
        if ($this->ChemistsRelation->delete($chemistsRelation)) {
            $this->Flash->success(__('The chemists relation has been deleted.'));
        } else {
            $this->Flash->error(__('The chemists relation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function mrsAdd()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$row_count = $this->ChemistsRelation->find()->where(['is_active' => true, 'user_id =' => $uid])->count();
		$relationLimit = $this->Config->find()->select('value')->where(['scope' => 'mr_chemists_limit'])->first();
        $chemistsRelation = $this->ChemistsRelation->newEntity();
        if ($this->request->is('post') && $row_count < $relationLimit->value) {
			$data=array('user_id'=>$uid,'chemist_id'=>$_POST['chemist_id'],'is_active'=>1);
            $chemistsRelation = $this->ChemistsRelation->patchEntity($chemistsRelation, $data);
			$data_count = $this->ChemistsRelation->find()->where(['is_active' => true, 'user_id =' => $uid, 'chemist_id =' => $data['chemist_id']])->count();
            if($data_count<1)
            {            
				if ($this->ChemistsRelation->save($chemistsRelation)) {
					$id = $chemistsRelation->id;
					$returnArray = array('id'=>$id, 'status'=>'success'); 
					$this->Flash->success(__('The chemists relation has been saved.'));
				}
				else
				$this->Flash->error(__('The chemists relation could not be saved. Please, try again.'));
			}
			else
			$this->Flash->error(__('The relation already exists. Please, try again.'));
        }
        else
        $this->Flash->error(__('You have reached you limit.'));
        
        return $this->redirect(['controller' => 'Mrs','action' => 'chemistList']);
    }
    
    public function mrsUpdate($id = null)
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$id = $_POST['id'];
        $chemistsRelation = $this->ChemistsRelation->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemistsRelation = $this->ChemistsRelation->patchEntity($chemistsRelation, $this->request->getData());
            if ($this->ChemistsRelation->save($chemistsRelation)) {
                $this->Flash->success(__('The chemists relation has been saved.'));

                return $this->redirect(['controller' => 'Mrs','action' => 'chemistList']);
            }
            $this->Flash->error(__('The chemists relation could not be saved. Please, try again.'));
        }
    }

    public function mrsDelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemistsRelation = $this->ChemistsRelation->get($id);
        if ($this->ChemistsRelation->delete($chemistsRelation)) {
            $this->Flash->success(__('The chemists relation has been deleted.'));
        } else {
            $this->Flash->error(__('The chemists relation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Mrs','action' => 'chemistList']);
    }
    
    public function mrsGetRelation()
    {
		$this->autoRender = false;
        $this->viewBuilder()->layout(false);
		$uid = $this->Auth->user('id');
		$data = $this->request->data;
		$chemistsRelation = $this->ChemistsRelation->get($data['id'], [
            'contain' => ['Chemists']
        ]);
        
		$returnArray = array('success' => "1",'id' => $chemistsRelation->id,'city' => $chemistsRelation->chemist->city_id,'chemist' => '<option value="'.$chemistsRelation->chemist->id.'" selected>'.$chemistsRelation->chemist->name.'</option>');
		echo json_encode($returnArray); 
		exit;   
     }

   

}
