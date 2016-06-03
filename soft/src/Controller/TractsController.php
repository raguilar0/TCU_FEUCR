<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\I18n\Time;

class TractsController extends AppController
{



	public function index()
	{	if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		}
	}

	public function add()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

			$tract = $this->Tracts->newEntity();

			if($this->request->is('post'))
			{

				//$this->request->data['date'] = new Time($this->request->data['date']);

				//$this->request->data['deadline'] = new Time($this->request->data['deadline']);

				$tract = $this->Tracts->patchEntity($tract, $this->request->data);



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


}
