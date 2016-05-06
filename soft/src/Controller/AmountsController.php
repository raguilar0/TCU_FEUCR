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
	


	public function add($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
		

		$this->loadModel('Tracts');

		$date = $this->Tracts->find() //Se trae el ultimo tracto
						->hydrate(false)
						->select(['date', 'deadline','id'])
						->order(['id'=>'DESC'])
						->limit(1);

		$date = $date->toArray();
		
		$amounts_type = array('Tracto'=> 0, 'Superávit' => 2);
		$amount = $this->Amounts->newEntity($this->request->data); //El parámetro es para validar los datos

			if($this->request->is('post'))
			{
				
				if($date[0]['id'] > 1) //TODO: Agregar acá el ahorro del período anterior
				{
					$this->loadModel('Boxes');

					$last_amount = $this->Boxes->find()
									->hydrate(false)
									->select(['little_amount', 'big_amount'])
									->andwhere(['tract_id'=>($date[0]['id'] - 1), 'association_id'=>$id, 'type'=>$amounts_type[$this->request->data['type']]]);

					$last_amount = $last_amount->toArray();

					$total = ($last_amount[0]['little_amount'] + $last_amount[0]['big_amount']);

					$amount['initial_amount'] = $total;
				}	
				
				$response = 0;
				
				$amount['association_id'] = $id;
				$amount['tract_id'] = $date[0]['id'];
				$amount['type'] = $amounts_type[$this->request->data['type']];

					if($this->Amounts->save($amount)) //Guarda los datos
					{
						$response = '1';
					}

				die($response);
			}

			else
			{
		
		
						
	/********************* Get Headquarters ****************************************/
	
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
	
	
	/************************ End Get Headquarters**********************************/
				
			
				
	
				

		
				$amount['amounts_type'] = $amounts_type;
				
				$amount['date'] = $date;	
				
				$this->set('amount',$amount);
				$this->set('head',$headquarters);
			}
		

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

			$association_id = json_encode($association_id);

			die($association_id);
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