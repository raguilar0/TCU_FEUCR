<?php
namespace App\Controller;

use App\Controller\AppController;

class AssociationsController extends AppController
{
	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		
	}
	
	public function add()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$association = $this->Associations->newEntity($this->request->data); //El parámetro es para validar los datos


		if($this->request->is('post'))
		{

			if($this->Associations->save($association)) //Guarda los datos
			{
				$this->Flash->success(__('La Asociación ha sido guardada exitosamente'));
                return $this->redirect(['action' => 'add']); //Redirecciona a la vista del index cuando guarda los datos. 
			}

			$this->Flash->error(__('No es posible guardar la asociación en este momento'));
		}

		$this->set('association',$association); // set() Pasa la variable association a la vista.
	}
	
}
