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

	public function showAssociations($id = null)
	{
		if($id)
		{
			$this->viewBuilder()->layout('associations_view');


			$query = $this->Savings->Associations->Headquarters->find()
				->hydrate(false)
				->select(['a.name','a.id','name'])
				->join([
					'table'=>'associations',
					'alias'=>'a',
					'type' => 'RIGHT',
					'conditions'=>'Headquarters.id = a.headquarter_id',
				])
				->where(['a.enable'=>1])
				->order(['Headquarters.name']);


			$query = $query->toArray();



			switch ($id) {
				case 1:
					$query['link'] = 'add';
					break;

			}

			$this->set('data',$query);

		}
		else
		{
			$this->redirect(['action'=>'/']);
		}
	}


}
