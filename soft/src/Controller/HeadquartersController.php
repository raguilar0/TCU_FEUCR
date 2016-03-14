<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class HeadquartersController extends AppController
{


	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

	}
	
	
	public function add()
	{
		$headquarter = $this->Headquarters->newEntity($this->request->data); //El parámetro es para validar los datos


		if($this->request->is('post'))
		{


			if($this->Headquarters->save($headquarter)) //Guarda los datos
			{
				die('1');
			}
			else
			{
				die('0');
			}


		}

	}

	public function modify($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		if($id)
		{
			$association = $this->Headquarters->get($id);

			if($this->request->is(array('post','put')))
			{
				
				$asso = $this->Headquarters->newEntity($this->request->data);

				$association->acronym = $this->request->data['acronym'];
				$association->name = $this->request->data['name'];
				$association->location = $this->request->data['location'];
				$association->schedule = $this->request->data['schedule'];
				$association->authorized_card = $this->request->data['authorized_card'];
				$association->headquarters = $this->request->data['headquarters'];

				if($this->Headquarters->save($association))
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
			$association = $this->Headquarters->get($id);

			if($this->Headquarters->delete($association))
			{
				return $this->redirect(['action'=>'showHeadquarters']);
			}
		}

	}

	
}
