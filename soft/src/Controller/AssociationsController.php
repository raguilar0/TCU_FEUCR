<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Associations Controller
 *
 * @property \App\Model\Table\AssociationsTable $Associations
 */
class AssociationsController extends AppController
{

      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['init', 'publicDetailedInformation', 'publicView']);
    }

    public function init()
    {
        $this->viewBuilder()->layout('admin_views');
    }

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
            $this->paginate = [
                'contain' => ['Headquarters']
            ];
            $associations = $this->paginate($this->Associations);

            $this->set(compact('associations'));
            $this->set('_serialize', ['associations']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }

    }

    /**
     * View method
     *
     * @param string|null $id Association id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $association = $this->Associations->get($id, [
                'contain' => ['Headquarters', 'Amounts', 'Boxes', 'InitialAmounts', 'Invoices', 'SavingAccounts', 'Savings', 'Surpluses', 'Users', 'Warehouses']
            ]);

            $this->set('association', $association);
            $this->set('_serialize', ['association']);
        }
        else
        {
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
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $association = $this->Associations->newEntity();
            if ($this->request->is('post')) {
                $association = $this->Associations->patchEntity($association, $this->request->data);
                if ($this->Associations->save($association)) {
                    $this->Flash->success(__('La asociación se guardó exitosamente'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('La asociación no pudo ser guardada. Por favor intente de nuevo.'));
                }
            }


            $association->authorized_card = array(1 => 'Aprobada', 0 => 'Reprobada');


            $headquarters = $this->Associations->Headquarters->find('list');
            $this->set(compact('association', 'headquarters'));
            $this->set('_serialize', ['association']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


    }

    /**
     * Edit method
     *
     * @param string|null $id Association id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->Auth->user())
        {
            $this->viewBuilder()->layout('admin_views');
            $association = $this->Associations->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $association = $this->Associations->patchEntity($association, $this->request->data);
                if ($this->Associations->save($association)) {
                    $this->Flash->success(__('La asociación se guardó exitosamente.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('La asociación no pudo ser guardada. Por favor intente de nuevo.'));
                }
            }
            $authorized = array(1 => 'Aprobada', 0 => 'Reprobada');

            if(!$association->authorized_card) //Cambiamos el contenido para hacer la interfaz más amena
            {
                $authorized = array(0 => 'Reprobada', 1 => 'Aprobada');
            }

            $state = array(1 => 'Habilitada', 0 => 'Deshabilitada');
            if(!$association->enable) //Cambiamos el contenido para hacer la interfaz más amena
            {
                $state = array(0 => 'Deshabilitada', 1 => 'Habilitada');
            }

            $association->authorized_card = $authorized;
            $association->enable = $state;
            $headquarters = $this->Associations->Headquarters->find('list');
            $this->set(compact('association', 'headquarters'));
            $this->set('_serialize', ['association']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


    }



    /**
     * Delete method
     *
     * @param string|null $id Association id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if ($this->Auth->user()) {
            $this->viewBuilder()->layout('admin_views');
            $this->request->allowMethod(['post', 'delete']);
            $association = $this->Associations->get($id);
            if ($this->Associations->delete($association)) {
                $this->Flash->success(__('La asociación se eliminó exitosamente.'));
            } else {
                $this->Flash->error(__('La asociación no pudo ser eliminada. Por favor intente de nuevo.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }

    }

    public function detailedInformation($id = null, $year = null)
    {

            $this->viewBuilder()->layout('admin_views');

            if($this->request->session()->read('Auth.User.role') != 'admin') //Si no es admin, es rep y se le asigna el id de la asocia a la que pertenece
            {
                $id = $this->request->session()->read('Auth.User.association_id');
            }



            if($id)
            {

                $year = ($year ? $year: date('Y')); //Si el año viene nulo, agregamos el actual

                $tract_dates = $this->Associations->Amounts->find()
                    ->hydrate(false)
                    ->select(['tract.date','tract.deadline','type','tract.number', 'tract.id'])
                    ->andwhere(['association_id'=>$id, 'YEAR(tract.date)'=>$year])
                    ->join([
                        'table'=>'tracts',
                        'alias'=>'tract',
                        'type'=>'RIGHT',
                        'conditions'=>'Amounts.tract_id = tract.id'

                    ])

                    ->group(['tract.date']);


                $tract_dates = $tract_dates->toArray();
                $temp = array();
                foreach ($tract_dates as $key => $value)
                {
                    $temp[$value['tract']['id']] = $value['tract']['date']." - ".$value['tract']['deadline'];
                }

                $tract_dates = $temp;


                $this->loadModel('Tracts'); //Obtenemos todos los años que existen

                $tracts_year = $this->Tracts->find()
                    ->hydrate(false)
                    ->select(['year'=>'YEAR(date)'])
                    ->order(['(year'=>" = '".$year."') DESC, year"]) //NO LO INTENTEN EN SUS CASAS!!! XD
                    ->group(['year']);

                $tracts_year = $tracts_year->toArray();


                $association_name = $this->Associations->find()
                    ->hydrate(false)
                    ->select(['name','id'])
                    ->where(['id'=>$id]);

                $association_name = $association_name->toArray();


                $this->set('dates',$tract_dates);
                $this->set('association_name',$association_name);
                $this->set('years',$tracts_year);


            }
            else
            {
                $this->redirect(['action'=>'/']);
            }

    }



    public function getAmounts($association_id = null, $amount_type = null, $box_type = null,$invoice_type = null, $id = null)
    {
        if ($this->Auth->user()) {

            if ($amount_type != 2) //Si no es superávit
            {

                $amount = $this->Associations->Amounts->find()
                    ->hydrate(false)
                    ->select(['tract.number', 'amount', 'tract.deadline', 'date', 'detail'])
                    ->andwhere(['association_id' => $association_id, 'type' => $amount_type])
                    ->join([
                        'table' => 'tracts',
                        'alias' => 'tract',
                        'type' => 'RIGHT',
                        'conditions' => 'Amounts.tract_id = tract.id and tract.id = ' . $id

                    ]);

                $amount = $amount->toArray();


                $box = $this->Associations->Boxes->find()
                    ->hydrate(false)
                    ->select(['little_amount', 'big_amount'])
                    ->andwhere(['association_id' => $association_id, 'type' => $box_type])
                    ->join([
                        'table' => 'tracts',
                        'alias' => 'tract',
                        'type' => 'RIGHT',
                        'conditions' => 'Boxes.tract_id = tract.id and tract.id = ' . $id

                    ]);

                $box = $box->toArray();


                $initial_amount = $this->Associations->InitialAmounts->find()
                    ->hydrate(false)
                    ->select(['amount'])
                    ->andwhere(['association_id' => $association_id, 'type' => $amount_type])
                    ->join([
                        'table' => 'tracts',
                        'alias' => 'tract',
                        'type' => 'RIGHT',
                        'conditions' => 'InitialAmounts.tract_id = tract.id and tract.id = '. $id

                    ]);

                $initial_amount = $initial_amount->toArray();


                $information['boxes'] = $box;
                $information['initial_amount'] = $initial_amount;

                if ($amount_type == 0) //Si es tracto se consulta además por los montos de ahorro
                {
                    $saving_amount = $this->Associations->Savings->find()
                        ->hydrate(false)
                        ->select(['amount'])
                        ->andwhere(['association_id' => $association_id, 'state' => 1])
                        ->join([
                            'table' => 'tracts',
                            'alias' => 'tract',
                            'type' => 'RIGHT',
                            'conditions' => 'Savings.tract_id = tract.id and tract.id = ' . $id

                        ]);

                    $saving_amount = $saving_amount->toArray();
                    $information['savings'] = $saving_amount;
                }

                if ($amount_type == 1) //Si es ingresos generados además se consulta cuentas de ahorro
                {
                    $saving_account = $this->Associations->SavingAccounts->find()
                        ->hydrate(false)
                        ->select(['amount'])
                        ->where(['association_id' => $association_id])
                        ->join([
                            'table' => 'tracts',
                            'alias' => 'tract',
                            'type' => 'RIGHT',
                            'conditions' => 'SavingAccounts.tract_id = tract.id and tract.id = ' . $id

                        ]);

                    $saving_account = $saving_account->toArray();
                    $information['saving_account'] = $saving_account;
                }

            } else {


                $amount = $this->Associations->Surpluses->find()
                    ->hydrate(false)
                    ->select(['amount'])
                    ->andwhere(['association_id' => $association_id, 'YEAR(date)' => $id]);


                $amount = $amount->toArray();
            }


            $invoices = $this->Associations->Invoices->find()
                ->hydrate(false)
                ->select(['date', 'number', 'detail', 'provider', 'amount', 'attendant', 'clarifications', 'legal_certificate'])
                ->andwhere(['association_id' => $association_id, 'kind' => $invoice_type, 'state' => 1])
                ->join([
                    'table' => 'tracts',
                    'alias' => 'tract',
                    'type' => 'RIGHT',
                    'conditions' => 'Invoices.tract_id = tract.id and tract.id = ' . $id

                ]);

            $invoices = $invoices->toArray();


//
            $information['amount'] = $amount;

            $information['invoices'] = $invoices;


            $information = json_encode($information);


            die($information);
        } else {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }
    }



        public function showAssociations($id = null)
    {
        if($this->Auth->user()){
            if($id)
            {
                $this->viewBuilder()->layout('admin_views');


                $query = $this->Associations->Headquarters->find()
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
                        $query['link'] = 'view';
                        break;

                    case 3:
                        $query['link'] = 'modify';
                        break;

                    case 4:
                        $query['link'] = 'delete';
                        break;

                    case 5:
                        $query['link'] = 'detailed_information';
                        break;
                }

                $this->set('data',$query);

            }
            else
            {
                $this->redirect(['action'=>'/']);
            }
        }
        else{
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }



    }

    public function indexAssociations()
    {
        if($this->Auth->user()){
            $this->viewBuilder()->layout('admin_views');
        }
        else{
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }
    }

    public function generalInformation($id = null) {
        if($this->Auth->user()){
            $this->viewBuilder()->layout('admin_views'); //Se deja este hasta mientras se haga el de representante

            $id = $this->request->session()->read('Auth.User.association_id');
            if($id) {
                $association = $this->Associations->get($id);

                $head = $this->Associations->Headquarters->find()
                    ->hydrate(false)
                    ->select(['id','name'])
                    ->where(['id'=>$association->headquarter_id]);

                $head = $head->toArray();

                $association['headquarter'] = $head[0]['name'];



                if($this->request->is(array('post','put')))
                {
                    $response = '0';

                    try
                    {
                        $query = $this->Associations->query();

                        $query->update()
                            ->set(['schedule'=> $this->request->data['schedule']])
                            ->where(['id'=> $id])
                            ->execute();

                        $response = '1';
                    }
                    catch(Exception $e)
                    {

                    }

                    die($response);

                }
                else
                {
                    $this->set('data',$association); // set() Pasa la variable association a la vista.
                }
            }
            else
            {
                $this->redirect(['action'=>'/']);
            }

        }
        else{
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }
    }


    public function publicView($id = null)
    {
        if($id)
        {
            $associations = $this->Associations->find()
                                    ->hydrate(false)
                                    ->where(['headquarter_id'=>$id]);

            $this->set('data', $associations);
        }
    }


    public function publicDetailedInformation($id = null, $year = null)
    {


        if($id)
        {

            $year = ($year ? $year: date('Y')); //Si el año viene nulo, agregamos el actual

            $tract_dates = $this->Associations->Amounts->find()
                ->hydrate(false)
                ->select(['tract.date','tract.deadline','type','tract.number', 'tract.id'])
                ->andwhere(['association_id'=>$id, 'YEAR(tract.date)'=>$year])
                ->join([
                    'table'=>'tracts',
                    'alias'=>'tract',
                    'type'=>'RIGHT',
                    'conditions'=>'Amounts.tract_id = tract.id'

                ])

                ->group(['tract.date']);


            $tract_dates = $tract_dates->toArray();
            $temp = array();
            foreach ($tract_dates as $key => $value)
            {
                $temp[$value['tract']['id']] = $value['tract']['date']." - ".$value['tract']['deadline'];
            }

            $tract_dates = $temp;


            $this->loadModel('Tracts'); //Obtenemos todos los años que existen

            $tracts_year = $this->Tracts->find()
                ->hydrate(false)
                ->select(['year'=>'YEAR(date)'])
                ->order(['(year'=>" = '".$year."') DESC, year"]) //NO LO INTENTEN EN SUS CASAS!!! XD
                ->group(['year']);

            $tracts_year = $tracts_year->toArray();


            $association_name = $this->Associations->find()
                ->hydrate(false)
                ->select(['name','id'])
                ->where(['id'=>$id]);

            $association_name = $association_name->toArray();


            $this->set('dates',$tract_dates);
            $this->set('association_name',$association_name);
            $this->set('years',$tracts_year);


        }
        else
        {
            $this->redirect(['action'=>'/']);
        }

    }


    public function isAuthorized($user)
    {

        if(in_array($this->request->action,['generalInformation', 'detailedInformation', 'getAmounts']))
        {
            return true;
        }


    
        return parent::isAuthorized($user);
    }


}
