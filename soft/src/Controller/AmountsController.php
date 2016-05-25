<?php
namespace App\Controller;

use App\Controller\AppController;

class AmountsController extends AppController
{
	
	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$amount = $this->Amounts->find()
						->hydrate(false);
		
				
		$amount = $amount->toArray();
		
		$this->set('amount',$amount); // set() Pasa la variable amount a la vista.
	
	}
	


	public function add($association = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
		
		$tracts = $this->getTracts(date('Y'));		

		if($this->request->is('POST') && $association)
		{

			$data = $this->request->data;

			$date = $data['date'];  //Estos datos son comunes a todos los tractos
			unset($data['date']);

			$detail = $data['detail'];
			unset($data['detail']);

			$association_id = $this->getAssociationId($association);
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

				if($this->Amounts->save($entity))
				{
					++$successIndex;
				}

				++$index;
			}

			die('Se agregaron exitosamente '.$successIndex.' montos');

		}
		else
		{

				$headquarters = $this->getHeadquarters(); //Pide todas las sedes
				$this->set('head',$headquarters);
				$this->set('data', $tracts);
		}
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

	public function edit($amount_id)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		
		$this->set('id',$amount_id); // set() Pasa la variable id a la vista.
	}

	public function showAssociations()
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

		

		$this->set('data',$query);
		
		
	}
}