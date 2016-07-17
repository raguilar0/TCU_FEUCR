<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;
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
        $this->Auth->allow(['init', 'publicDetailedInformation', 'publicView', 'getAmounts']);
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
            try
            {
                $this->viewBuilder()->layout('admin_views');
                $association = $this->Associations->get($id, [
                    'contain' => ['Headquarters']
                ]);

                $this->set('association', $association);
                $this->set('_serialize', ['association']);
            }
            catch (RecordNotFoundException $e)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['action' => 'index']);
            }

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
            try
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
            catch (RecordNotFoundException $e)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['action' => 'index']);
            }


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

            try
            {
                $this->viewBuilder()->layout('admin_views');
                $this->request->allowMethod(['post', 'delete']);

                try
                {
                    $query = $this->Associations->query();
                    $query->update()
                        ->set(['enable' => 0])
                        ->where(['id' => $id])
                        ->execute();
                    $this->Flash->success(__('La asociación se deshabilitó exitosamente.'));
                }
                catch (Exception $e)
                {
                    $this->Flash->error(__('La asociación no pudo ser deshabilitada. Por favor intente de nuevo.'));
                }

                return $this->redirect(['action' => 'index']);
            }
            catch (RecordNotFoundException $e)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['action' => 'index']);
            }

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


        if($amount_type != 2)
        {
            $amount = $this->Associations->get($association_id, ['contain' => ['Boxes.Tracts'=> function ($q) use($id,$box_type){
                return $q->andWhere(['Tracts.id' => $id, 'Boxes.type'=>$box_type]);
            } ,'InitialAmounts.Tracts'=> function ($q) use($id){
                return $q->where(['Tracts.id' => $id]);
            }, 'Savings.Tracts'=> function ($q) use($id){
                return $q->andWhere(['Tracts.id' => $id, 'Savings.state'=>1]);
            }, 'SavingAccounts.Tracts'=> function ($q) use($id){
                return $q->where(['Tracts.id' => $id]);
            }, 'Amounts.Tracts'=> function ($q) use($id, $amount_type){
                return $q->andWhere(['Tracts.id' => $id, 'Amounts.type'=>$amount_type]);
            }, 'Invoices.Tracts'=> function ($q) use($id, $amount_type, $association_id,$invoice_type){
                return $q->andWhere(['Tracts.id' => $id, 'Invoices.kind' => $invoice_type, 'Invoices.state' => 1]);
            }]]);

            $amount = $amount->toArray();

            $invoices = $amount['invoices'];
            unset($amount['invoices']);
        }
        else
        {
            $amount = $this->Associations->Surpluses->find()
                ->hydrate(false)
                ->select(['amount'])
                ->andwhere(['association_id' => $association_id, 'YEAR(date)' => $id]);

            $invoices = $this->Associations->Invoices->find()
                ->hydrate(false)
                ->select(['date', 'number', 'detail', 'provider', 'amount', 'attendant', 'clarifications', 'legal_certificate'])
                ->andwhere(['association_id' => $association_id, 'kind' => $invoice_type, 'state' => 1, 'YEAR(date)'=> $id]); //En este caso el id viene con el año que deseo recuperar

            $amount = $amount->toArray();
            $invoices = $invoices->toArray();
        }



        $information['amount'] = $amount;



        $total_outgoings = 0;
        foreach ($invoices as $key => $value)
        {
            $total_outgoings = $total_outgoings+$value['amount'];
        }



        switch ($amount_type)
        {
            case 0:
                $information = $this->processTractData($information, $total_outgoings);
                break;
            case 1:
               $information = $this->processGeneratedData($information, $total_outgoings);
                break;
            case 2:
                $information = $this->processSurplusesData($information, $total_outgoings);
                break;
        }


            $data['amounts'] = $information;
            $data['invoices'] = $invoices;
            $data = json_encode($data);

           // debug($data);
           die($data);

    }

    private function processTractData($data, $total_outgoings)
    {

        $tract_amount = ((empty($data['amount']['amounts']))? 0: $data['amount']['amounts'][0]['amount']);//Si está vacío devuelve 0
        $saving_amount = ((empty($data['amount']['savings']))? 0: $data['amount']['savings'][0]['amount']); //Si está vacío devuelve 0
        $little_amount = ((empty($data['amount']['boxes']))? 0: $data['amount']['boxes'][0]['little_amount']);//Si está vacío devuelve 0
        $big_amount = ((empty($data['amount']['boxes']))? 0: $data['amount']['boxes'][0]['big_amount']);//Si está vacío devuelve 0
        $total_boxes = $little_amount + $big_amount; // Total de cajas
        $initial_amount = ((empty($data['amount']['initial_amounts']))? 0: $data['amount']['initial_amounts'][0]['amount']);

        $period_income = $tract_amount + $saving_amount;
        $total_income = $initial_amount + $period_income;
        $final_balance = $total_income - $total_outgoings;
        $negative_final_balance = (($final_balance < 0)? 1: 0);
        $account = $final_balance - $total_boxes;


        $information['period_income'] = "¢ ".number_format($period_income,2,",","."); //Ingresos del período: Es la suma de los montos de ahorro y los montos de ahorro
        $information['total_income'] = "¢ ".number_format($total_income, 2, ",","."); //Total de ingresos: Es la suma del saldo inicial de cajas e ingresos del período

        $information['total_outgoing'] = "¢ ".number_format($total_outgoings,2,",",".");;

        $information['final_balance'] = "¢ ".number_format($final_balance, 2, ",", "."); //Saldo final: Total de ingresos - total de gastos



        $information['tract_amount'] = "¢ ".number_format($tract_amount,2,",",".");
        $information['saving_amount'] = "¢ ".number_format($saving_amount,2,",",".");
        $information['little_amount'] = "¢ ".number_format($little_amount,2,",",".");
        $information['big_amount'] = "¢ ".number_format($big_amount,2,",",".");
        $information['total_boxes'] = "¢ ".number_format($total_boxes,2,",",".");
        $information['initial_amount'] = "¢ ".number_format($initial_amount,2,",",".");
        $information['account'] = "¢ ".number_format($account,2,",",".");
        $information['negative_final_balance'] = $negative_final_balance;



        return $information;


    }

    private function processGeneratedData($data, $total_outgoings)
    {
        $little_amount = ((empty($data['amount']['boxes']))? 0: $data['amount']['boxes'][0]['little_amount']);//Si está vacío devuelve 0
        $big_amount = ((empty($data['amount']['boxes']))? 0: $data['amount']['boxes'][0]['big_amount']);//Si está vacío devuelve 0
        $total_boxes = $little_amount + $big_amount; // Total de cajas
        $initial_amount = ((empty($data['amount']['initial_amounts']))? 0: $data['amount']['initial_amounts'][0]['amount']);
        $account = ((empty($data['amount']['saving_accounts']))? 0: $data['amount']['saving_accounts'][0]['amount']);

        $period_income = 0;

        foreach ($data['amount']['amounts'] as $key => $value) //Se obtiene el total de ingresos
        {
            $period_income = $period_income + $value['amount'];
        }

        $total_income = $initial_amount + $period_income;
        $final_balance = $total_income - $total_outgoings;
        $negative_final_balance = (($final_balance < 0)? 1: 0);


        $information['period_income'] = "¢ ".number_format($period_income,2,",",".");
        $information['amounts'] =  $data['amount']['amounts'];
        $information['little_amount'] = "¢ ".number_format($little_amount,2,",",".");
        $information['big_amount'] = "¢ ".number_format($big_amount,2,",",".");
        $information['total_income'] = "¢ ".number_format($total_income, 2, ",","."); //Total de ingresos: Es la suma del saldo inicial de cajas e ingresos del período
        $information['total_outgoing'] = "¢ ".number_format($total_outgoings,2,",",".");;
        $information['final_balance'] = "¢ ".number_format($final_balance, 2, ",", "."); //Saldo final: Total de ingresos - total de gastos
        $information['account'] = "¢ ".number_format($account,2,",",".");
        $information['total_boxes'] = "¢ ".number_format($total_boxes,2,",",".");
        $information['initial_amount'] = "¢ ".number_format($initial_amount,2,",",".");
        $information['negative_final_balance'] = $negative_final_balance;

        return $information;
    }

    private function processSurplusesData($data, $total_outgoings)
    {
        $total_income = 0;

        foreach ($data['amount'] as $key => $value)
        {
            $total_income = $total_income + $value['amount'];
        }

        $final_balance = $total_income - $total_outgoings;
        $negative_final_balance = (($final_balance < 0)? 1: 0);

        $information['amount'] = "¢ ".number_format($total_income,2,",",".");
        $information['total_outgoing'] = "¢ ".number_format($total_outgoings,2,",",".");
        $information['final_balance'] = "¢ ".number_format($final_balance,2,",",".");
        $information['negative_final_balance'] = $negative_final_balance;

        return $information;
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



    public function generalInformation() {
        if($this->Auth->user()){
            $this->viewBuilder()->layout('admin_views'); //Se deja este hasta mientras se haga el de representante

            $id = $this->request->session()->read('Auth.User.association_id');
            if($id) {




                if($this->request->is(array('post','put')))
                {

                    try
                    {
                        $query = $this->Associations->query();

                        $query->update()
                            ->set(['schedule'=> $this->request->data['schedule']])
                            ->where(['id'=> $id])
                            ->execute();

                        $this->Flash->success(__('Se actualizó la asociación exitosamente'));

                    }
                    catch(Exception $e)
                    {
                        $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                        return $this->redirect(['action' => 'init']);
                    }


                }

                try
                {
                    $association = $this->Associations->get($id);

                    $head = $this->Associations->Headquarters->find()
                        ->hydrate(false)
                        ->select(['id','name'])
                        ->where(['id'=>$association->headquarter_id]);

                    $head = $head->toArray();

                    $association['headquarter'] = $head[0]['name'];

                    $this->set('data',$association); // set() Pasa la variable association a la vista.
                }
                catch (RecordNotFoundException $e)
                {
                    $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                    return $this->redirect(['action' => 'init']);
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
                                    ->andWhere(['headquarter_id'=>$id, 'enable'=>1]);

            $this->set('data', $associations);
        }
    }


    public function publicDetailedInformation($id = null, $year = null)
    {

        if($id)
        {

            $association_name = $this->Associations->find()
                ->hydrate(false)
                ->select(['name','id','enable'])
                ->where(['id'=>$id]);

            $association_name = $association_name->toArray();

            if(isset($association_name[0]) && !$association_name[0]['enable'])
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['controller'=>'pages','action' => 'home']);
            }


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
