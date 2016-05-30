<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class BoxesController extends AppController
{
	public function modify()
	{
		$this->viewBuilder()->layout('associations_view'); //Carga un layout personalizado para esta vista

		$box = $this->Boxes->find()
					->select(['little_amount','big_amount'])
					->where(['association_id'=>1]);

		$box = $box->toArray();


		if($this->request->is(array('post','put')))
		{	
			if($box != [])
			{
				$query = $this->Boxes->query();
				$query->update()
					  ->set(['big_amount'=> $this->request->data['big_amount'], 'little_amount'=>$this->request->data['little_amount']])
					  ->where(['id'=> 1])
					  ->execute();
			}
			else
			{
				$this->add($this->request->data);
			}
		}
		else
		{
			$this->set('data',$box);
		}
	}



	private function add($data)
	{
		$boxes = $this->Boxes->newEntity($data); 
		$response = 0;
		$boxes['association_id'] = 1;
		if($this->Boxes->save($boxes)) //Guarda los date_offset_get()
		{
			$response = 1;
		}

	}
}