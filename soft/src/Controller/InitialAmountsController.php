<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InitialAmounts Controller
 *
 * @property \App\Model\Table\InitialAmountsTable $InitialAmounts
 */
class InitialAmountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin_views');
        $this->paginate = [
            'contain' => ['Associations', 'Tracts']
        ];
        $initialAmounts = $this->paginate($this->InitialAmounts);

        $this->set(compact('initialAmounts'));
        $this->set('_serialize', ['initialAmounts']);
    }

    /**
     * View method
     *
     * @param string|null $id Initial Amount id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $initialAmount = $this->InitialAmounts->get($id, [
            'contain' => ['Associations', 'Tracts']
        ]);

        $this->set('initialAmount', $initialAmount);
        $this->set('_serialize', ['initialAmount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('admin_views');
        $initialAmount = $this->InitialAmounts->newEntity();
        if ($this->request->is('post')) {
            $initialAmount = $this->InitialAmounts->patchEntity($initialAmount, $this->request->data);
            if ($this->InitialAmounts->save($initialAmount)) {
                $this->Flash->success(__('The initial amount has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The initial amount could not be saved. Please, try again.'));
            }
        }
        $associations = $this->InitialAmounts->Associations->find('list', ['limit' => 200]);
        $tracts = $this->InitialAmounts->Tracts->find('list', ['limit' => 200]);
        $this->set(compact('initialAmount', 'associations', 'tracts'));
        $this->set('_serialize', ['initialAmount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Initial Amount id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $initialAmount = $this->InitialAmounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $initialAmount = $this->InitialAmounts->patchEntity($initialAmount, $this->request->data);
            if ($this->InitialAmounts->save($initialAmount)) {
                $this->Flash->success(__('The initial amount has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The initial amount could not be saved. Please, try again.'));
            }
        }
        $associations = $this->InitialAmounts->Associations->find('list', ['limit' => 200]);
        $tracts = $this->InitialAmounts->Tracts->find('list', ['limit' => 200]);
        $this->set(compact('initialAmount', 'associations', 'tracts'));
        $this->set('_serialize', ['initialAmount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Initial Amount id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $this->request->allowMethod(['post', 'delete']);
        $initialAmount = $this->InitialAmounts->get($id);
        if ($this->InitialAmounts->delete($initialAmount)) {
            $this->Flash->success(__('The initial amount has been deleted.'));
        } else {
            $this->Flash->error(__('The initial amount could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
