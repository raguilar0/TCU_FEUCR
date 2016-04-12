<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class AssociationsController extends AppController
{

	public function view($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		if($id)
		{
			$association = $this->Associations->get($id);
			$this->set('data',$association); // set() Pasa la variable association a la vista.
		}
		else
		{
			// Redirige de vuelta al index
			return $this->redirect(['action'=>'index']);
		}
	}

	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
	}
	
	public function showAssociations($id = null)
	{
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
					->where(['a.enable'=>1]);


			$query = $query->toArray();

		

			switch ($id) {
					case 1:
							$query['link'] = 'read';
						break;

					case 3:
							$query['link'] = 'modify';
						break;										
					
					case 4:
							$query['link'] = 'delete';
						break;	
			}

			$this->set('data',$query);

		}
	}


	public function read($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		if($id)
		{
			$association = $this->Associations->get($id);

			$headquarter = $this->Associations->Headquarters->find()
							->hydrate(false)
							->select(['name'])
							-> where(['id'=> $association['headquarter_id']]);

			$headquarter = $headquarter->toArray();

			$association['headquarter']= $headquarter[0]['name'];


			$amounts = $this->Associations->Amounts->find()
						->select(['amount'=>'round(amount,0 )','date','deadline'])
						->where(['association_id'=>$id])
						->order(['id'=> 'DESC']);
						
			
			$amounts = $amounts->toArray();
			
			$association['amounts'] = $amounts;

			$this->set('data',$association);

		}
	}

	public function add()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$association = $this->Associations->newEntity($this->request->data); //El parámetro es para validar los datos


		if($this->request->is('post'))
		{

			
			$response = "0,0"; //Funciona como booleano, para decidir qué mostrar en el ajax.
			
			$this->loadModel('Headquarters'); //Carga el modelo de esta asociación
			$headquarter = $this->Headquarters->find()
							->hydrate(false)
							-> select(['id']) //Realiza la consulta
							-> where(["name = '".$this->request->data['headquarter_id']."'"]); //Obtiene el id donde la sede  elegida por el usuario

			$headquarter = $headquarter->toArray();

			$association['headquarter_id'] = $headquarter[0]['id']; //Reemplaza la elección del usuario por el id 

			if($this->Associations->save($association)) //Guarda los date_offset_get()
			{
				$response = "1,0";

				$query = $this->Associations->find();

				$query->hydrate(false);
				$query->select(['max_id' => $query->func()->max('id')]);

				$query = $query->toArray();


				$this->request->data['spent'] = 0;
				$this->request->data['association_id'] = $query[0]['max_id'];


				$amounts = $this->Associations->Amounts->newEntity($this->request->data);

				if($this->Associations->Amounts->save($amounts))
				{
					$response = "1,1";
				}
			}

			
			die($response);

			
		}
		else
		{
			//Hago esta operación en el else, porque no me interesa cargarlo cuando voy a guardar los datos

			$this->loadModel('Headquarters'); //Carga el modelo de esta asociación

			$headquarter = $this->Headquarters->find()
							-> select(['name']); //Realiza la consulta

			$headquarter->hydrate(false); //Quita elementos inncesarios
			$headquarter = $headquarter->toArray(); //Convierte el resultado a un array



			$association['headquarter'] = $headquarter; //Lo asocia

			/**
				El siguiente código que asocia un date a $association
				corrige el hecho de que una persona tenga que poner la fecha de inicio de tracto cada vez. Existen dos casos:

				1) La primera vez: La primera vez no existen montos asociados a ninguna asociación, por lo que se toma la fecha actual.

				2) Una vez que existan montos asociados: Cuando ya hay montos asociados, se toma como fecha de tracto actual al último monto asociado
			**/

			$date = $this->Associations->Amounts->find()
							->hydrate(false)
							->select(['date', 'deadline'])
							->order(['id'=>'DESC'])
							->limit(1);

			$date = $date->toArray();


			if(!isset($date[0]))
			{
				$date['date'] = $date['deadline'] = date('Y-m-d');
			}
			else
			{
				$date = $date[0];
			}

			$association['date'] = $date;


		}

			$this->set('association',$association); // set() Pasa la variable association a la vista.
	}

	public function modify($id = null)
	{

		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		$this->loadModel('Amounts');
		
		if($id)
		{
			$association = $this->Associations->get($id);

			$headquarter_asso = $this->Associations->Headquarters->get($association['headquarter_id']);


			//Las siguientes lineas permiten devolver las sedes ordenadas primero por la sede a donde pertenece
			//la asociacion
			$head = $this->Associations->Headquarters->find()
							->hydrate(false)
							->select(['name'])
							-> order(['(name'=>" = '".$headquarter_asso['name']."')DESC"]); //NO LO INTENTEN EN SUS CASAS!!! XD

			$head = $head->toArray();

			$association['headquarter']= $head;


//Se recupera la información del monto más reciente que le fue asignado
//a la asociación con el id = $id


			$amount = $this->Associations->Amounts->find()
							->hydrate(false)
							->select(['id','amount','date', 'deadline'])
							->order(['id'=>'DESC'])
							->limit(1);


			$amount = $amount->toArray();
			

			$association['amounts'] = (isset($amount[0])?$amount[0]:null); //if inline


			if($this->request->is(array('post','put')))
			{

				
				$response = "0"; //Funciona como booleano para decirle al ajax qué desplegar


				$autorized = (isset($this->request->data['authorized_card']) ? 1 : 0); //Verifica si se checó el checkbox f las tarjetas



				$newHeadquarter = $this->Associations->Headquarters->find() //Independientemente de si el usuario cambió de sede o no, se recupera la sede que se 
						->hydrate(false)									// recupera la sede para posteriormente actualizar ese campo
						->select(['id'])
						->where(['name'=>$this->request->data['headquarter_id']]);
						
				$newHeadquarter = $newHeadquarter->toArray();

				
				if(($association['name'] == $this->request->data['name']) && ($association['acronym'] == $this->request->data['acronym']))
				{
					$query = $this->Associations->query();

					$query->update()
						  ->set(['location'=> $this->request->data['location'], 'schedule'=>$this->request->data['schedule'], 'headquarter_id'=> $newHeadquarter[0]['id'], 'authorized_card'=>$autorized])
						  ->where(['id'=> $id])
						  ->execute();




					$response = "1"; //Booleano para el JQuery

				}
				else
				{

					$validator = $this->Associations->newEntity($this->request->data);
					
					if(!$validator->errors())
					{
						
						$association->acronym = $this->request->data['acronym'];
						$association->name = $this->request->data['name'];
						$association->location = $this->request->data['location'];
						$association->schedule = $this->request->data['schedule'];
						
						$association->authorized_card = $autorized;
																					
						$association->headquarter_id = $newHeadquarter[0]['id'];

		
						if($this->Associations->save($association))
						{
							$response = "1";
						}
						
					}

				}


				try
				{


					//Luego actualiza la información de los montos asociados a esa asociación
						$query = $this->Associations->Amounts->query();

					//Se formatean las fechas
						$date = $this->request->data['date']['year'].$this->request->data['date']['month'].$this->request->data['date']['day'];

						$deadline = $this->request->data['deadline']['year'].$this->request->data['deadline']['month'].$this->request->data['deadline']['day'];
					

						$query->update()
							  ->set(['amount'=>$this->request->data['amount'],
							  		  'date'=>$date,
							  		  'deadline'=>$deadline])
							  ->where(['id'=>$amount[0]['id']])//amount ya se asignó arriba
							  ->execute();


				 	$response = $response.",1";

				}
				catch(Exception $e)
				{
					$response = $response.",0";
				}


				
				die($response);

			}
			else
			{
				$this->set('data',$association); // set() Pasa la variable association a la vista.
			}
		}


		
	}

	public function delete($id = null)
	{
		if($id)
		{
			try
			{
				//Obtengo los datos de la asociación con el id = $id
				$association = $this->Associations->get($id);

				//Obtengo todas las tuplas de Amounts asociadas a dicha
				//asociación
				$select = $this->Associations->Amounts->find()
							->select(['amount','date','spent','deadline','association_id'])
							->where(['association_id'=> $association['id']]);

				

				
				//Cargo este modelo para guardar la información
				$this->loadModel('Warehouses');

				//Hago el insert con las tuplas recuperadas
				$insert = $this->Warehouses->query()
							->insert(['amount','date','spent','deadline','association_id'])
							->values($select)
							->execute();

				//Borro las tuplas ya guardadas en el almacén

				$delete = $this->Associations->Amounts->query();

				$delete->delete()
					  ->where(['association_id'=>$association['id']])
					  ->execute();

			//Desactivo la asociación
				$update = $this->Associations->query();

				$update->update()
						->set(['enable'=>0])
						->where(['id'=>$association['id']])
						->execute();


			return $this->redirect(['action'=>'show_associations/4']);

			}
			catch(Exception $e)
			{
				echo "Ocurrió un error inesperado";
			}


		
		}

	}
	
	
	public function generalInformation($id = null) {
		$this->viewBuilder()->layout('admin_views'); //Se deja este hasta mientras se haga el de representante

		$id = 1;
		if($id) {
			$association = $this->Associations->get($id);

			$head = $this->Associations->Headquarters->find()
							->hydrate(false)
							->select(['id','name'])
							->where(['id'=>$association->headquarter_id]);

			$head = $head->toArray();

			$association->headquarter_id = $head[0]['name'];



			if($this->request->is(array('post','put')))	{
				
				$asso = $this->Associations->newEntity($this->request->data);

				$association->acronym = $this->request->data['acronym'];
				$association->name = $this->request->data['name'];
				$association->location = $this->request->data['location'];
				$association->schedule = $this->request->data['schedule'];
				$association->authorized_card = $this->request->data['authorized_card'];
				$association->headquarters = $this->request->data['headquarters'];

				if($this->Associations->save($association))	{
						

				}


			}else{
				$this->set('data',$association); // set() Pasa la variable association a la vista.
			}
		}		
	}


	public function showDisables()
	{
		$this->viewBuilder()->layout('admin_views'); //Se deja este hasta mientras se haga el de representante
			$query = $this->Associations->Headquarters->find()
					->hydrate(false)
					->select(['a.name','a.id','name'])
					->join([
						 'table'=>'associations',
						 'alias'=>'a',
						 'type' => 'RIGHT',
						 'conditions'=>'Headquarters.id = a.headquarter_id',
						])
					->where(['a.enable'=>0]);

		$query = $query->toArray();


		$this->set('data', $query);
	}

	public function enable($id = null)
	{
		if($id)
		{
			$query = $this->Associations->query();

			$query->update()
				  ->set(['enable'=> 1])
				  ->where(['id'=> $id])
				  ->execute();			
			
			return $this->redirect(['action'=>'show_disables']);
		}
	}
	
}
