<?php
namespace App\Controller;

use App\Controller\AppController;

class AmountsController extends AppController
{
	public function index()
	{
		$this->viewBuilder()->layout('admin_views');

		$this->loadModel('Associations');
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

		$amount = $this->Amounts->newEntity($this->request->data); //El parámetro es para validar los datos


		if($this->request->is('post'))
		{

			if($this->Amounts->save($amount)) //Guarda los datos
			{
				$this->Flash->success(__('El monto ha sido guardado exitosamente'));
                return $this->redirect(['action' => 'add']); //Redirecciona a la vista del index cuando guarda los datos. 
			}

			$this->Flash->error(__('No es posible guardar el monto en este momento'));
		}

		$this->set('amount',$amount); // set() Pasa la variable amount a la vista.
	}

	public function showInformation($id = null)
	{
		$this->viewBuilder()->layout('admin_views');

		if($id)
		{
			$amount = $this->Amounts->get($id);

			$this->set('data',$amounts);
		}
	}


}