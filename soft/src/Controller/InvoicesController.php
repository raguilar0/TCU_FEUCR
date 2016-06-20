<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class InvoicesController extends AppController
{
	public function add()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else {

			$this->viewBuilder()->layout('associations_view'); //Carga un layout personalizado para esta vista

			$invoice = $this->Invoices->newEntity($this->request->data); //El parámetro es para validar los datos


			$invoices_type = array('Tracto'=> 0, 'Ingresos Generados'=> 1, 'Superávit' => 2);

			$invoice['invoices_type'] = $invoices_type;


			if($this->request->is('post'))
			{
				$this->loadComponent('Upload');



				$file = $invoice['file'];
				unset($invoice['file']); //Quitamos los datos del archivo

				if(!empty($file))
				{
					if($this->Upload->save($file))
					{
						$date = date_create();
						
						$invoice['image_name'] = $file['name']."_".date_timestamp_get($date);
						$invoice['association_id'] = 1; //TODO: cambiar este dato a un dato real
						$invoice['kind'] = $invoices_type[$this->request->data['kind']];
						$invoice['tract_id'] = $this->getTractId(date("Y-m-d"));

						if($this->Invoices->save($invoice)) //
						{
							$this->Flash->success('La factura ha sido agregado', ['key' => 'success']);

						}
						else {
							$this->Flash->error('Error al agregar la factura', ['key' => 'error']);
						}

						
					}
				}
			}
				$this->set('data',$invoice);//
		}
	}
	
	
	/**
	*  Esta funcion devuelve el id del presente tracto
	**/
	private function getTractId($actualDate)
	{
		$this->loadModel('Tracts');


		$id = $this->Tracts->find()
					->hydrate(false)
					->select(['id'])
					->where(function ($exp) use($actualDate) {
                        return $exp
                        	->lte('date',$actualDate) //<= date <= fecha actual
                        	->gte('deadline',$actualDate); //deadline >= fecha actual
                    });

        $id = $id->toArray();

		return $id[0]['id'];
	}

}
