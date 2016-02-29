<?php
namespace App\Controller;

use App\Controller\AppController;

class AssociationsController extends AppController
{
	public function add()
	{
		$association = $this->Associations->newEntity($this->request->data);

		if($this->request->is('post'))
		{

			if($this->Associations->save($association))
			{
				$this->Flash->success(__('La Asociación ha sido guardada exitosamente'));
                return $this->redirect(['action' => 'index']);
			}

			$this->Flash->error(__('No es posible guardar la asociación en este momento'));
		}

		$this->set('association',$association);
	}
}