<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class AssociationsController extends AppController
{



	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

	}
	
	public function showAssociations()
	{
		$this->viewBuilder()->layout('admin_views');

		$this->loadModel('Headquarters');

		$firstQuery = $this->Headquarters->find()
						->hydrate(false)
						->select(['id', 'name']);

		$firstQuery = $firstQuery->toArray();

		
		$end = count($firstQuery);
		$secondQuery = array();
<<<<<<< HEAD

//Por cada sede recupera las asocias dentro de esa sede
		for ($i=0; $i < count($firstQuery) ; $i++) { 
				$query = $this->Associations->find()
=======
		//Por cada sede recupera las asocias dentro de esa sede
		for ($i=0; $i < $end ; $i++) { 
			$query = $this->Associations->find()
				->hydrate(false)
>>>>>>> 0d2c2f60f8a000ce464580173334c32591106b39
				->select(['name','id'])
				->where(['headquarter_id'=> $firstQuery[$i]['id']]);


			

			$secondQuery[$firstQuery[$i]['name']] = $query->toArray();

		}

		$this->set('data',$secondQuery);
		
	}

	public function add()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$association = $this->Associations->newEntity($this->request->data); //El parámetro es para validar los datos



		if($this->request->is('post'))
		{

			$this->loadModel('Headquarters'); //Carga el modelo de esta asociación
			$headquarter = $this->Headquarters->find()
							-> select(['id']) //Realiza la consulta
							-> where(["name = '".$this->request->data['headquarter_id']."'"]); //Obtiene el id donde la sede  elegida por el usuario
			$headquarter->hydrate(false);

			$headquarter = $headquarter->toArray();

			$association['headquarter_id'] = $headquarter[0]['id']; //Reemplaza la elección del usuario por el id 

			if($this->Associations->save($association)) //Guarda los date_offset_get()
			{

			}


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

			}

			$this->set('association',$association); // set() Pasa la variable association a la vista.
	}

	public function modify($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		if($id)
		{
			$association = $this->Associations->get($id);

			$head = $this->Associations->Headquarters->find()
							->hydrate(false)
							->select(['id','name'])
							->where(['id'=>$association->headquarter_id]);

			$head = $head->toArray();

			$association->headquarter_id = $head[0]['name'];

			debug($association);

			if($this->request->is(array('post','put')))
			{
				
				$asso = $this->Associations->newEntity($this->request->data);

				$association->acronym = $this->request->data['acronym'];
				$association->name = $this->request->data['name'];
				$association->location = $this->request->data['location'];
				$association->schedule = $this->request->data['schedule'];
				$association->authorized_card = $this->request->data['authorized_card'];
				$association->headquarters = $this->request->data['headquarters'];

				if($this->Associations->save($association))
				{
						

				}


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
			$association = $this->Associations->get($id);

			if($this->Associations->delete($association))
			{
				return $this->redirect(['action'=>'showAssociations']);
			}
		}

	}

	
}
