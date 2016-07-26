<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
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
              'contain' => ['Associations'=>function($q){
                  return $q->where(['enable'=>1]);
              }, 'Tracts']
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
          try
          {
              $this->viewBuilder()->layout('admin_views');
              $savingAccount = $this->SavingAccounts->get($id, [
                  'contain' => ['Associations', 'Tracts']
              ]);

              $this->set('savingAccount', $savingAccount);
              $this->set('_serialize', ['savingAccount']);
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
        $associations = $this->SavingAccounts->Associations->find('list')
                                                ->where(['enable'=>1]);

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

          try
          {
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
              $associations = $this->SavingAccounts->Associations->find('list')
                                                ->where(['enable'=>1]);
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
     * @param string|null $id Saving Account id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      if($this->Auth->user() && ($this->request->session()->read('Auth.User.role') == 'admin') ){

          try
          {
              $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
              $this->request->allowMethod(['post', 'delete']);
              $savingAccount = $this->SavingAccounts->get($id);

              try
              {
                  if ($this->SavingAccounts->delete($savingAccount)) {
                      $this->Flash->success(__('La cuenta de ahorros ha sido borrada.'));
                  } else {
                      $this->Flash->error(__('La cuenta de ahorros no ha podido ser borrada. Inténtelo de nuevo.'));
                  }
                  return $this->redirect(['action' => 'index']);
              }
              catch (\PDOException $e)
              {
                  $this->Flash->error(__('Error al borrar la cuenta. Esto puede deberse a que existe información asociada en la base de datos. Debe borrar cualquier información y luego borrar la cuenta.'));
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

    public function transfer($association_id = null)
    {

        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

        $destination = $this->getAvailableTracts($association_id); //Nos devuelve los tractos que todavía no tiene montos iniciales asociados
        $from_tracts = $this->getTracts($association_id);

        if($this->request->is("POST"))
        {
            $data = $this->request->data;
            $association_id = $data['association_id'];

            if($data['from'] !== $data['to'])
            {
                $oldAccount = $this->getAccount($data['from'],$association_id);

                $newAccount['amount'] = $oldAccount['amount'];
                $newAccount['bank'] = $oldAccount['bank'];
                $newAccount['account_owner'] = $oldAccount['account_owner'];
                $newAccount['card_number'] = $oldAccount['card_number'];
                $newAccount['association_id'] = $association_id;
                $newAccount['tract_id'] = $data['to'];

                $entity = $this->SavingAccounts->newEntity($newAccount);

                if($this->SavingAccounts->save($entity))
                {
                    $this->Flash->success(__('Se transfirió la cuenta con éxito'));
                    return $this->redirect(['action'=>'transfer',$association_id]);
                }
                else
                {
                    $this->Flash->error(__('No se pudo crear la nueva cuenta. Verifique los datos e intentelo más tarde.'));
                }

            }
            else
            {
                $this->Flash->error(__('Las fechas deben ser distintas'));
            }

        }


        $temp = array();
        foreach ($destination as $key => $value)
        {
            $temp[$value['id']] = $value['date']->format('d-m-Y')." - ".$value['deadline']->format('d-m-Y');
        }

        $destination = $temp;


        $temp = array();
        foreach ($from_tracts as $key => $value)
        {
            $temp[$value['tract']['id']] = date_format(date_create($value['tract']['date']),'d-m-Y')." - ".date_format(date_create($value['tract']['deadline']), 'd-m-Y');
        }

        $from_tracts = $temp;


        $associations = $this->SavingAccounts->Associations->find('list')
                                            ->where(['enable'=>1]);

        $this->set(compact('from_tracts','destination', 'associations'));


    }

    private function getAvailableTracts($association_id)
    {


        $not_available = $this->SavingAccounts->find()
            ->hydrate(false)
            ->select(['tract.id'])
            ->join([
                'table'=>'tracts',
                'alias'=>'tract',
                'type'=>'inner',
                'conditions'=>'SavingAccounts.tract_id = tract.id'

            ])
            ->where(['SavingAccounts.association_id'=>$association_id, 'OR'=>[['YEAR(tract.date)'=>date('Y')],['YEAR(tract.date)'=>(date('Y')+1)]]]);


        $tracts = $this->SavingAccounts->Tracts->find()
            ->hydrate(false)
            ->select(['id','date', 'deadline', 'number'])
            ->where(function ($exp,$q)use($not_available){return $exp->notIn('id',$not_available);});



        return $tracts->toArray();
    }

    private function getTracts($association_id)
    {
        $tracts = $this->SavingAccounts->find()
            ->hydrate(false)
            ->select(['tract.id', 'tract.date', 'tract.deadline'])
            ->join([
                'table'=>'tracts',
                'alias'=>'tract',
                'type'=>'inner',
                'conditions'=>'SavingAccounts.tract_id = tract.id'

            ])
            ->where(['SavingAccounts.association_id'=>$association_id, 'OR'=>[['YEAR(tract.date)'=>date('Y')],['YEAR(tract.date)'=>(date('Y')+1)]]]);

        return $tracts->toArray();
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

    /**
     *  Esta funcion devuelve el id del tracto correspondiente a la fecha enviada
     **/
    private function getTractId($actualDate)
    {
        $this->loadModel('Tracts');


        $id = $this->Tracts->find()
            ->hydrate(false)
            ->select(['id'])
            ->where(function ($exp) use($actualDate) {
                return $exp
                    ->lte('date',$actualDate) //<= date <= fecha actual
                    ->gte('deadline',$actualDate); //deadline >= fecha actual
            });

        $id = $id->toArray();

        return (isset($id[0])? $id[0]['id']: null);
    }


    public function isAuthorized($user)
    {

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'view'])) {
            $accountId = (int)$this->request->params['pass'][0];
            $actualDate = date("Y-m-d");
            $tract_id = $this->getTractId($actualDate);
            if ($this->SavingAccounts->isOwnedBy($accountId, $user['association_id'], $tract_id)) {
                return true;
            }
        }
    
        return parent::isAuthorized($user);
    }


}
