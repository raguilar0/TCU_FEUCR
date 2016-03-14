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


		$firstQuery = $this->Associations->find()
						-> select(['headquarters'])
						-> distinct(['headquarters']); //Obtiene todas las sedes distintas que hay

		$firstQuery->hydrate(false); //Quita elementos innecesarios

		$firstQuery = $firstQuery->toArray();

		$secondQuery = array();

//Por cada sede recupera las asocias dentro de esa sede
		for ($i=0; $i < count($firstQuery) ; $i++) { 
				$query = $this->Associations->find()
				->select(['name','id'])
				->where(["headquarters = '".$firstQuery[$i]['headquarters']."'"]);
			$query->hydrate(false); //Quita elementos innecesarios de la consulta	

			

			$secondQuery[$firstQuery[$i]['headquarters']] = $query->toArray();
		}

		$this->set('data',$secondQuery);
		
	}

	public function add()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$association = $this->Associations->newEntity($this->request->data); //El parámetro es para validar los datos


		if($this->request->is('post'))
		{


			if($this->Associations->save($association)) //Guarda los datos
			{

			}


		}

		$this->set('association',$association); // set() Pasa la variable association a la vista.
	}

	public function modify($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		if($id)
		{
			$association = $this->Associations->get($id);

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
