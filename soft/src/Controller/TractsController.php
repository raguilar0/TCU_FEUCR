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
	
	public function add($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$tract = $this->Tracts->newEntity($this->request->data);

		if($this->request->is('post'))
		{
			$tract['association_id'] = 1;
			if($this->Tracts->save($tract))
			{

			}
		}
		else
		{
			$this->set('tract', $tract);
		}
	}

	
}
