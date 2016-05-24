<?php
namespace App\Controller;

use App\Controller\AppController;

class InitialAmountsController extends AppController
{
	

	
	public function add($association_name = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		
		
		$headquarters = $this->getHeadquarters(); //Pide todas las sedes
		$tracts = $this->getTracts(date('Y'));
		
		if($this->request->is("POST"))
		{
			if($association_name)
			{
				//TODO: Crear las cajas y agregar los montos de las cajas anteriores y en la vista filtrar por año
			}
		}
		else
		{
			
		}
		
		$this->set('head',$headquarters);
		$this->set('data', $tracts);
		
	}
	
	public function getTracts($year)
	{
		$this->loadModel('Tracts');

		$tracts = $this->Tracts->find()
					->hydrate(false)
					->where(['YEAR(date)'=>$year]); //Queremos los tractos del año actual
		$tracts = $tracts->toArray();
		
		return $tracts;
	}
	
	private function getHeadquarters()
	{
		$query = $this->InitialAmounts->Associations->Headquarters->find() //Se trae solo las sedes que tienen alguna asocicación asociada :p
		->hydrate(false)
		->select(['Headquarters.name'])
		->join([
			 'table'=>'associations',
			 'alias'=>'a',
			 'type' => 'RIGHT',
			 'conditions'=>'Headquarters.id = a.headquarter_id',
			])
		->where(['a.enable'=>1])
		->group(['Headquarters.name']); //Elimina repetidos


		$headquarters = $query->toArray();
		
		return $headquarters;
	}





/**
 *  Esta funcion devuelve el id del presente tracto 
 **/
	private function getTractId()
	{
		$this->loadModel('Tracts');
		
		$actualDate = date("Y-m-d");
		
		$id = $this->Tracts->find()
					->hydrate(false)
					->select(['id'])
					->where(['YEAR(date)'=>date('Y')])
					->where(function ($exp) use($actualDate) {
                        return $exp
                        	->lte('date',$actualDate)
                        	->gte('deadline',$actualDate);
                    });
        
        $id = $id->toArray();

		return $id[0]['id'];					
	}


}