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

			$query = $this->Headquarters->find()
					->hydrate(false)
					->select(['a.name','a.id','name'])
					->join([
						 'table'=>'associations',
						 'alias'=>'a',
						 'type' => 'RIGHT',
						 'conditions'=>'headquarters.id = a.headquarter_id',
						])
					->where(['a.enable'=>1]);


			$query = $query->toArray();

		

		$this->set('data',$query);
		
		
	}
}