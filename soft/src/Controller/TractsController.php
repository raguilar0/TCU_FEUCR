<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class TractsController extends AppController
{



	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
	}
	
	public function add()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$tract = $this->Tracts->newEntity($this->request->data);

		if($this->request->is('post'))
		{

			//$tract = $this->Tracts->patchEntity($tract, $this->request->data);
			if($this->Tracts->save($tract))
			{

			}
		}
		

		$this->set('tract', $tract);
		
	}

	
}
