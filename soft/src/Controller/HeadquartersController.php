<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Headquarters Controller
 *
 * @property \App\Model\Table\HeadquartersTable $Headquarters
 */
class HeadquartersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $headquarters = $this->paginate($this->Headquarters);

            $this->set(compact('headquarters'));
            $this->set('_serialize', ['headquarters']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


    }

    /**
     * View method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $headquarters = $this->Headquarters->get($id, [
                'contain' => []
            ]);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


        $this->set('headquarters', $headquarters);
        $this->set('_serialize', ['headquarters']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $headquarters = $this->Headquarters->newEntity();
            if ($this->request->is('post')) {
                $headquarters = $this->Headquarters->patchEntity($headquarters, $this->request->data);
                if ($this->Headquarters->save($headquarters)) {
                    $this->Flash->success(__('The headquarters has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The headquarters could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('headquarters'));
            $this->set('_serialize', ['headquarters']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $headquarters = $this->Headquarters->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $headquarters = $this->Headquarters->patchEntity($headquarters, $this->request->data);
                if ($this->Headquarters->save($headquarters)) {
                    $this->Flash->success(__('The headquarters has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The headquarters could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('headquarters'));
            $this->set('_serialize', ['headquarters']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


    }

    /**
     * Delete method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $this->request->allowMethod(['post', 'delete']);
            $headquarters = $this->Headquarters->get($id);
            if ($this->Headquarters->delete($headquarters)) {
                $this->Flash->success(__('The headquarters has been deleted.'));
            } else {
                $this->Flash->error(__('The headquarters could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }

    }
}
