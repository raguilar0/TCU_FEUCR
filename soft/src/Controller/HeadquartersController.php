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

				debug($this->request->data);

		if($this->request->is('post'))
		{


			if($this->Headquarters->save($headquarter)) //Guarda los datos
			{
				die('1');
			}
			else
			{
				die('0');
			}


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
		else
		{
			return "0";
		}
	}






public function modifyHeadquarter()
	{	
		$headquarter = $this->Headquarters->get($this->request->session()->read('id_headquarter'));

		$headquarter->name = $this->request->data['name'];
		$headquarter->image_name = $this->request->data['image_name'];

		if($this->Headquarters->save($headquarter))
		{
			die("1");
		}

	}

//TODO:Desplegarle al usuario el error 500 u otro para que sepa qué hacer (Se da por no action de la base)
	public function deleteHeadquarter()
	{

		$headquarter = $this->Headquarters->get($this->request->session()->read('id_headquarter'));

		if($this->Headquarters->delete($headquarter))
		{
			die("1");
		}
		else
		{
			die("0");
		}
		

	}

//TODO:implementar el eliminar y el modificar
	public function verify()
	{
		if($this->request->is(array('post','put')))
		{
			if($this->request->data['delete'] == 'Eliminar')
			{
				deleteHeadquarte();
				die('1');
			}
			else
			{
				$this->modifyHeadquarter($this->request->data);
				die('1');
			}

			debug($this->request->data['delete'] == 'Eliminar');
		}

	}









}
