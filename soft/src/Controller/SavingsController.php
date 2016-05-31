<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class SavingsController extends AppController
{

	public function add($id = null)
	{
		$saving = $this->Savings->newEntity($this->request->data);
		
		if($id)
		{
			
		}
		else
		{
			$this->redirect(['action'=>'/']);
		}
	}
}
