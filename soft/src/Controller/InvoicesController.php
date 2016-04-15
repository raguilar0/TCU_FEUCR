<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class InvoicesController extends AppController
{
	public function add()
	{
		$this->viewBuilder()->layout('associations_view'); //Carga un layout personalizado para esta vista

		$invoice = $this->Invoices->newEntity($this->request->data); //El parámetro es para validar los datos


		$invoices_type = array('Tracto'=> 0, 'Ingresos Generados'=> 1, 'Superávit' => 2);

		$invoice['invoices_type'] = $invoices_type;


		if($this->request->is('post'))
		{
			$response = '0';

			$invoice['image_name'] = 'prueba';
			$invoice['association_id'] = 1;
			$invoice['kind'] = $invoices_type[$this->request->data['kind']];

			if($this->Invoices->save($invoice)) //
			{
				$response = '1';
			}

			die($response);
		}
		else
		{
			$this->set('data',$invoice);
		}
	}
}
