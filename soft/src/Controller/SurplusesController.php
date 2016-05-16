<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class SurplusesController extends AppController
{


	public function add($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$surplus = $this->Surpluses->newEntity(); 

		if($this->request->is("GET"))
		{
			if($id)
			{
				$surplus = $this->Surpluses->patchEntity($surplus, $this->request->data);
				try
                {
                    if ($this->Surpluses->save($surplus))
                    {
                        $this->Flash->success('Se agregó el monto exitosamente', ['key' => 'addSurplus']);
                        return $this->redirect(['controller' => 'Surpluses','action' => 'add']);
                    }
                }
                catch(Exception $ex)
                {
                    $this->Flash->error(__('No se ha podido procesar su solicitud'), ['key' => 'addSurplus']);
                }
			}
		}

		$this->set('surplus',$surplus);	
	}




}
