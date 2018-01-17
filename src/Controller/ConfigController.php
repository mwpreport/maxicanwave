<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Config Controller
 *
 * @property \App\Model\Table\ConfigTable $Config
 *
 * @method \App\Model\Entity\Config[] paginate($object = null, array $settings = [])
 */
class ConfigController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $config = $this->paginate($this->Config);

        $this->set(compact('config'));
        $this->set('_serialize', ['config']);
    }

    /**
    public function view($id = null)
    {
        $config = $this->Config->get($id, [
            'contain' => []
        ]);

        $this->set('config', $config);
        $this->set('_serialize', ['config']);
    }
	*/

    /**
    public function add()
    {
        $config = $this->Config->newEntity();
        if ($this->request->is('post')) {
            $config = $this->Config->patchEntity($config, $this->request->getData());
            if ($this->Config->save($config)) {
                $this->Flash->success(__('The config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The config could not be saved. Please, try again.'));
        }
        $this->set(compact('config'));
        $this->set('_serialize', ['config']);
    }
	*/

    public function edit($id = null)
    {
        $config = $this->Config->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $config = $this->Config->patchEntity($config, $this->request->getData());
            if ($this->Config->save($config)) {
                $this->Flash->success(__('The config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The config could not be saved. Please, try again.'));
        }
        $this->set(compact('config'));
        $this->set('_serialize', ['config']);
    }

	/*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $config = $this->Config->get($id);
        if ($this->Config->delete($config)) {
            $this->Flash->success(__('The config has been deleted.'));
        } else {
            $this->Flash->error(__('The config could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	*/
}
