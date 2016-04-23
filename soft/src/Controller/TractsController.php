<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

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

			if($this->Tracts->save($tract))
			{

				$this->Flash->success('Se agregó el tracto exitosamente', ['key' => 'addTractSuccess']);
			}
            else
            {
            	$this->response->statusCode(404);

            }
		}
		else
		{
			$date = $this->Tracts->find()
					->hydrate(false)
					->select(['date', 'deadline'])
					->order(['id'=>'DESC'])
					->limit(1);
			$date = $date->toArray();

			if(!empty($date))
			{
				$tract['dates'] = $date[0];
			}


			$this->set('tract', $tract);


		}
		
		//$this->set('tract', $tract);
	}

	
}
