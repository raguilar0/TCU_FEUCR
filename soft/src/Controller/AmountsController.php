<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Amounts Controller
 *
 * @property \App\Model\Table\AmountsTable $Amounts
 */
class AmountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $this->paginate = [
            'contain' => ['Associations', 'Tracts']
        ];
        $amounts = $this->paginate($this->Amounts);

        $this->set(compact('amounts'));
        $this->set('_serialize', ['amounts']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    /**
     * View method
     *
     * @param string|null $id Amount id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $amount = $this->Amounts->get($id, [
            'contain' => ['Associations', 'Tracts']
        ]);

        $this->set('amount', $amount);
        $this->set('_serialize', ['amount']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $amount = $this->Amounts->newEntity();
        if ($this->request->is('post')) {
            $amount = $this->Amounts->patchEntity($amount, $this->request->data);
            if ($this->Amounts->save($amount)) {
                $this->Flash->success(__('The amount has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The amount could not be saved. Please, try again.'));
            }
        }
        $associations = $this->Amounts->Associations->find('list', ['limit' => 200]);
        $tracts = $this->Amounts->Tracts->find('list', ['limit' => 200]);
        $this->set(compact('amount', 'associations', 'tracts'));
        $this->set('_serialize', ['amount']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    /**
     * Edit method
     *
     * @param string|null $id Amount id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $amount = $this->Amounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $amount = $this->Amounts->patchEntity($amount, $this->request->data);
            if ($this->Amounts->save($amount)) {
                $this->Flash->success(__('The amount has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The amount could not be saved. Please, try again.'));
            }
        }
        $associations = $this->Amounts->Associations->find('list', ['limit' => 200]);
        $tracts = $this->Amounts->Tracts->find('list', ['limit' => 200]);
        $this->set(compact('amount', 'associations', 'tracts'));
        $this->set('_serialize', ['amount']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    /**
     * Delete method
     *
     * @param string|null $id Amount id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      if($this->Auth->user()){
        $this->request->allowMethod(['post', 'delete']);
        $amount = $this->Amounts->get($id);
        if ($this->Amounts->delete($amount)) {
            $this->Flash->success(__('The amount has been deleted.'));
        } else {
            $this->Flash->error(__('The amount could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }  
    }
}
