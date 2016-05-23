$this->loadModel('Tracts');

		$date = $this->Tracts->find() //Se trae el ultimo tracto
						->hydrate(false)
						->select(['date', 'deadline','id', 'number'])
						->order(['id'=>'DESC'])
						->limit(1);

		$date = $date->toArray();
		
		$amounts_type = array('Tracto'=> 0, 'Superávit' => 2);
		$amount = $this->Amounts->newEntity($this->request->data); //El parámetro es para validar los datos

			if($this->request->is('post'))
			{

				$little_amount = 0;
				$big_amount = 0;
				$type = $amounts_type[$this->request->data['type']];
				$tract_id = $date[0]['id'];
				

				if(($date[0]['id'] > 1) && ($date[0]['number'] < 4) && ($type == 0)) //TODO: Agregar acá el ahorro del período anterior
				{
					$this->loadModel('Boxes');

					$last_amount = $this->Boxes->find()
									->hydrate(false)
									->select(['little_amount', 'big_amount'])
									->andwhere(['tract_id'=>($date[0]['id'] - 1), 'association_id'=>$id, 'type'=>$amounts_type[$this->request->data['type']]]);

					$last_amount = $last_amount->toArray();

					$total = ($last_amount[0]['little_amount'] + $last_amount[0]['big_amount']);

					if($this->createInitialAmounts($total, $tract_id, $id, $type))
					{

					}

					//*****************Seteamos los variables con los valores correspondientes ***///////

					$little_amount = $last_amount[0]['little_amount'];
					$big_amount = $last_amount[0]['big_amount'];


				}	
				

				//*****************Guardamos la caja del período actual ***///////

				if(($type == 0) && $this->createBoxes($little_amount, $big_amount, $tract_id,$id,$type))
				{

				}



				$response = 0;
				
				$amount['association_id'] = $id;
				$amount['tract_id'] = $date[0]['id'];
				$amount['type'] = $amounts_type[$this->request->data['type']];

					if($this->Amounts->save($amount)) //Guarda los datos
					{
						$response = '1';
					}

				die($response);
			}

			else
			{
		
		
						
	/********************* Get Headquarters ****************************************/
	
				$query = $this->Amounts->Associations->Headquarters->find() //Se trae solo las sedes que tienen alguna asocicación asociada :p
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
	
	
	/************************ End Get Headquarters**********************************/
				
			
				
	
				

		
				$amount['amounts_type'] = $amounts_type;
				
				$amount['date'] = $date;	
				
				$this->set('amount',$amount);
				$this->set('head',$headquarters);
			}