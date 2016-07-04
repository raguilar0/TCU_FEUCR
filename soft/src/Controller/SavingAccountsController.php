<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * SavingAccounts Controller
 *
 * @property \App\Model\Table\SavingAccountsTable $SavingAccounts
 */
class SavingAccountsController extends AppController
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
          $savingAccounts = $this->paginate($this->SavingAccounts);
        }

        if(($this->request->session()->read('Auth.User.role')) == 'admin'){
          $this->paginate = [
              'contain' => ['Associations', 'Tracts']
          ];
          $savingAccounts = $this->paginate($this->SavingAccounts);
        }
        $this->set(compact('savingAccounts'));
        $this->set('_serialize', ['savingAccounts']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    /**
     * View method
     *
     * @param string|null $id Saving Account id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $savingAccount = $this->SavingAccounts->get($id, [
            'contain' => ['Associations', 'Tracts']
        ]);

        $this->set('savingAccount', $savingAccount);
        $this->set('_serialize', ['savingAccount']);
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
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $savingAccount = $this->SavingAccounts->newEntity();
        if ($this->request->is('post')) {

            $savingAccount = $this->SavingAccounts->patchEntity($savingAccount, $this->request->data);
            if ($this->SavingAccounts->save($savingAccount)) {
                $this->Flash->success(__('La cuenta de ahorros ha sido guardada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La cuenta de ahorros no ha podido ser guardada. Inténtelo de nuevo'));
            }
            
        }
        $associations = $this->SavingAccounts->Associations->find('list');

        $tracts = $this->SavingAccounts->Tracts->find()
            ->select(['id','date','deadline'])
            ->where(['YEAR(date)'=>date('Y')])
            ->orWhere(['YEAR(date)'=>(date('Y') + 1)]);
        $temp = array();

        foreach ($tracts as $key => $value)
        {
            $temp[$value->id] = $value->date." - ".$value->deadline;
        }

        $tracts = $temp;

        $this->set(compact('savingAccount', 'associations', 'tracts'));
        $this->set('_serialize', ['savingAccount']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    /**
     * Edit method
     *
     * @param string|null $id Saving Account id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $savingAccount = $this->SavingAccounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
          
           if(($this->request->session()->read('Auth.User.role')) == 'rep'){
              $this->request->data['association_id'] = $this->request->session()->read('Auth.User.association_id');
           }
           
            $savingAccount = $this->SavingAccounts->patchEntity($savingAccount, $this->request->data);
            if ($this->SavingAccounts->save($savingAccount)) {
                $this->Flash->success(__('La cuenta de ahorros ha sido guardada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La cuenta de ahorros no ha podido ser guardada. Inténtelo de nuevo'));
            }
        }
        $associations = $this->SavingAccounts->Associations->find('list');
        $tracts = $this->SavingAccounts->Tracts->find()
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
        $this->set(compact('savingAccount', 'associations', 'tracts'));
        $this->set('_serialize', ['savingAccount']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    /**
     * Delete method
     *
     * @param string|null $id Saving Account id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      if($this->Auth->user() && ($this->request->session()->read('Auth.User.role') == 'admin') ){

        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
        $this->request->allowMethod(['post', 'delete']);
        $savingAccount = $this->SavingAccounts->get($id);
        if ($this->SavingAccounts->delete($savingAccount)) {
            $this->Flash->success(__('La cuenta de ahorros ha sido borrada.'));
        } else {
            $this->Flash->error(__('La cuenta de ahorros no ha podido ser borrada. Inténtelo de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    public function transfer($association_name = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista


        $headquarters = $this->getHeadquarters(); //Pide todas las headquarter
        $tracts[0] = $this->getTracts(date('Y')-1);
        $tracts[1] = $this->getTracts(date('Y'));




        if($this->request->is("POST"))
        {
            if($association_name)
            {
                if($this->request->data['first_tract'] !== $this->request->data['second_tract'])
                {
                    $association_id = $this->getAssociationId($association_name);
                    $second_tract_id = $this->getTractId($this->request->data['second_tract']);

                    if($this->validateTract($this->SavingAccounts,$association_id,$second_tract_id) && ($this->request->data['first_tract'] != $this->request->data['second_tract']))
                    {

                        $first_tract_id = $this->getTractId($this->request->data['first_tract']);

                        $oldAccount = $this->getAccount($first_tract_id,$association_id);

                        $newAccount['amount'] = $oldAccount['amount'];
                        $newAccount['bank'] = $oldAccount['bank'];
                        $newAccount['account_owner'] = $oldAccount['account_owner'];
                        $newAccount['card_number'] = $oldAccount['card_number'];
                        $newAccount['association_id'] = $association_id;
                        $newAccount['tract_id'] = $second_tract_id;

                        if($this->createSavingAccount($newAccount))
                        {
                            die("Se transfirió la cuenta con éxito");
                        }
                        else
                        {
                            die("No se pudo transferir la cuenta. Intentelo más tarde");
                        }
                    }
                    else
                    {
                        die("No se pudo crear la cuenta. Probablemente las fechas son iguales o ya existe una cuenta asociada a esta fecha de tracto.");
                    }

                }
                else
                {
                    die("Las fechas deben ser distintas");
                }

            }
        }
        else
        {
            $this->set('head',$headquarters);
            $this->set('data', $tracts);
        }



      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    private function validateTract($entity, $association_id, $tract_id)
    {
        $emp = true;
        $query = $entity->find()
            ->hydrate(false)
            ->andWhere(['association_id'=>$association_id,'tract_id'=>$tract_id]);

        $query = $query->toArray();

        if(!empty($query))
        {
            $emp = false;
        }

        return $emp;
    }

    private function createSavingAccount($newAccount)
    {
      if($this->Auth->user()){
        $success = false;
        $savingAccount = $this->SavingAccounts->newEntity($newAccount);

        if ($this->SavingAccounts->save($savingAccount)) {
            $success = true;
        }

        return $success;
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    private function getAccount($tract_id,$association_id)
    {
      if($this->Auth->user()){
        $account = $this->SavingAccounts->find()
                        ->andWhere(['association_id'=>$association_id, 'tract_id'=>$tract_id]);

        $account = $account->toArray();

        return $account[0];
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    private function getHeadquarters()
    {
      if($this->Auth->user()){
        $query = $this->SavingAccounts->Associations->Headquarters->find() //Se trae solo las headquarter que tienen alguna asocicación asociada :p
        ->hydrate(false)
            ->select(['Headquarters.name'])
            ->join([
                'table'=>'associations',
                'alias'=>'a',
                'type' => 'RIGHT',
                'conditions'=>'Headquarters.id = a.headquarter_id',
            ])
            ->where(['a.enable'=>1])
            ->group(['Headquarters.name']); //Elimina repetidos


        $headquarters = $query->toArray();

        return $headquarters;
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }


    private function getTracts($year)
    {
      if($this->Auth->user()){
        $this->loadModel('Tracts');

        $tracts = $this->Tracts->find()
            ->hydrate(false)
            ->where(['YEAR(date)'=>$year]); //Queremos los tractos del año actual
        $tracts = $tracts->toArray();

        return $tracts;
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    /**
     *  Esta funcion devuelve el id del presente tracto
     **/
    private function getTractId($actualDate)
    {
      if($this->Auth->user()){
        $this->loadModel('Tracts');

        //$actualDate = date("Y-m-d");

        $id = $this->Tracts->find()
            ->hydrate(false)
            ->select(['id'])
            ->where(function ($exp) use($actualDate) {
                return $exp
                    ->lte('date',$actualDate)
                    ->gte('deadline',$actualDate);
            });

        $id = $id->toArray();

        return $id[0]['id'];
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    private function getAssociationId($association_name)
    {
      if($this->Auth->user()){
        $association_id = $this->SavingAccounts->Associations->find() //Se busca primero el id de esa sede por medio del nombre
        ->hydrate(false)
            ->select(['id'])
            ->where(['name'=>$association_name]);

        $association_id = $association_id->toArray();

        return $association_id[0]['id'];
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }


    public function isAuthorized($user)
    {

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'view'])) {
            $accountId = (int)$this->request->params['pass'][0];
        
            if ($this->SavingAccounts->isOwnedBy($accountId, $user['association_id'])) {
                return true;
            }
        }
    
        return parent::isAuthorized($user);
    }


}
