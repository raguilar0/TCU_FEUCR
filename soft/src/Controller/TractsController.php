<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tracts Controller
 *
 * @property \App\Model\Table\TractsTable $Tracts
 */
class TractsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin_views');
        $tracts = $this->paginate($this->Tracts);

        $this->set(compact('tracts'));
        $this->set('_serialize', ['tracts']);
    }

    /**
     * View method
     *
     * @param string|null $id Tract id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $tract = $this->Tracts->get($id, [
            'contain' => ['Amounts', 'Boxes', 'InitialAmounts', 'Invoices']
        ]);

        $this->set('tract', $tract);
        $this->set('_serialize', ['tract']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('admin_views');
        $tract = $this->Tracts->newEntity();
        if ($this->request->is('post')) {
            $tract = $this->Tracts->patchEntity($tract, $this->request->data);
            if ($this->Tracts->save($tract)) {
                $this->Flash->success(__('The tract has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tract could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('tract'));
        $this->set('_serialize', ['tract']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tract id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $tract = $this->Tracts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->data);
            $tract = $this->Tracts->patchEntity($tract, $this->request->data);
            if ($this->Tracts->save($tract)) {
                $this->Flash->success(__('The tract has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tract could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('tract'));
        $this->set('_serialize', ['tract']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tract id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $this->request->allowMethod(['post', 'delete']);
        $tract = $this->Tracts->get($id);
        if ($this->Tracts->delete($tract)) {
            $this->Flash->success(__('The tract has been deleted.'));
        } else {
            $this->Flash->error(__('The tract could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
