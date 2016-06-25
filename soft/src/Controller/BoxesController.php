<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class BoxesController extends AppController
{
	public function modify()
	{
		if($this->Auth->user()){
			$id = $this->request->session()->read('Auth.User.association_id');
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

			$actualDate = date("Y-m-d");
			$tract_id = $this->getTractId($actualDate) ;

			$box = $this->Boxes->find()
						->select(['little_amount','big_amount'])
						->andwhere(['association_id'=>$id, 'type'=> 1, 'tract_id' =>$tract_id]);

			$box = $box->toArray();

			if($this->request->is(array('post','put'))){

				if($box != []){
					$box = $this->Boxes->newEntity($this->request->data);
					$query = $this->Boxes->query();
					$query->update()
						  ->set(['big_amount'=> $this->request->data['big_amount'], 'little_amount'=>$this->request->data['little_amount']])
						  ->andwhere(['association_id'=> $id,'tract_id'=> $tract_id])
						  ->execute();


					$box = $this->Boxes->find()
						->select(['little_amount','big_amount'])
						->andwhere(['association_id'=>$id, 'type'=> 1, 'tract_id' =>$tract_id]);

					$box = $box->toArray();
				}
			}

			$this->set('data',$box);
		}
		else{
				return $this->redirect($this->Auth->redirectUrl());

		}

	}

	private function add($data)
	{
		if($this->Auth->user()){
			$boxes = $this->Boxes->newEntity($data);
			$response = 0;
			$id = $this->request->session()->read('Auth.User.association_id');
			$boxes['association_id'] = $id;
			if($this->Boxes->save($boxes)) //Guarda los date_offset_get()
			{
				$response = 1;
			}
    }
    else{
      return $this->redirect(['controller'=>'pages', 'action'=>'home']);
    }

	}


	private function getTractId($actualDate){
		if($this->Auth->user()){
			$this->loadModel('Tracts');

			//$actualDate = date("Y-m-d");

			$id = $this->Tracts->find()
						->hydrate(false)
						->select(['id'])
						->where(function ($exp) use($actualDate) {
	                        return $exp
	                        	->lte('date',$actualDate)
	                        	->gte('deadline',$actualDate);
	                    });

	        $id = $id->toArray();

			return $id[0]['id'];
    }
    else{
      return $this->redirect(['controller'=>'pages', 'action'=>'home']);
    }

	}


}
