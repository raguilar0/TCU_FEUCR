<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class SavingsController extends AppController
{

	public function add($id = null)
	{
		//TODO: En la vista de administrador, se debe poner el estado (aceptado o rechazado)
		$this->viewBuilder()->layout('associations_view'); //Carga un layout personalizado para esta vista
		$saving = $this->Savings->newEntity($this->request->data);
		

		if($this->request->is('post'))
		{
			if($id)
			{
				$saving['association_id'] = $id;
				
				if($this->Savings->save($saving))
				{
					
				}					
			}
			else
			{
				$this->redirect(['controller'=>'pages','action'=>'home']);
			}
		
		}

		
		$this->set('saving', $saving);
	}
}
