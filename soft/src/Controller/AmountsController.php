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
	


	public function add()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		
		$this->loadModel('Headquarters');
		$this->loadModel('Associations');
		
		$amount = $this->Amounts->newEntity($this->request->data); //El parámetro es para validar los datos


		if($this->request->is('post'))
		{
		$amount['association_id'] = 1;
		//debug($this->request->data);
			if($this->Amounts->save($amount)) //Guarda los datos
			{
				$this->Flash->success(__('El monto ha sido guardado exitosamente'));
                return $this->redirect(['action' => 'add']); //Redirecciona a la vista del index cuando guarda los datos. 
			}

			$this->Flash->error(__('No es posible guardar el monto en este momento'));
		}
		
		
		
		$firstQuery = $this->Headquarters->find()
						->hydrate(false)
						->select(['id', 'name']);

		$firstQuery = $firstQuery->toArray();
		$end = count($firstQuery);

		//Por cada sede recupera las asocias dentro de esa sede
		for ($i=0; $i < $end ; $i++) { 
			$query = $this->Associations->find()
				->hydrate(false)
				->select(['name','id'])
				->where(['headquarter_id'=> $firstQuery[$i]['id']]);
				
			$secondQuery[$firstQuery[$i]['name']] = $query->toArray();
		}
		
		$this->set('data', $secondQuery);
		$this->set('amount',$amount); // set() Pasa la variable amount a la vista.
		
	}

	public function edit($amount_id)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		
		$this->set('id',$amount_id); // set() Pasa la variable id a la vista.
	}


}