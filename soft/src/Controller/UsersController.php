<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add', 'logout');
    }

     public function index()
     {

       $this->viewBuilder()->layout('admin_views');
        $this->set('users', $this->Users->find('all'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function showUsers($id = null)
    {
      $this->viewBuilder()->layout('admin_views');
      $this->set('users', $this->Users->find('all'));

    }

    public function showAssociations($id = null)
  	{
      $this->loadModel('Associations');
      $this->loadModel('Headquarters');

  		if($id)
  		{
  			$this->viewBuilder()->layout('admin_views');


  			$query = $this->Associations->Headquarters->find()
  					->hydrate(false)
  					->select(['a.name','a.id','name'])
  					->join([
  						 'table'=>'associations',
  						 'alias'=>'a',
  						 'type' => 'RIGHT',
  						 'conditions'=>'Headquarters.id = a.headquarter_id',
  						])
  					->where(['a.enable'=>1]);

  			$query = $query->toArray();

  			switch ($id) {
  					case 1:
  							$query['link'] = 'read';
  						break;

  					case 3:
  							$query['link'] = 'modify';
  						break;

  					case 4:
  							$query['link'] = 'delete';
  						break;
  			}

  			$this->set('data',$query);

  		}
  	}

    public function read($id)
    {
      $role = $this->request->session()->read('Auth.User.role');
      debug($this->request->session()->read('Auth.User.role'));

        $this->viewBuilder()->layout('admin_views');
        $user = $this->Users->find()
        ->where(['association_id'=>$id]);
        $this->set('data',$user);
    }


    public function add()
    {
        $user = $this->Users->newEntity();
        $this->loadModel('Associations');

        $role = array('Administrador'=> 0, 'Representante' => 1);

        if ($this->request->is('post')) {

          $association_id =
          $this->Users->Associations->find()
                                    ->hydrate(false)
                                    ->select(['id'])
                                    ->where(['name'=>$this->request->data['association_id']]);

          $association_id = $association_id->toArray();

          $this->request->data['association_id'] = $association_id[0]['id'];
/*
          $role = $this->request->data['role'];

          debug($role);

          if($this->request->data['role'] == 'Administrador'){
              $this->request->data['role'] = 'admin';
          }
          if($this->request->data['role'] == 'Representante'){
              $this->request->data['role'] = 'rep';
          }

          debug($this->request->data['role']);
*/
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
              debug($this->request->data);
                $this->Flash->success(__('El usuario ha sido agregado.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Error al agregar usuario.'));
        }

        $association = $this->Associations->find();

        $this->set('role', $role);
        $this->set('association', $association);
        $this->set('user', $user);
    }

    public function modify($id)
    {
      $this->viewBuilder()->layout('admin_views');
      if($id){

        $user = $this->Users->find()
                            ->where(['association_id'=>$id]);
        $this->set('user',$user);
      }




    }

    public function delete()
    {

    }

    public function login()
        {
          $this->viewBuilder()->layout('admin_views');
        //  $user = $this->Users->find();
        //  $this->set('user', $user);
            if ($this->request->is('post')) {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);

                    if(($this->request->session()->read('Auth.User.role')) == 'admin'){
                    return $this->redirect($this->Auth->redirectUrl("/associations/"));
                  }
                  else{
                    //return $this->redirect($this->Auth->redirectUrl("//"));
                  }
                }
                $this->Flash->error(__('Nombre de usuario o contraseña invalidos, intentelo de nuevo.'));
            }

        }

        public function logout()
        {
            return $this->redirect($this->Auth->logout());
        }

        public function perfil($id = null) {
        $this->viewBuilder()->layout('associations_view'); //Se deja este hasta mientras se haga el de representante

        $id =  $this->request->session()->read('Auth.User.id');; // Lo que me dijo Slon
        if($id) {
            $user = $this->Users->get($id);

            $head = $this->Users->Associations->find()
                            ->hydrate(false)
                            ->select(['id','name'])
                            ->where(['id'=>$user->association_id]);

            $head = $head->toArray();

            $user['association'] = $head[0]['name'];



            if($this->request->is(array('post','put'))) 
            {
                $response = '0';

                try
                {
                    $query = $this->Users->query();
    
                    $query->update()
                      ->set(['name'=> $this->request->data['name'],'last_name_1'=>$this->request->data['last_name_1'],'last_name_2'=>$this->request->data['last_name_2']])
                      ->where(['id'=> $id])
                      ->execute();  
                      
                    $response = '1';
                }
                catch(Exception $e)
                {

                }

                die($response);

            }
            else
            {
                $this->set('data',$user); // set() Pasa la variable association a la vista.
            }
        }       
    }

    public function addUser()
    {
        $associations_id = $this->request->session()->read('Auth.User.association_id');
        $this->viewBuilder()->layout('associations_view'); //Carga un layout personalizado para esta vista

        $user = $this->Users->newEntity($this->request->data); //El parámetro es para validar los datos


        if($this->request->is('post'))
        {

            
            $response = "0,0"; //Funciona como booleano, para decidir qué mostrar en el ajax.
            
            $this->loadModel('Headquarters'); //Carga el modelo de esta asociación
            $headquarter = $this->Headquarters->find()
                            ->hydrate(false)
                            -> select(['id']) //Realiza la consulta
                            -> where(["name = '".$this->request->data['headquarter_id']."'"]); //Obtiene el id donde la sede  elegida por el usuario

            $headquarter = $headquarter->toArray();

            $association['headquarter_id'] = $headquarter[0]['id']; //Reemplaza la elección del usuario por el id 

            if($this->Users->save($user)) //Guarda los date_offset_get()
            {
                $response = "1,0";

                $query = $this->Users->find();

                $query->hydrate(false);
                $query->select(['max_id' => $query->func()->max('id')]);

                $query = $query->toArray();


                $this->request->data['spent'] = 0;
                $this->request->data['user_id'] = $query[0]['max_id'];


                $amounts = $this->Users->Amounts->newEntity($this->request->data);

                if($this->Users->Amounts->save($amounts))
                {
                    $response = "1,1";
                }
            }

            
            die($response);

            
        }
        else
        {
            //Hago esta operación en el else, porque no me interesa cargarlo cuando voy a guardar los datos

            $this->loadModel('Headquarters'); //Carga el modelo de esta asociación

            $headquarter = $this->Headquarters->find()
                            -> select(['name']); //Realiza la consulta

            $headquarter->hydrate(false); //Quita elementos inncesarios
            $headquarter = $headquarter->toArray(); //Convierte el resultado a un array



            $association['headquarter'] = $headquarter; //Lo asocia

            /**
                El siguiente código que asocia un date a $association
                corrige el hecho de que una persona tenga que poner la fecha de inicio de tracto cada vez. Existen dos casos:

                1) La primera vez: La primera vez no existen montos asociados a ninguna asociación, por lo que se toma la fecha actual.

                2) Una vez que existan montos asociados: Cuando ya hay montos asociados, se toma como fecha de tracto actual al último monto asociado
            **/
/*
            $date = $this->Users->Amounts->find()
                            ->hydrate(false)
                            ->select(['date', 'deadline'])
                            ->order(['id'=>'DESC'])
                            ->limit(1);

            $date = $date->toArray();


            if(!isset($date[0]))
            {
                $date['date'] = $date['deadline'] = date('Y-m-d');
            }
            else
            {
                $date = $date[0];
            }

            $user['date'] = $date;


        }

            $this->set('user',$user); // set() Pasa la variable association a la vista.*/
        }
    }


}

?>
