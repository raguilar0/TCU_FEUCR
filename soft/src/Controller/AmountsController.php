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
		
		
		$amount = $this->Amounts->newEntity($this->request->data); //El parámetro es para validar los datos

		$association_name = $this->Amounts->Associations->find()
							->hydrate(false)
							->select(['name','acronym'])							
							->where(['id'=>$id]);

		$association_name = $association_name->toArray();

		$amount['association'] = $association_name[0];


		$response = 0;

		if($this->request->is('post') && $id)
		{
			$amount['association_id'] = $id;

				if($this->Amounts->save($amount)) //Guarda los datos
				{
					$response = '1';
				}

			die($response);
		}
		
		$this->set('amount',$amount);
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

		$firstQuery = $this->Headquarters->find()
						->hydrate(false)
						->select(['id', 'name']);

		$firstQuery = $firstQuery->toArray();

		
		$end = count($firstQuery);
		$secondQuery = array();
		//Por cada sede recupera las asocias dentro de esa sede
		for ($i=0; $i < $end ; $i++) { 
			$query = $this->Amounts->Associations->find()
				->hydrate(false)
				->select(['name','id'])
				->where(['headquarter_id'=> $firstQuery[$i]['id']]);


			

			$secondQuery[$firstQuery[$i]['name']] = $query->toArray();

		}

		

		$this->set('data',$secondQuery);
		
		
	}
}