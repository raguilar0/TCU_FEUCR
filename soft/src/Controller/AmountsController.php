<?php
namespace App\Controller;

use App\Controller\AppController;

class AmountsController extends AppController
{

	public function index()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

			$amount = $this->Amounts->find()
							->hydrate(false);


			$amount = $amount->toArray();

			$this->set('amount',$amount); // set() Pasa la variable amount a la vista.
		}
	}
	
	public function addAmounts()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
			
			if($this->request->is('POST'))
			{
				$tract = $this->getTractId(date('Y-m-d'));
				$association_id = $this->request->session()->read('Auth.User.association_id');
				$type = 1;
				$data = $this->request->data;
				
				$data['tract_id'] = $tract;
				$data['association_id'] = $association_id;
				$data['type'] = $type;
				
				$entity =  $this->Amounts->newEntity($data);
				
				if($this->Amounts->save($entity))
				{
					$this->Flash->success('Se agregaron los montos exitosamente', ['key' => 'success']);
				}
				else
				{
					$this->Flash->error('No se pudo agregar el monto', ['key' => 'error']);
				}
			}
			
		}
	}
	
	private function saveAmount($data, $association_id, $tracts)
	{
		
		$date = $data['date'];  //Estos datos son comunes a todos los tractos
		unset($data['date']);
		
		$detail = $data['detail'];
		unset($data['detail']);
		
		$amount = $data['amount'];
		unset($data['amount']);
		
		$index = 0;
		$successIndex = 0;
		
		$values['association_id'] = $association_id;
		$values['date'] = $date;
		$values['detail'] = $detail;
		$values['type'] = 0;
		$values['amount'] = $amount;
		$values['tract_id'] = $tracts[$index]['id'];//$this->getTractId($tracts[$index]['date']); //Pide el id del tracto tomando como fecha la fecha de inicio
	
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
		
		return $successIndex;

	}
	



	public function add($association = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist

			$tracts = $this->getTracts(date('Y'));

			if($this->request->is('POST') && $association)
			{

				$data = $this->request->data;
				
				
				$association_id = $this->getAssociationId($association);

				$successAmountsIndex = $this->saveAmounts($data, $association_id, $tracts); //Guardamos los montos
				$successBoxesTract = $this->saveBoxes($data, $association_id,0,$tracts); //Guardamos las cajas de tracto
				$successBoxesGenerated = $this->saveBoxes($data, $association_id,1,$tracts); //Guardamos las cajas de ingresos generados



				$message = 'Se agregaron exitosamente '.$successAmountsIndex.' montos';
				$message .= '<br>'.'Se agregaron exitosamente '.$successBoxesTract.' cajas de Tracto';
				$message .= '<br>'.'Se agregaron exitosamente '.$successBoxesGenerated.' cajas de ingresos generados';
				debug($message);
				die($message);



			}
			else
			{

					$headquarters = $this->getHeadquarters(); //Pide todas las sedes
					$this->set('head',$headquarters);
					$this->set('data', $tracts);
			}
		}
	}


	private function saveAmounts($data, $association_id, $tracts)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{

			$date = $data['date'];  //Estos datos son comunes a todos los tractos
			unset($data['date']);

			$detail = $data['detail'];
			unset($data['detail']);


			$index = 0;
			$successIndex = 0;

			$values['association_id'] = $association_id;
			$values['date'] = $date;
			$values['detail'] = $detail;
			$values['type'] = 0;

			foreach ($data as $key => $value) { //Se agrega monto por monto al tracto correspondiente
				$values['amount'] = $value;
				$values['tract_id'] = $tracts[$index]['id'];//$this->getTractId($tracts[$index]['date']); //Pide el id del tracto tomando como fecha la fecha de inicio

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


	private function saveBoxes($data, $association_id, $type, $tracts)
	{

		$this->loadModel('Boxes');

		unset($data['date']);

		unset($data['detail']);


		$index = 0;
		$successIndex = 0;

		$values['association_id'] = $association_id;
		$values['type'] = $type;

		foreach ($data as $key => $value) { //Se agrega monto por monto al tracto correspondiente
			$values['little_amount'] = 0;
			$values['big_amount'] = 0;
			$values['tract_id'] = $tracts[$index]['id'];//$this->getTractId($tracts[$index]['date']); //Pide el id del tracto tomando como fecha la fecha de inicio

			$entity = $this->Boxes->newEntity($values);

			try
			{
				if($this->Boxes->save($entity))
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


	public function getTracts($year)
	{
		$this->loadModel('Tracts');

		$tracts = $this->Tracts->find()
					->hydrate(false)
					->where(['YEAR(date)'=>$year]); //Queremos los tractos del año actual
		$tracts = $tracts->toArray();

		return $tracts;
	}

	private function getHeadquarters()
	{
		$query = $this->Amounts->Associations->Headquarters->find() //Se trae solo las sedes que tienen alguna asocicación asociada :p
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

	private function createBoxes($little_amount, $big_amount, $tract_id, $association_id, $type)
	{
		$this->loadModel("Boxes");

		$data['little_amount'] = $little_amount;
		$data['big_amount'] = $big_amount;
		$data['tract_id'] = $tract_id;
		$data['association_id'] = $association_id;
		$data['type'] = $type;

		$boxes = $this->Boxes->newEntity($data);

		$success = false;

		if($this->Boxes->save($boxes))
		{
			$success = true;
		}

		return $success;
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

		return $id[0]['id'];
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
				$this->Flash->success($message, ['key' => 'message']);
				$query = $this->getModifyInformation($id, date('Y'));//Pide la información de los montos

			}
		}


		$this->set('data',$query); // set() Pasa la variable id a la vista.
	}

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

	
	public function showAssociations($id = null)
	{

		if($id)
		{
			$this->viewBuilder()->layout('admin_views');

			$this->loadModel('Headquarters');

			$query = $this->Headquarters->find()
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
					$query['link'] = 'edit';
					break;

			}








			$this->set('data',$query);
		}
		else
		{
			$this->redirect(['controller'=>'associations','action'=>'/']);
		}


		
		
	}

	
	
	
}
