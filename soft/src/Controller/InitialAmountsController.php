<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

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

          try
          {
              $this->viewBuilder()->layout('admin_views');
              $initialAmount = $this->InitialAmounts->get($id, [
                  'contain' => ['Associations', 'Tracts']
              ]);

              $this->set('initialAmount', $initialAmount);
              $this->set('_serialize', ['initialAmount']);
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
     * Edit method
     *
     * @param string|null $id Initial Amount id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if($this->Auth->user()){
          try
          {
              $this->viewBuilder()->layout('admin_views');
              $initialAmount = $this->InitialAmounts->get($id, [
                  'contain' => []
              ]);
          }
          catch (RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }




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

          try
          {
              $this->viewBuilder()->layout('admin_views');
              $this->request->allowMethod(['post', 'delete']);
              $initialAmount = $this->InitialAmounts->get($id);

              try
              {
                  if ($this->InitialAmounts->delete($initialAmount)) {
                      $this->Flash->success(__('El monto inicial no ha sido borrado.'));
                  } else {
                      $this->Flash->error(__('El monto inicial no ha podido ser borrado. Intentelo de nuevo'));
                  }
                  return $this->redirect(['action' => 'index']);
              }
              catch (\PDOException $e)
              {
                  $this->Flash->error(__('No se pudo borrar el monto inicial. Esto puede deberse a que hay información asociada en la base de datos. Borre cualquier información asociada a este monto inicial y luego intente de nuevo.'));
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

    public function add($association_id = null)
    {

        $this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

        $tracts = $this->getAvailableTracts($association_id); //Nos devuelve los tractos que todavía no tiene montos iniciales asociados

        if($this->request->is("POST"))
        {
            $data = $this->request->data;

            if($data['from'] !== $data['to'])
            {
                $association_id = $data['association_id'];

                if($data['tract_box'] == '1') //Si el usuario marcó la casilla del checkbox de cajas de tracto
                {
                    $oldBox = $this->getBox($association_id, $data['from'], 0); //Queremos la caja vieja del tracto

                    if(isset($oldBox[0]))
                    {
                        $values['amount'] = ($oldBox[0]['big_amount'] + $oldBox[0]['little_amount']);
                        $values['type'] = 0;
                        $values['association_id'] = $association_id;
                        $values['tract_id'] = $data['to'];

                        $initial_amount = $this->InitialAmounts->newEntity($values);

                        if($this->InitialAmounts->save($initial_amount))
                        {
                            $this->Flash->success(__('Se creó el monto inicial para los montos de tracto, con éxito.'));

                            if($this->transferBox($data,$oldBox,0))
                            {
                                $this->Flash->success(__('Se transfirió el monto de la caja de tracto correspondiente a la fecha que eligió, con éxito.'));
                            }
                            else
                            {
                                $this->Flash->error('No se pudo hacer la transferencia de cajas.Verifique los datos que está ingresando e intente de nuevo.');
                            }

                        }
                        else
                        {
                            $this->Flash->error('No se pudo crear el monto inicial por lo que tampoco se intentó hacer la transferencia de cajas. Verifique los datos que está ingresando e intente de nuevo.');
                        }
                    }
                    else
                    {
                        $this->Flash->error('No existe una caja de tracto que pertenezca a esta asociación de la cuál hacer dicha transferencia. Verifique que hayan cajas de tracto creadas asociadas a dicha fecha e intente de nuevo.');
                    }


                }

                if($data['generated_box'] == '1') //Si el usuario marcó la casilla de
                {
                    $oldBox = $this->getBox($association_id, $data['from'], 1); //Queremos la caja vieja del tracto

                    if(isset($oldBox[0]))
                    {
                        $values['amount'] = ($oldBox[0]['big_amount'] + $oldBox[0]['little_amount']);
                        $values['type'] = 1;
                        $values['association_id'] = $association_id;
                        $values['tract_id'] = $data['to'];

                        $initial_amount = $this->InitialAmounts->newEntity($values);

                        if($this->InitialAmounts->save($initial_amount))
                        {
                            $this->Flash->success(__('Se creó el monto inicial para los montos de ingresos generados, con éxito.'));

                            if($this->transferBox($data,$oldBox,1))
                            {
                                $this->Flash->success(__('Se transfirió el monto de la caja de ingresos generados correspondiente a la fecha que eligió, con éxito.'));
                            }
                            else
                            {
                                $this->Flash->error('No se pudo hacer la transferencia de cajas.Verifique los datos que está ingresando e intente de nuevo.');
                            }

                        }
                        else
                        {
                            $this->Flash->error('No se pudo crear el monto inicial por lo que tampoco se intentó hacer la transferencia de cajas. Verifique los datos que está ingresando e intente de nuevo.');
                        }
                    }
                    else
                    {
                        $this->Flash->error('No existe una caja de ingresos generados que pertenezca a esta asociación de la cuál hacer dicha transferencia. Verifique que hayan cajas de ingresos generados asociadas a dicha fecha e intente de nuevo.');
                    }
                }
            }
            else
            {
                $this->Flash->error('La fechas de tracto deben ser distintas. Verifique los datos que está ingresando e intente de nuevo.');
            }

        }


        $temp = array();
        foreach ($tracts as $key => $value)
        {
            $temp[$value['id']] = $value['date']->format('d-m-Y')." - ".$value['deadline']->format('d-m-Y');
        }

        $destination = $temp;

        $tracts = $this->InitialAmounts->Tracts->find()
            ->select(['id','date','deadline'])
            ->where(['YEAR(date)'=>date('Y')])
            ->orWhere(['YEAR(date)'=>(date('Y') + 1)]);
        $temp = array();

        foreach ($tracts as $key => $value)
        {
            $temp[$value->id] = $value->date->format('d-m-Y')." - ".$value->deadline->format('d-m-Y');
        }

        $from_tracts = $temp;


        $associations = $this->InitialAmounts->Associations->find('list');

        $this->set(compact('from_tracts','destination', 'associations'));
    }


    private function getAvailableTracts($association_id)
    {
        $not_available = $this->InitialAmounts->find()
            ->hydrate(false)
            ->select(['tract.id'])
            ->join([
                'table'=>'tracts',
                'alias'=>'tract',
                'type'=>'inner',
                'conditions'=>'InitialAmounts.tract_id = tract.id'

            ])
            ->where(['InitialAmounts.association_id'=>$association_id, 'OR'=>[['YEAR(tract.date)'=>date('Y')],['YEAR(tract.date)'=>(date('Y')+1)]]]);

            $tracts = $this->InitialAmounts->Tracts->find()
            ->hydrate(false)
            ->select(['id','date', 'deadline', 'number'])
            ->where(function ($exp,$q)use($not_available){return $exp->notIn('id',$not_available);});

        return $tracts;
    }


    private function transferBox($data,$oldBox, $type)
    {
        $association_id = $data['association_id'];
        $second_tract_id = $data['to'];
        $success = true;
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
            $success = false;
        }
        return $success;

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





}
