<?php
namespace App\Controller;

use App\Controller\AppController;

class AmountsController extends AppController
{
	
	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$amount = $this->Amounts->find()
				->select(['amount','id']);
		
		$this->set('amounts',$amount); // set() Pasa la variable amount a la vista.
	
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




}