<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Event\Event;

/**
 * Savings Controller
 *
 * @property \App\Model\Table\SavingsTable $Savings
 */
class SavingsController extends AppController
{
  
  
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('index');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');

        if(($this->request->session()->read('Auth.User.role')) == 'rep'){
          $association_id = $this->request->session()->read('Auth.User.association_id');

          $this->paginate['contain'] = [
            'Tracts',
            'Associations'=> function(\Cake\ORM\Query $query) use ($association_id){
                return $query->where(['Associations.id'=>$association_id]);
            }
          ];

            //$this->paginate = $querry;
            $savings = $this->paginate($this->Savings);

        }

        if(($this->request->session()->read('Auth.User.role')) == 'admin'){
          $this->paginate = [
              'contain' => ['Associations', 'Tracts']
          ];
          $savings = $this->paginate($this->Savings);
        }

        $this->set(compact('savings'));
        $this->set('_serialize', ['savings']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    /**
     * View method
     *
     * @param string|null $id Saving id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      if($this->Auth->user()){
          try
          {
              $this->viewBuilder()->layout('admin_views');

              if(($this->request->session()->read('Auth.User.role')) == 'admin'){
                  $saving = $this->Savings->get($id, [
                      'contain' => ['Associations', 'Tracts']
                  ]);
              }
          }
          catch (RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }


        if(($this->request->session()->read('Auth.User.role')) == 'rep'){
          $association_id = $this->request->session()->read('Auth.User.association_id');
          try
          {
              $saving = $this->Savings->get($id, [
              'contain' => ['Tracts','Associations'=> function(\Cake\ORM\Query $query) use ($association_id){
                return $query->where(['Associations.id'=>$association_id]);
            }]
             ]);
          }
          catch(Exception $e)
          {
             $this->Flash->error(__('No está autorizado a ver esta información.'));
          }

        }

        $this->set('saving', $saving);
        $this->set('_serialize', ['saving']);
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

        $saving = $this->Savings->newEntity();
        if ($this->request->is('post')) {

            $this->loadComponent('Upload');

            $letter = $this->request->data['letter'];
            unset($this->request->data['letter']); //Quitamos los datos del archivo

            $letter_name = $this->Upload->savePDF($letter);

            if(!empty($letter) && $letter_name)
            {
                $this->request->data['letter'] = $letter_name;
                
                if(($this->request->session()->read('Auth.User.role')) == 'rep'){
                  $this->request->data['association_id'] = $this->request->session()->read('Auth.User.association_id');
                }
                  
                $saving = $this->Savings->patchEntity($saving, $this->request->data);
                if ($this->Savings->save($saving)) {
                    $this->Flash->success(__('El ahorro ha sido guardado'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('El ahorro no pudo ser guardado. Intentelo de nuevo.'));
                }
            }
            else
            {
                $this->Flash->error(__('No se pudo guardar el archivo, por favor intente de nuevo más tarde.'));
            }
            
            
            

        }
        

        $associations = $this->Savings->Associations->find('list');
        

        $tracts = $this->Savings->Tracts->find()
            ->select(['id','date','deadline'])
            ->where(['YEAR(date)'=>date('Y')])
            ->orWhere(['YEAR(date)'=>(date('Y') + 1)]);
        $temp = array();

        foreach ($tracts as $key => $value)
        {
            $temp[$value->id] = $value->date." - ".$value->deadline;
        }

        $tracts = $temp;

        $this->set(compact('saving', 'associations', 'tracts'));
        $this->set('_serialize', ['saving']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    /**
     * Edit method
     *
     * @param string|null $id Saving id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if($this->Auth->user()){

          try
          {
              $this->viewBuilder()->layout('admin_views');
              $saving = $this->Savings->get($id, [
                  'contain' => []
              ]);
          }
          catch (RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }

        if ($this->request->is(['patch', 'post', 'put'])) {
          if(($this->request->session()->read('Auth.User.role')) == 'rep'){
              $this->request->data['association_id'] = $this->request->session()->read('Auth.User.association_id');
          }

            $saving = $this->Savings->patchEntity($saving, $this->request->data);

            if ($this->Savings->save($saving)) {
                $this->Flash->success(__('El ahorro ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El ahorro no ha podido ser guardado. Intentelo de nuevo'));
            }

        }
        $associations = $this->Savings->Associations->find('list');
        $tracts = $this->Savings->Tracts->find()
                                        ->select(['id','date','deadline'])
                                        ->where(['YEAR(date)'=>date('Y')])
                                        ->orWhere(['YEAR(date)'=>(date('Y') + 1)])
                                        ->orWhere(['YEAR(date)'=>(date('Y') - 1)]);
        $temp = array();

        foreach ($tracts as $key => $value)
        {
            $temp[$value->id] = $value->date." - ".$value->deadline;
        }

        $tracts = $temp;

        $this->set(compact('saving', 'associations'));
        $this->set(compact('saving', 'tracts'));
        $this->set('_serialize', ['saving']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    /**
     * Delete method
     *
     * @param string|null $id Saving id.
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
              $saving = $this->Savings->get($id);

              try
              {
                  $deleted = $this->deleteLetter($saving->letter);

                  if ($deleted && $this->Savings->delete($saving)) {
                      $this->Flash->success(__('El monto de ahorro se ha borrado correctamente.'));


                  } else {
                      $this->Flash->error(__('El ahorro no ha podido ser borrado. Intentelo de nuevo.'));
                  }
                  return $this->redirect(['action' => 'index']);
              }
              catch (\PDOException $e)
              {
                  $this->Flash->error(__('Error al borrar el monto de ahorro. Esto puede deberse a que existe información asociada a este monto de ahorro en la base de datos. Debe borrar cualquier información asociada y luego borrar el monto de ahorro.'));
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
    

    private function deleteLetter($fileName)
    {
        $deleted = false;
        $filePath = WWW_ROOT .'letters';

        try
        {
            $dir = new Folder($filePath);

            $file = new File($dir->pwd() . DS . $fileName);

            if($file->delete())
            {
                $deleted = true;
            }
        }
        catch (Exception $e)
        {
            $this->Flash->error(__('Ocurrió un error al tratar de borrar el archivo'));
            return $this->redirect(['action' => 'index']);
        }


        return $deleted;
    }

    public function download($fileName)
    {
        if($fileName)
        {
            try
            {
                $filePath = WWW_ROOT .'letters'. DS . $fileName;

                $this->response->file($filePath ,
                    ['download'=> true, 'name'=> $fileName, 'extension'=>'pdf']);
            }
            catch (Exception $e)
            {
                $this->Flash->error(__('Ocurrió un error al tratar de abrir el archivo'));
                return $this->redirect(['action' => 'index']);
            }

        }
        else
        {
            $this->Flash->error(__('El nombre del archivo es nulo'));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function isAuthorized($user)
    {

        if(in_array($this->request->action, ['add', 'download']))
        {
          return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['view', 'delete'])) {
            $accountId = (int)$this->request->params['pass'][0];
        
            if ($this->Savings->isOwnedBy($accountId, $user['association_id'])) {
                return true;
            }
        }
    
        return parent::isAuthorized($user);
    }
    
    
}
