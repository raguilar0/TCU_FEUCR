<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

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
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $this->paginate = [
            'contain' => ['Associations'=>function($q){
                return $q->where(['enable'=>1]);
            }]
        ];
        $surpluses = $this->paginate($this->Surpluses);

        $this->set(compact('surpluses'));
        $this->set('_serialize', ['surpluses']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
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
      if($this->Auth->user()){
          try
          {
              $this->viewBuilder()->layout('admin_views');
              $surplus = $this->Surpluses->get($id, [
                  'contain' => ['Associations']
              ]);

              $this->set('surplus', $surplus);
              $this->set('_serialize', ['surplus']);
          }
          catch (RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }

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
        $surplus = $this->Surpluses->newEntity();
        if ($this->request->is('post')) {
            $surplus = $this->Surpluses->patchEntity($surplus, $this->request->data);
            if ($this->Surpluses->save($surplus)) {
                $this->Flash->success(__('El superávit ha sido guardado'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El superávit no ha podido ser guardado. Intentelo de nuevo'));
            }
        }
        $associations = $this->Surpluses->Associations->find('list')
                                        ->where(['enable'=>1]);
        $this->set(compact('surplus', 'associations'));
        $this->set('_serialize', ['surplus']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
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
      if($this->Auth->user()){
          try
          {
              $this->viewBuilder()->layout('admin_views');
              $surplus = $this->Surpluses->get($id, [
                  'contain' => []
              ]);
              if ($this->request->is(['patch', 'post', 'put'])) {
                  $surplus = $this->Surpluses->patchEntity($surplus, $this->request->data);
                  if ($this->Surpluses->save($surplus)) {
                      $this->Flash->success(__('El superávit ha sido guardado'));
                      return $this->redirect(['action' => 'index']);
                  } else {
                      $this->Flash->error(__('El superávit no ha podido ser guardado. Intentelo de nuevo'));
                  }
              }
              $associations = $this->Surpluses->Associations->find('list')
                                            ->where(['enable'=>1]);
              $this->set(compact('surplus', 'associations'));
              $this->set('_serialize', ['surplus']);
          }
          catch (RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }

      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
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
      if($this->Auth->user()){
          try
          {
              $this->viewBuilder()->layout('admin_views');
              $this->request->allowMethod(['post', 'delete']);
              $surplus = $this->Surpluses->get($id);
              try
              {
                  if ($this->Surpluses->delete($surplus)) {
                      $this->Flash->success(__('El superávit ha sido borrado.'));
                  } else {
                      $this->Flash->error(__('El superávit no ha podido ser borrado. Intentelo de nuevo'));
                  }
                  return $this->redirect(['action' => 'index']);
              }
              catch (\PDOException $e)
              {
                  $this->Flash->error(__('Error al borrar el superávit. Esto puede deberse a que hay información asociada en la base de datos a este superávit. Borre cualquier información asociada y luego intente de nuevo.'));
                  return $this->redirect(['action' => 'index']);
              }
          }
          catch (RecordNotFoundException $record)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }

      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

}
