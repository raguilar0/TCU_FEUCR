<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class HeadquartersController extends AppController
{


	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

	}
	
	
	public function add()
	{
		$headquarter = $this->Headquarters->newEntity($this->request->data); //El parámetro es para validar los datos
		
		$response = "0";
		
		if($this->request->is('post'))
		{
			if(!$this->Headquarters->save($headquarter)) //Guarda los datos
			{
				$response = "1";
				
			}

			die($response);

		}
		

	}


public function getInformation()
{

	
	if($this->request->is(array('post','put')))
	{

		$session = $this->request->session(); //Creamos una variable de session para guardar el id de la sede antigua, en caso de que haya que modificarla


		$headquarter = $this->Headquarters->find()
						->hydrate(false)
						-> select(['id','name', 'image_name']) //Realiza la consulta
						-> where(["name" => $this->request->data['headquarter_id']]);
						

		$headquarter = $headquarter->toArray();

		$session->write('id_headquarter', $headquarter[0]['id']);
		$data = $headquarter[0]['image_name'].",".$headquarter[0]['name'];
		die($data);
	}

}






public function modifyHeadquarter()
{	
	$response = "0";
	
	if($this->request->is(array('post','put')))
	{
		$headquarter_id = $this->request->session()->read('id_headquarter'); //Recupera el id de la variable de sessión
		$headquarter = $this->Headquarters->get($headquarter_id); //Recupera la sede con ese id

		if($headquarter['name'] == $this->request->data['name']) //Si el usuario no modificó el nombre de la sede
		{
			$query = $this->Headquarters->query();

			$query->update()
				  ->set(['image_name' => $this->request->data['image_name']])
				  ->where(['id'=>$headquarter_id])
				  ->execute();

			$response = "1";
		}
		else //Si modificó el nombre de la sede, hay que validar que siga siendo válido
		{
			$validator = $this->Headquarters->newEntity($this->request->data);
	
			if(!$validator->errors())
			{
				$headquarter->name = $this->request->data['name'];
				$headquarter->image_name = $this->request->data['image_name'];
				
				if($this->Headquarters->save($headquarter))
				{
					$response = "1";
				}	
			}
		}
	}


	die($response);
}


public function deleteHeadquarter()
{

	$response = "1";
	$headquarter = $this->Headquarters->get($this->request->session()->read('id_headquarter'));

	if(!$this->Headquarters->delete($headquarter))
	{
		$response = "0";
	}
	
	die($response);

}


}
