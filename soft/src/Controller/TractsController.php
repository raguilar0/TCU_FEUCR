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
<<<<<<< HEAD
				$this->Flash->success('Se agregó el tracto exitosamente', ['key' => 'addTractSuccess']);
			}
            else
            {
                
                return $tract['error'];
=======
				$this->response->statusCode(200);
			}
            else
            {
            	$this->response->statusCode(404);
            	$response['success'] = $tract->errors();
            	$this->set(compact('response'));
            	$this->set('_serialize','response');        
>>>>>>> 9062913e8aab816b77185b7208eb99755d5f6b9b
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

<<<<<<< HEAD
			$this->set('tract', $tract);
=======
		$this->set('tract', $tract);			
>>>>>>> 9062913e8aab816b77185b7208eb99755d5f6b9b

		}
		

<<<<<<< HEAD
		
=======

>>>>>>> 9062913e8aab816b77185b7208eb99755d5f6b9b
		
	}

	
}
