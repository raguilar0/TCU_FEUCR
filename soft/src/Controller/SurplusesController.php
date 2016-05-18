<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class SurplusesController extends AppController
{


	public function add($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$surplus = $this->Surpluses->newEntity($this->request->data); 

		if($this->request->is("POST"))
		{
			if($id)
			{
				//$surplus = $this->Surpluses->patchEntity($surplus, $this->request->data);
				try
                {
                	$surplus['association_id'] = $id;

                    if ($this->Surpluses->save($surplus))
                    {
                        $this->Flash->success('Se agregó el monto exitosamente', ['key' => 'addSurplus']);
                        return $this->redirect(['controller' => 'Surpluses','action' => 'add/'.$id]);
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


	public function showAssociations($id = null)
	{
		if($id)
		{
			$this->viewBuilder()->layout('admin_views');
			

			$query = $this->Surpluses->Associations->Headquarters->find()
					->hydrate(false)
					->select(['a.name','a.id','name'])
					->join([
						 'table'=>'associations',
						 'alias'=>'a',
						 'type' => 'RIGHT',
						 'conditions'=>'Headquarters.id = a.headquarter_id',
						])
					->where(['a.enable'=>1])
					->order(['Headquarters.name']);


			$query = $query->toArray();

		

			switch ($id) {
					case 1:
							$query['link'] = 'add';
						break;
						
			}

			$this->set('data',$query);

		}
		else
		{
			$this->redirect(['action'=>'/']);
		}
	}

}
