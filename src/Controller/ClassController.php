<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Class Controller
 *
 * @property \App\Model\Table\ClassTable $Class
 *
 * @method \App\Model\Entity\Clas[] paginate($object = null, array $settings = [])
 */
class ClassController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $class = $this->paginate($this->Class);

        $this->set(compact('class'));
        $this->set('_serialize', ['class']);
    }

    /**
     * View method
     *
     * @param string|null $id Clas id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clas = $this->Class->get($id, [
            'contain' => []
        ]);

        $this->set('clas', $clas);
        $this->set('_serialize', ['clas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clas = $this->Class->newEntity();
        if ($this->request->is('post')) {
            $clas = $this->Class->patchEntity($clas, $this->request->getData());
            if ($this->Class->save($clas)) {
                $this->Flash->success(__('The clas has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clas could not be saved. Please, try again.'));
        }
        $this->set(compact('clas'));
        $this->set('_serialize', ['clas']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Clas id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clas = $this->Class->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clas = $this->Class->patchEntity($clas, $this->request->getData());
            if ($this->Class->save($clas)) {
                $this->Flash->success(__('The clas has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clas could not be saved. Please, try again.'));
        }
        $this->set(compact('clas'));
        $this->set('_serialize', ['clas']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Clas id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clas = $this->Class->get($id);
        if ($this->Class->delete($clas)) {
            $this->Flash->success(__('The clas has been deleted.'));
        } else {
            $this->Flash->error(__('The clas could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
