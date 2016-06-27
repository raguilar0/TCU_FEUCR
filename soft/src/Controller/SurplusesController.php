<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Surpluses Controller
 *
 * @property \App\Model\Table\SurplusesTable $Surpluses
 */
class SurplusesController extends AppController
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
            'contain' => ['Associations']
        ];
        $surpluses = $this->paginate($this->Surpluses);

        $this->set(compact('surpluses'));
        $this->set('_serialize', ['surpluses']);
    }

    /**
     * View method
     *
     * @param string|null $id Surplus id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $surplus = $this->Surpluses->get($id, [
            'contain' => ['Associations']
        ]);

        $this->set('surplus', $surplus);
        $this->set('_serialize', ['surplus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('admin_views');
        $surplus = $this->Surpluses->newEntity();
        if ($this->request->is('post')) {
            $surplus = $this->Surpluses->patchEntity($surplus, $this->request->data);
            if ($this->Surpluses->save($surplus)) {
                $this->Flash->success(__('El superhábit ha sido guardado'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El superhábit no ha podido ser guardado. Intentelo de nuevo'));
            }
        }
        $associations = $this->Surpluses->Associations->find('list', ['limit' => 200]);
        $this->set(compact('surplus', 'associations'));
        $this->set('_serialize', ['surplus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Surplus id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $surplus = $this->Surpluses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $surplus = $this->Surpluses->patchEntity($surplus, $this->request->data);
            if ($this->Surpluses->save($surplus)) {
                $this->Flash->success(__('El superhábit ha sido guardado'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El superhábit no ha podido ser guardado. Intentelo de nuevo'));
            }
        }
        $associations = $this->Surpluses->Associations->find('list', ['limit' => 200]);
        $this->set(compact('surplus', 'associations'));
        $this->set('_serialize', ['surplus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Surplus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->layout('admin_views');
        $this->request->allowMethod(['post', 'delete']);
        $surplus = $this->Surpluses->get($id);
        if ($this->Surpluses->delete($surplus)) {
            $this->Flash->success(__('El superhábit ha sido guardado.'));
        } else {
            $this->Flash->error(__('El superhábit no ha podido ser borrado. Intentelo de nuevo'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function showAssociations($id = null)
    {
        if($id)
        {
            $this->viewBuilder()->layout('admin_views');


            $query = $this->Surpluses->Associations->Headquarters->find()
                ->hydrate(false)
                ->select(['a.name','a.id','name'])
                ->join([
                    'table'=>'associations',
                    'alias'=>'a',
                    'type' => 'RIGHT',
                    'conditions'=>'Headquarters.id = a.headquarter_id',
                ])
                ->where(['a.enable'=>1])
                ->order(['Headquarters.name']);


            $query = $query->toArray();



            switch ($id) {
                case 1:
                    $query['link'] = 'add';
                    break;

            }

            $this->set('data',$query);

        }
        else
        {
            $this->redirect(['action'=>'/']);
        }
    }



}
