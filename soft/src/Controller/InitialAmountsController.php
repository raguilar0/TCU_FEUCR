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
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $this->paginate = [
            'contain' => ['Associations', 'Tracts']
        ];
        $initialAmounts = $this->paginate($this->InitialAmounts);

        $this->set(compact('initialAmounts'));
        $this->set('_serialize', ['initialAmounts']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
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
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $initialAmount = $this->InitialAmounts->get($id, [
            'contain' => ['Associations', 'Tracts']
        ]);

        $this->set('initialAmount', $initialAmount);
        $this->set('_serialize', ['initialAmount']);
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
    /**
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
**/
    /**
     * Edit method
     *
     * @param string|null $id Initial Amount id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $initialAmount = $this->InitialAmounts->get($id, [
            'contain' => []
        ]);



        if ($this->request->is(['patch', 'post', 'put'])) {

            $initialAmount = $this->InitialAmounts->patchEntity($initialAmount, $this->request->data);
            if ($this->InitialAmounts->save($initialAmount)) {
                $this->Flash->success(__('El monto inicial ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El monto inicial no ha podido ser guardado. Intentelo de nuevo'));
            }

        }
        
        $types = array(1 => 'Ingresos Generados', 0 => 'Tracto');

        if(!$initialAmount->type) //Cambiamos el contenido para hacer la interfaz más amena
        {
            $types = array(0 => 'Tracto', 1 => 'Ingresos Generados');
        }


        $initialAmount->type = $types;
        $associations = $this->InitialAmounts->Associations->find('list');

        $tracts = $this->InitialAmounts->Tracts->find()
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

        $this->set(compact('initialAmount', 'associations', 'tracts'));
        $this->set('_serialize', ['initialAmount']);
    }
    else{
      return $this->redirect(['controller'=>'pages', 'action'=>'home']);
    }
  }

    public function delete($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $this->request->allowMethod(['post', 'delete']);
        $initialAmount = $this->InitialAmounts->get($id);
        if ($this->InitialAmounts->delete($initialAmount)) {
            $this->Flash->success(__('El monto inicial no ha sido guardado.'));
        } else {
            $this->Flash->error(__('El monto inicial no ha podido ser guardado. Intentelo de nuevo'));
        }
        return $this->redirect(['action' => 'index']);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    public function add($association_name = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista


        $headquarters = $this->getHeadquarters(); //Pide todas las sedes
        $tracts[0] = $this->getTracts(date('Y')-1);
        $tracts[1] = $this->getTracts(date('Y'));

        $amounts_type = array('Tracto'=> 0, 'Ingresos Generados' => 1);

        if($this->request->is("POST"))
        {
            if($association_name)
            {
                /**
                 * 1- Cargar los montos de las cajas del tracto del primer select al tracto del segundo select, esto tanto
                 * para tracto como para ingresos generados. Este monto se carga no solo al monto inicial de la asocia, si no
                 * tambien en las cajas de dicha asocia en los campos correspondientes, es decir los montos de caja chica van
                 * para los montos de la caja chica del siguiente tracto, lo mismo con las cajas fuertes.
                 *
                 * 2- Crear las cajas. Para poder mover los montos, se deben primero crear las cajas, esto tanto para Ingresos Generados
                 * como para Tracto.
                 */




                if($this->request->data['first_tract'] != $this->request->data['second_tract'])
                {
                    $message = "";
                    
                    $association_id = $this->getAssociationId($association_name);
                    $first_tract_id = $this->getTractId($this->request->data['first_tract']);
                    $second_tract_id = $this->getTractId($this->request->data['second_tract']);


                    if($this->request->data['tract_box'] == '1') //Si el usuario marcó la casilla del checkbox de cajas de tracto
                    {
                        $oldBoxTract = $this->getBox($association_id, $first_tract_id, 0); //Queremos la caja vieja del tracto
                        $message = $this->transferBox($oldBoxTract, $association_id, $second_tract_id, 0); //Creamos Tractos
                        $message .= "<br>".$this->createInitialAmount( $oldBoxTract, $association_id, $second_tract_id, 0); //Creamos los montos iniciales de tracto

                    }

                    if($this->request->data['generated_box'] == '1') //Si el usuario marcó la casilla de
                    {
                        $oldBoxGenerated = $this->getBox($association_id, $first_tract_id, 1); //Queremos la caja vieja de ingresos generados
                        $message .= "<br>".$this->transferBox($oldBoxGenerated,$association_id, $second_tract_id, 1); //Creamos ingresos  generados
                        $message .= "<br>".$this->createInitialAmount( $oldBoxGenerated, $association_id, $second_tract_id, 1); //Creamos los montos iniciales de Ingresos Generados

                    }


                    die($message);


                }
                else
                {
                    die('Las fechas deben ser distintas');
                }

            }
        }

        $this->set('head',$headquarters);
        $this->set('data', $tracts);
        $this->set('type', $amounts_type);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    private function createInitialAmount( $oldBox, $association_id, $tract_id, $type)
    {
      if($this->Auth->user()){
        $type_name = ($type == 0 ? "Tracto":"Ingresos Generados");


        $array['amount'] = ($oldBox[0]['little_amount'] + $oldBox[0]['big_amount']);
        $array['type'] = $type;
        $array['association_id'] = $association_id;
        $array['tract_id'] = $tract_id;

        $message = "";

        try
        {
            $initial = $this->InitialAmounts->newEntity($array);

            if($this->InitialAmounts->save($initial))
            {
                $message = "Se guardó el monto inicial correspondiente a ".$type_name." con éxito";
            }

        }
        catch(Exception $e)
        {
            $message = "No se pudo guardar el monto inicial correspondiente a ".$type_name. " esto debido a un error interno";
        }



        return $message;
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    private function transferBox($oldBox,$association_id, $second_tract_id, $type)
    {

      if($this->Auth->user()){
        $type_name = ($type == 0 ? "Tracto":"Ingresos Generados");
        $message = "Se creó la caja para ".$type_name;

        try
        {
            $this->loadModel('Boxes');

            $box = $this->Boxes->query();
            $box->update()
                ->set(['little_amount'=>$oldBox[0]['little_amount'], 'big_amount'=>$oldBox[0]['big_amount']])
                ->andwhere(['association_id'=>$association_id, 'tract_id'=>$second_tract_id, 'type'=>$type])
                ->execute();

        }
        catch(Exception $e)
        {
            $message = 'No se pudo crear la caja '.$type_name .' ya que se dio un error inesperado.';
        }
        return $message;
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    private function getBox($association_id, $tract_id, $type)
    {
      if($this->Auth->user()){
        $this->loadModel('Boxes');

        $box = $this->Boxes->find()
            ->hydrate(false)
            ->andwhere(['association_id'=>$association_id, 'tract_id'=>$tract_id, 'type'=>$type]);

        $box = $box->toArray();

        return $box;
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    private function getAssociationId($association_name)
    {
      if($this->Auth->user()){
        $association_id = $this->InitialAmounts->Associations->find() //Se busca primero el id de esa sede por medio del nombre
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

    private function getHeadquarters()
    {
      if($this->Auth->user()){
        $query = $this->InitialAmounts->Associations->Headquarters->find() //Se trae solo las sedes que tienen alguna asocicación asociada :p
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


}
