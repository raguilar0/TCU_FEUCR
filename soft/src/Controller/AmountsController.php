<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;

class AmountsController extends AppController
{

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->viewBuilder()->layout('admin_views');
		$query = $this->Amounts;
		
		if(($this->request->session()->read('Auth.User.role')) == 'rep'){
			$actualDate = date("Y-m-d");
			$tract_id = $this->getTractId($actualDate) ;
			$association_id = $this->request->session()->read('Auth.User.association_id');
			
			$this->paginate = [
				'contain' => ['Associations',
							'Tracts' => function ($q) use($tract_id) {
							 return $q->where(['Tracts.id' => $tract_id]);
							 }]
			];
			
			$query = $this->Amounts->find()
						->andWhere(['association_id'=>$association_id, 'type'=>1]);
		
		}
		elseif(($this->request->session()->read('Auth.User.role')) == 'admin')
		{
		
			$this->paginate = [
				'contain' => ['Associations', 'Tracts']
			];			
		}
		


		$amounts = $this->paginate($query);

		$this->set(compact('amounts'));
		$this->set('_serialize', ['amounts']);

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
		try
		{
			$this->viewBuilder()->layout('admin_views');
			$amounts = $this->Amounts->get($id, [
				'contain' => ['Associations', 'Tracts']
			]);
			$this->set('amount', $amounts);
			$this->set('_serialize', ['amount']);
		}
		catch (RecordNotFoundException $e)
		{
			$this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
			return $this->redirect(['action' => 'index']);
		}




	}

	public function addAmounts()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

			$tract = $this->getTractId(date('Y-m-d'));
			$amount = $this->Amounts->newEntity();

			if($this->request->is('POST'))
			{
				$association_id = $this->request->session()->read('Auth.User.association_id');
				$type = 1;
				$data = $this->request->data;


				$data['tract_id'] = $tract;
				$data['association_id'] = $association_id;
				$data['type'] = $type;

				$entity = $this->Amounts->patchEntity($amount,$data);


				//	$entity =  $this->Amounts->newEntity($data);

					if($this->Amounts->save($entity))
					{
						$this->Flash->success('Se agregaron los montos exitosamente');
					}
					else
					{
						$this->Flash->error('No se pudo agregar el monto. Esto puede ser porque aún no se han creado las fechas del tracto correspondiente o a que introdujo datos inválidos.');
					}

			}

			$this->set('amount',$amount);
			$this->set('tract',$tract);

		}
	}




	public function add($association_id = null)
	{
		

		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
		$amounts = $this->Amounts->find()
			->hydrate(false)
			->select(['tract.id'])
			->join([
				'table'=>'Tracts',
				'alias'=>'tract',
				'type'=>'inner',
				'conditions'=>'Amounts.tract_id = tract.id'

			])
			->where(['Amounts.association_id'=>$association_id, 'OR'=>[['YEAR(tract.date)'=>date('Y')],['YEAR(tract.date)'=>(date('Y')+1)]]]);

		$tracts = $this->Amounts->Tracts->find()
			->hydrate(false)
			->select(['Tracts.id','Tracts.date', 'Tracts.deadline', 'Tracts.number'])
			->where(function ($exp,$q)use($amounts){return $exp->notIn('Tracts.id',$amounts);});

		$tracts = $tracts->toArray();

		if($this->request->is('POST'))
		{

			$data = $this->request->data;
			$successAmountsIndex = $this->saveAmounts($data, $tracts); //Guardamos los montos

			if($successAmountsIndex)
			{
				$message = 'Se agregaron '.$successAmountsIndex." montos de tracto de ".count($tracts)."<br />";

				$successBoxesTract = $this->saveBoxes($data,0,$tracts); //Guardamos las cajas de tracto
				$successBoxesGenerated = $this->saveBoxes($data,1,$tracts); //Guardamos las cajas de ingresos generados

				$message .= 'Se agregaron '.$successBoxesTract." cajas de tracto de ".count($tracts)."<br />";
				$message .= 'Se agregaron '.$successBoxesGenerated." cajas de ingresos generados de ".count($tracts);

				$this->Flash->success($message);

				return $this->redirect(['action'=>'add',$association_id]);
			}

		}

		$associations = $this->Amounts->Associations->find('list');
		$this->set(compact('tracts','associations'));

	}


	private function saveAmounts($data, $tracts)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{


			$detail = $data['detail'];
			unset($data['detail']);
			$association_id = $data['association_id'];
			unset($data['association_id']);


			$index = 0;
			$successIndex = 0;

			$values['association_id'] = $association_id;
			$values['detail'] = $detail;
			$values['type'] = 0;

			foreach ($data as $key => $value) { //Se agrega monto por monto al tracto correspondiente

					$values['amount'] = $value;
					$values['tract_id'] = $tracts[$index]['id'];

					$entity = $this->Amounts->newEntity($values);

					try
					{
						if($this->Amounts->save($entity))
						{
							++$successIndex;
						}
					}
					catch(Exception $e)
					{

					}



				++$index;


			}

			return $successIndex;
		}
	}


	private function saveBoxes($data, $type, $tracts)
	{

		$this->loadModel('Boxes');

		$values['association_id'] = $data['association_id'];
		unset($data['association_id']);

		unset($data['detail']);


		$index = 0;
		$successIndex = 0;

		$values['type'] = $type;

		foreach ($data as $key => $value) { //Se agrega monto por monto al tracto correspondiente


			$values['little_amount'] = 0;
			$values['big_amount'] = 0;
			$values['tract_id'] = $tracts[$index]['id'];

			$entity = $this->Boxes->newEntity($values);

			try {
				if ($this->Boxes->save($entity)) {
					++$successIndex;
				}
			} catch (Exception $e) {

			}


			++$index;
		}

		return $successIndex;
	}


	public function getTracts($year)
	{

			$query = $this->Amounts->Tracts->find()
			->hydrate(false)
				->where(['YEAR(date)'=>$year]); //Queremos los tractos del año actual



		$query = $query->toArray();

		return $query;
	}

	private function getHeadquarters()
	{
		$query = $this->Amounts->Associations->Headquarters->find() //Se trae solo las headquarter que tienen alguna asocicación asociada :p
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




/**
 *  Esta funcion devuelve el id del presente tracto
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

	public function getAssociations($headquarter_name)
	{

		if($this->request->is("GET"))
		{
			$headquarter_id = $this->Amounts->Associations->Headquarters->find() //Se busca primero el id de esa sede por medio del nombre
									->hydrate(false)
									->select(['id'])
									->where(['name'=>$headquarter_name]);

			$headquarter_id = $headquarter_id->toArray();


			$associations = $this->Amounts->Associations->find() //Se obtienen los nombres de las asociaciones con el id recuperado
							->hydrate(false)
							->select(['name'])
							->where(['headquarter_id'=>$headquarter_id[0]['id']]);

			$associations = $associations->toArray();

			$associations = json_encode($associations);

			die($associations);
		}


	}


	public function getAssociationId($association_name)
	{
			$association_id = $this->Amounts->Associations->find() //Se busca primero el id de esa sede por medio del nombre
									->hydrate(false)
									->select(['id'])
									->where(['name'=>$association_name]);

			$association_id = $association_id->toArray();

			return $association_id[0]['id'];
	}


	public function edit($id = null)
	{

		try
		{
			$this->viewBuilder()->layout('admin_views');
			$amount = $this->Amounts->get($id, [
				'contain' => []
			]);



			if ($this->request->is(['patch', 'post', 'put'])) {

				$amount = $this->Amounts->patchEntity($amount, $this->request->data);
				if ($this->Amounts->save($amount)) {
					$this->Flash->success(__('El monto ha sido guardado.'));
					return $this->redirect(['action' => 'index']);
				} else {
					$this->Flash->error(__('El monto no ha podido ser guardado. Intentelo de nuevo'));
				}

			}


			$this->set(compact('amount'));
			$this->set('_serialize', ['amount']);
		}
		catch (RecordNotFoundException $e)
		{
			$this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
			return $this->redirect(['action' => 'index']);
		}

	}



	/**
	public function edit($id)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista


		$query = $this->getModifyInformation($id, date('Y')); //Pide la información de los montos

		//$entity = $this->Amounts->newEntity($query, ['validate'=>'update']);

		if($id)
		{
			if($this->request->is(array('post','put')))
			{
				$data = $this->request->data;
				$message = "Se modificaron los montos de los siguientes tractos: ";

				foreach ($query as $key=>$value)
				{
					$name = 'tract_'.$value['tract']['number']; //name de la vista

					$foo['amount'] = $data[$name];

					$entity = $this->Amounts->newEntity($foo, ['validate'=>'update']);


					if(!$entity->errors())
					{
						$update = $this->Amounts->query();
						$update->update()
							->set(['amount'=>$data[$name]])
							->where(['id'=>$value['id']])
							->execute();
						$message .= " ".$value['tract']['number'].",";
					}



				}
				$this->Flash->success($message);
				$query = $this->getModifyInformation($id, date('Y'));//Pide la información de los montos

			}
		}


		$this->set('data',$query); // set() Pasa la variable id a la vista.
	}
**/

	private function getModifyInformation($id, $year)
	{
		$this->loadModel('Tracts');

		$query = $this->Amounts->find()
			->select(['id','amount', 'tract.date', 'tract.deadline', 'tract.number'])
			->hydrate(false)
			->join([
				'table'=>'tracts',
				'alias'=>'tract',
				'type'=>'LEFT',
				'conditions'=>'Amounts.tract_id = tract.id'
			])
			->andwhere(['association_id'=>$id, 'YEAR(tract.date)'=>$year]);
		$query = $query->toArray();

		return $query;
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
      if(($this->request->session()->read('Auth.User.role')) == 'rep'){
          try
          {
              $this->viewBuilder()->layout('admin_views');
              $this->request->allowMethod(['post', 'delete']);
              $amount = $this->Amounts->get($id);
              try
              {
                  if ($this->Amounts->delete($amount)) {
                      $this->Flash->success(__('El monto ha sido borrado.'));
                  } else {
                      $this->Flash->error(__('El monto no ha podido ser borrado. Intentelo de nuevo'));
                  }
                  return $this->redirect(['action' => 'index']);
              }
              catch (\PDOException $e)
              {
                  $this->Flash->error(__('Error al borrar el monto. Esto puede deberse a que hay información asociada en la base de datos a este monto. Borre cualquier información asociada y luego intente de nuevo.'));
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



	public function isAuthorized($user)
	{
		
		if(in_array($this->request->action,['edit','delete']))
		{
			$amountId = (int)$this->request->params['pass'][0];
	        if ((($this->request->session()->read('Auth.User.role')) == 'rep') && $this->Amounts->isOwnedBy($amountId, $user['association_id'])) {
	            return true;
	        }
		}
		elseif(in_array($this->request->action,['addAmounts','index']))
		{
			return true;
		}



		return parent::isAuthorized($user);
	}




}