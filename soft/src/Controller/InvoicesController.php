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


		$invoices_type = array(0=>'Tracto', 1=>'Ingresos Generados',2 =>'Superávit');

		$invoice['invoices_type'] = $invoices_type;

		if($this->request->is('post'))
		{

		}
		else
		{
			$this->set('data',$invoice);
		}
	}
}
