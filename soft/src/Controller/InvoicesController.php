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


				$response = '0';

				$file = $invoice['file'];
				unset($invoice['file']); //Quitamos los datos del archivo

				if(!empty($file))
				{
					if($this->Upload->save($file))
					{
						$invoice['image_name'] = $file['name'];
						$invoice['association_id']= $this->request->session()->read('Auth.User.association_id');
						$invoice['kind'] = $invoices_type[$this->request->data['kind']];

						if($this->Invoices->save($invoice)) //
						{
							$this->Flash->success('La factura ha sido agregado', ['key' => 'success']);

						}

						$this->Flash->error('Error al agregar la factura', ['key' => 'error']);
					}
				}
			}
				$this->set('data',$invoice);//
		}
	}

	public function modify(){
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else {

			$this->viewBuilder()->layout('associations_view'); //Carga un layout personalizado para esta vista
			$id =$this->request->session()->read('Auth.User.association_id');
			if($id){
	          //$user = $this->Users->get($id);
	          $invoice = $this->Invoices->find()
	                              ->where(['association_id'=>$id]);
	          $invoice= $invoice->toArray();
	          //debug($user);

	          $this->set('invoice',$invoice);
        	}
		}
	}

	public function modifyInvoice($id = null){
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
  			return $this->redirect($this->Auth->redirectUrl());
  		}
	    else{
	    	$this->viewBuilder()->layout('associations_view');
	    	
	    	if($id){
	          $invoice = $this->Invoices->get($id);
	          $invoices_type = array('Tracto'=> 0, 'Ingresos Generados'=> 1, 'Superávit' => 2);

				$options['invoices_type'] = $invoices_type;

	          if($this->request->is(array('post','put'))) {
	         debug($this->request->data);
	            $invoice = $this->Invoices->newEntity($this->request->data);
	            
	            if(!$invoice->errors()) {

	              $query = $this->Invoices->query();
	              $query->update()
	                    ->set(['number'=>$this->request->data['number'], 'amount'=>$this->request->data['amount'],
	                          'kind'=>$invoices_type[$this->request->data['kind']], 'legal_certificate'=>$this->request->data['legal_certificate'],
	                          'provider'=>$this->request->data['provider'], 'date'=> $this->request->data['date'],'attendant'=>$this->request->data['attendant'] ,'detail'=>$this->request->data['detail'],'clarifications'=>$this->request->data['clarifications'],'state'=>0, ])
	                    ->where(['id'=>$id])
	                    ->execute();

	              $this->Flash->success(__('Factura modificada correctamente.', ['key'=>'success']));
	              
	            }
	            else{
	                $this->Flash->error(__('Error al modificar factura.', ['key'=>'error']));
	            }
	          }

	  			}
	  			else {
	  				$this->redirect(['action'=>'/']);
	  			}
	    }
	    $this->set('data', $invoice);
	    $this->set('options', $options);
	}

	public function delete($id = null){
		
		$invoice = $this->Invoices->get($id);
		debug($invoice);
		if(!$this->Invoices->delete($invoice)){
			$response = "0";
		}else{
			if(($this->request->session()->read('Auth.User.role')) == 'rep'){
				return $this->redirect($this->Auth->redirectUrl("/invoices/modify/"));
			}else{
				return $this->redirect($this->Auth->redirectUrl("/invoices/admin-modify/"));
			}
			
		}

	}

	public function adminModify(){
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else {

			 $this->viewBuilder()->layout('admin_views');
        	$this->paginate = [
	            'contain' => ['Associations']
	        ];
	        $invoices = $this->paginate($this->Invoices);

	        $this->set(compact('invoices'));
	        $this->set('_serialize', ['invoices']);
        			}
	}

}
