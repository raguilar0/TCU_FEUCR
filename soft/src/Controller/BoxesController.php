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
					->select(['amount'])
					->andwhere(['id'=>1,'association_id'=>1]);

		$box = $box->toArray();

		$data['little'] = $box;

		$box = $this->Boxes->find()
					->select(['amount'])
					->andwhere(['id'=>2,'association_id'=>2]);

		$box = $box->toArray();

		$data['big'] = $box;

		if($this->request->is(array('post','put')))
		{

		}
		else
		{
			$this->set('data',$data);
		}
	}
}