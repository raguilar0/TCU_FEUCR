<?php
namespace App\Controller;

use App\Controller\AppController;

class InitialAmountsController extends AppController
{
	

	
	public function add($association_name = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista
		
		
		$headquarters = $this->getHeadquarters(); //Pide todas las sedes
		$tracts[0] = $this->getTracts(date('Y')-1);
		$tracts[1] = $this->getTracts(date('Y'));
		
		$amounts_type = array('Tracto'=> 0, 'Ingresos Generados' => 1);
		
		if($this->request->is("POST"))
		{
			if($association_name)
			{
					/**
					 * 1- Cargar los montos de las cajas del tracto del primer select al tracto del segundo select, esto tanto
					 * para tracto como para ingresos generados. Este monto se carga no solo al monto inicial de la asocia, si no
					 * tambien en las cajas de dicha asocia en los campos correspondientes, es decir los montos de caja chica van
					 * para los montos de la caja chica del siguiente tracto, lo mismo con las cajas fuertes.
					 * 
					 * 2- Crear las cajas. Para poder mover los montos, se deben primero crear las cajas, esto tanto para Ingresos Generados
					 * como para Tracto.
					 */
					
					
			
					
					if($this->request->data['first_tract'] != $this->request->data['second_tract'])
					{
						$association_id = $this->getAssociationId($association_name);
						$first_tract_id = $this->getTractId($this->request->data['first_tract']);
						$second_tract_id = $this->getTractId($this->request->data['second_tract']);
						
						$oldBoxTract = $this->getBox($association_id, $first_tract_id, 0); //Queremos la caja vieja del tracto
						$oldBoxGenerated = $this->getBox($association_id, $first_tract_id, 1); //Queremos la caja vieja de ingresos generados
						
						$message = $this->createBox($oldBoxTract,$association_id, $first_tract_id, $second_tract_id, 0); //Creamos Tractos
						
						$message .= "<br>".$this->createBox($oldBoxGenerated,$association_id, $first_tract_id, $second_tract_id, 1); //Creamos ingresos generados 
						
						//createInitialAmount($this->request->data, $oldBoxTract, $association_id, $tract_id, 0); //Creamos los montos iniciales de tracto
						//createInitialAmount($this->request->data, $oldBoxGenerated, $association_id, $tract_id, 1); //Creamos los montos iniciales de Ingresos Generados
						
						die($message);
						
					}
					else
					{
						die('Las fechas deben ser distintas');	
					}
					
			}
		}
		else
		{
			
		}
		
		$this->set('head',$headquarters);
		$this->set('data', $tracts);
		$this->set('type', $amounts_type);
		
	}
	
	private function createInitialAmount($data, $oldBox, $association_id, $tract_id, $type)
	{
		$array['amount'] = ($oldBox[0]['little_amount'] + $oldBox[0]['big_amount']);
		$array['type'] = $type;
		$array['date'] = $data['date'];
		$array['association_id'] = $association_id;
		$array['tract_id'] = $tract_id;
		
		
		$type_name = ($type == 0 ? "Tracto":"Ingresos Generados");
		$message = "No se pudo guardar el monto inicial correspondiente a ".$type_name;
		
		try
		{
			$initial = $this->InitialAmounts->newEntity($array);
			
			if($this->InitialAmounts->save($initial))
			{
				$message = "Se guardo el monto inicial correspondiente a ".$type_name." con exito";
			}
					
		}
		catch(Exception $e)
		{
			
		}

		return $message;
	}
	
	private function createBox($oldBox,$association_id, $first_tract_id, $second_tract_id, $type)
	{
		
		
		$message = "";
		$type_name = ($type == 0 ? "Tracto":"Ingresos Generados");
		
		if(!empty($oldBox))
		{
			$data['little_amount'] = $oldBox[0]['little_amount'];
			$data['big_amount'] = $oldBox[0]['big_amount'];
			$data['type'] = $type; //Tracto
			$data['association_id'] = $association_id;
			$data['tract_id'] = $second_tract_id;
			
			$this->loadModel('Boxes');
		
		
			try
			{
				$box = $this->Boxes->newEntity($data);		
				
				if($this->Boxes->save($box))
				{
					$message = "Se creo la caja para ".$type_name." exitosamente";
				}
			}
			catch(Exception $e)
			{
				
			}

			
		}
		else
		{
			$message = 'No existe una caja de '.$type_name .' que pertenezca al tracto que inicia en: '.$this->request->data['first_tract'];	
		}
		
		return $message;
	}
	
	private function getBox($association_id, $tract_id, $type)
	{
		$this->loadModel('Boxes');
		
		$box = $this->Boxes->find()
				->hydrate(false)
				->andwhere(['association_id'=>$association_id, 'tract_id'=>$tract_id, 'type'=>$type]);
				
		$box = $box->toArray();
		
		return $box;
	}
	

	
	private function getAssociationId($association_name)
	{
			$association_id = $this->InitialAmounts->Associations->find() //Se busca primero el id de esa sede por medio del nombre
									->hydrate(false)
									->select(['id'])
									->where(['name'=>$association_name]);
									
			$association_id = $association_id->toArray();

			return $association_id[0]['id'];
	}
	
	private function getTracts($year)
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
	private function getTractId($actualDate)
	{
		$this->loadModel('Tracts');
		
		//$actualDate = date("Y-m-d");
		
		$id = $this->Tracts->find()
					->hydrate(false)
					->select(['id'])
					->where(function ($exp) use($actualDate) {
                        return $exp
                        	->lte('date',$actualDate)
                        	->gte('deadline',$actualDate);
                    });
        
        $id = $id->toArray();

		return $id[0]['id'];					
	}


}