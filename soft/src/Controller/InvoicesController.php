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

			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

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
						//$invoice['image_name'] = $file['name'];
						$invoice['image_name'] = $invoice['number'];
						$invoice['association_id'] = 1;
						$invoice['kind'] = $invoices_type[$this->request->data['kind']];

						if($this->Invoices->save($invoice))
						{
							$this->Flash->Success('Factura Agregada', ['key' => 'success']);
						}
						else{
							$this->Flash->error('Error al agregar factura.', ['key' => 'error']);
						}
					}
					else{
							$this->Flash->error('Error al subir archivo.', ['key' => 'error']);
					}
				}
				else{
					$this->Flash->error('Adjunte archivo.', ['key' => 'error']);
				}

			}

			$this->set('data',$invoice);
		}
	}

}
