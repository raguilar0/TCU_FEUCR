<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class AssociationsController extends AppController
{

//TODO: Si se agrega una asociación sin que hayan sedes, muestra el mensaje de que se agregó la asociación. Arreglarlo

	public function view($id = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
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
	}

	public function index()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		}
	}


	public function indexAssociations()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('associations_view'); //Carga un layout personalizado para esta vista
		}
	}

	public function showAssociations($id = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
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
								$query['link'] = 'read';
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
	}


	public function read($id = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{

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


		/**Obtenemos las fechas de los montos asociados**/

					$amounts = $this->Associations->Amounts->find()
							->hydrate(false)
							->select(['tract.number','tract.date','tract.deadline','amount', 'date'])
							->join([
								 'table'=>'tracts',
								 'alias'=>'tract',
								 'type' => 'RIGHT',
								 'conditions'=>'Amounts.tract_id = tract.id',
								])
							->andwhere(['type'=>0, 'association_id'=>$id])
							->order(['Amounts.id'=> 'DESC']);

					$amounts = $amounts->toArray();


					$association['amounts'] = $amounts;

					$this->set('data',$association);

				}
				else
				{
					$this->redirect(['action'=>'/']);
				}
			}
		}

		public function add()
		{
			if(($this->request->session()->read('Auth.User.role')) != 'admin'){
				return $this->redirect($this->Auth->redirectUrl());
			}
			else{

				$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

				$association = $this->Associations->newEntity($this->request->data); //El parámetro es para validar los datos

				$amounts_type = array('Tracto'=> 0, 'Superávit' => 2);


				if($this->request->is(array('post','put')))
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


						$asso_id = $this->Associations->find()
										->hydrate(false)
										->select(['id'])
										->order(['id'=>'DESC'])
										->limit(1);


							$asso_id = $asso_id->toArray();

								$this->loadModel('Tracts');

								$tract = $this->Tracts->find()
												->hydrate(false)
												->select(['id'])
												->order(['id'=>'DESC'])
												->limit(1);

								$tract = $tract->toArray();

								if(!empty($tract))
								{
									$this->request->data['association_id'] = $asso_id[0]['id'];
									$this->request->data['tract_id'] = $tract[0]['id'];
									$this->request->data['type'] = $amounts_type[$this->request->data['type']];
								}

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

					$association['amounts_type'] = $amounts_type;

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


					$this->loadModel('Tracts');

					$tract = $this->Tracts->find()
									->hydrate(false)
									->select(['date', 'deadline','id'])
									->order(['id'=>'DESC'])
									->limit(1);

					$tract = $tract->toArray();

					$association['tract'] = $tract;

				}

					$this->set('association',$association); // set() Pasa la variable association a la vista.
			}
	}

	public function modify($id = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{

			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

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

				/**
				$amount = $this->Associations->Amounts->find()
								->hydrate(false)
								->select(['id','amount','date', 'deadline'])
								->order(['id'=>'DESC'])
								->limit(1);


				$amount = $amount->toArray();


				$association['amounts'] = (isset($amount[0])?$amount[0]:null); //if inline

				**/

				if($this->request->is(array('post','put')))
				{


					$response = "0"; //Funciona como booleano para decirle al ajax qué desplegar


					$autorized = (isset($this->request->data['authorized_card']) ? 1 : 0); //Verifica si se checó el checkbox de las tarjetas



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

	/**

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
	**/


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

	}

	public function delete($id = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{

			//TODO: Implementar esto hasta que existan facturas
			if($id)
			{
				try
				{
					//Obtengo los datos de la asociación con el id = $id
					$association = $this->Associations->get($id);

					//Obtengo todas las tuplas de Amounts asociadas a dicha
					//asociación
					$select = $this->Associations->Amounts->find()
								->select(['amount','date','spent','detail','type','association_id','tract_id'])
								->where(['association_id'=> $association['id']]);

					//Cargo este modelo para guardar la información
					$this->loadModel('Warehouses');

					//Hago el insert con las tuplas recuperadas
					$insert = $this->Warehouses->query()
								->insert(['amount','date','spent','detail','type','association_id','tract_id'])
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
			else
			{
				$this->redirect(['action'=>'/']);
			}
		}
	}


	public function generalInformation($id = null) {

		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{

			$this->viewBuilder()->layout('associations_view'); //Se deja este hasta mientras se haga el de representante

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
	}


	public function showDisables()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else {
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
	}

	public function enable($id = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			if($id)
			{
				$query = $this->Associations->query();

				$query->update()
					  ->set(['enable'=> 1])
					  ->where(['id'=> $id])
					  ->execute();

				return $this->redirect(['action'=>'show_disables']);
			}
			else
			{
				$this->redirect(['action'=>'/']);
			}
		}
	}


	public function detailedInformation($id = null, $year = null)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views');
			if($id)
			{

				$year = ($year ? $year: date('Y')); //Si el año viene nulo, agregamos el actual

				$tract_dates = $this->Associations->Amounts->find()
									->hydrate(false)
									->select(['tract.date','type','tract.number'])
									->andwhere(['association_id'=>$id, 'YEAR(tract.date)'=>$year])
									->join([
										'table'=>'tracts',
										'alias'=>'tract',
										'type'=>'RIGHT',
										'conditions'=>'Amounts.tract_id = tract.id'

										])
									//->order(['tract.id'=>'DESC', 'Amounts.id'=>'DESC']);
									//->order(['type'=>'ASC']);
									->group(['tract.date']);
									//->limit(1);


				$tract_dates = $tract_dates->toArray();

				$this->loadModel('Tracts'); //Obtenemos todos los años que existen

				$tracts_year = $this->Tracts->find()
									->hydrate(false)
									->select(['year'=>'YEAR(date)'])
									->order(['(year'=>" = '".$year."') DESC, year"]) //NO LO INTENTEN EN SUS CASAS!!! XD
									->group(['year']);

				$tracts_year = $tracts_year->toArray();


				$association_name = $this->Associations->find()
									->hydrate(false)
									->select(['name'])
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
	}



	public function getAmounts($association_id = null, $amount_type = null, $box_type = null,$invoice_type = null, $date = null)
	{
		if($amount_type != 2)
		{
			$amount = $this->Associations->Amounts->find()
							->hydrate(false)
							->select(['tract.number','amount','tract.deadline', 'date', 'detail'])
							->andwhere(['association_id'=>$association_id, 'type'=>$amount_type])
							->join([
								'table'=>'tracts',
								'alias'=>'tract',
								'type'=>'RIGHT',
								'conditions'=>'Amounts.tract_id = tract.id and tract.date = '."'".$date."'"

								]);

			$amount = $amount->toArray();


			$box = $this->Associations->Boxes->find()
							->hydrate(false)
							->select(['little_amount','big_amount'])
							->andwhere(['association_id'=>$association_id, 'type'=>$box_type])
							->join([
								'table'=>'tracts',
								'alias'=>'tract',
								'type'=>'RIGHT',
								'conditions'=>'Boxes.tract_id = tract.id and tract.date = '."'".$date."'"

								]);

			$box = $box->toArray();



			$initial_amount = $this->Associations->InitialAmounts->find()
							->hydrate(false)
							->select(['amount'])
							->andwhere(['association_id'=>$association_id, 'type'=>$amount_type])
							->join([
								'table'=>'tracts',
								'alias'=>'tract',
								'type'=>'RIGHT',
								'conditions'=>'InitialAmounts.tract_id = tract.id and tract.date = '."'".$date."'"

								]);

			$initial_amount = $initial_amount->toArray();


			$information['boxes'] = $box;
			$information['initial_amount'] = $initial_amount;

		}
		else
		{
			//TODO: Filtrar para que solo me dé el superávit de cierta fecha


			$amount = $this->Associations->Surpluses->find()
							->hydrate(false)
							->select(['amount'])
							->andwhere(['association_id'=>$association_id, 'YEAR(date)'=>$date]);


			$amount = $amount->toArray();	
		}


			
			$invoices = $this->Associations->Invoices->find()
							->hydrate(false)
							->select(['date','number','detail','provider','amount','attendant','clarifications'])
							->andwhere(['association_id'=>$association_id, 'kind'=>$invoice_type, 'state'=>1])
							->join([
								'table'=>'tracts',
								'alias'=>'tract',
								'type'=>'RIGHT',
								'conditions'=>'Invoices.tract_id = tract.id and tract.date = '."'".$date."'"

								]);

			$invoices = $invoices->toArray();


			$information['amount'] = $amount;
			
			$information['invoices'] = $invoices;
			

			$information = json_encode($information);


			die($information);
	}
}
