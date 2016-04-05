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
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		
		
		if($id)
		{
			$amount = $this->Amounts->newEntity($this->request->data); //El parámetro es para validar los datos

			$association_name = $this->Amounts->Associations->find()
								->hydrate(false)
								->select(['name','acronym'])							
								->where(['id'=>$id]);

			$association_name = $association_name->toArray();

			$amount['association'] = $association_name[0];


			$response = 0;

			if($this->request->is('post'))
			{
				$amount['association_id'] = $id;

					if($this->Amounts->save($amount)) //Guarda los datos
					{
						$response = '1';
					}

				die($response);
			}
			else
			{

				/**
					El siguiente código que asocia un date a $association
					corrige el hecho de que una persona tenga que poner la fecha de inicio de tracto cada vez. Existen dos casos:

					1) La primera vez: La primera vez no existen montos asociados a ninguna asociación, por lo que se toma la fecha actual.

					2) Una vez que existan montos asociados: Cuando ya hay montos asociados, se toma como fecha de tracto actual al último monto asociado
				**/

				$date = $this->Amounts->find()
								->hydrate(false)
								->select(['date', 'deadline'])
								->having(['max(id)']);

				$date = $date->toArray();


				if(!isset($date[0]))
				{
					$date['date'] = $date['deadline'] = date('Y-m-d');
				}
				else
				{
					$date = $date[0];
				}

				$amount['date'] = $date;				
			}
				
			$this->set('amount',$amount);
		}

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
					->where(['a.enable'=>1]);


			$query = $query->toArray();

		

		$this->set('data',$query);
		
		
	}
}