<?php
// src/Controller/UsersController.php

namespace App\Controller;

use Cake\ORM\TableRegistry;
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
       if($this->Auth->user()){
         $this->viewBuilder()->layout('admin_views');
         $this->set('users', $this->Users->find('all'));
       }
       else{
         return $this->redirect(['controller'=>'pages', 'action'=>'home']);
       }
    }

    public function view($id)
    {
      if($this->Auth->user()){
        $user = $this->Users->get($id);
        $this->set(compact('user'));
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    public function showUsers($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $this->set('users', $this->Users->find('all'));
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    public function showAssociations($id = null)
  	{
      if($this->Auth->user()){
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
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
  	}

    public function read($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');

          if($id){

            if($this->request->session()->read('Auth.User.role') == 'admin')  {
              $this->loadModel('Associations');
              $association =
              $this->Associations->find()
                                  ->hydrate(false)
                                  ->select(['name'])
                                  ->where(['id'=>$id]);

              $association = $association->toArray();
              //debug($association);


              $user = $this->Users->find()
                                  ->where(['association_id'=>$id]);
              $user = $user->toArray();
            }

          }

          if(($this->request->session()->read('Auth.User.role')) == 'rep'){

            $this->loadModel('Associations');
            $association_id = $this->request->session()->read('Auth.User.association_id');
            $association =
            $this->Associations->find()
                                ->hydrate(false)
                                ->select(['name'])
                                ->where(['id'=>$association_id]);

            $association = $association->toArray();

            $user = $this->Users->find()
                                ->where(['association_id'=>$association_id]);
            $user = $user->toArray();
          }

          $this->set('association', $association);
          $this->set('data',$user);
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }


    public function add()
    {
      //debug($this->Auth->user());
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $user = $this->Users->newEntity($this->request->data); //El parámetro es

        if($this->request->is('post'))
        {
            if(($this->request->session()->read('Auth.User.role')) == 'admin'){

                if($this->request->data['role'] == 'Administrador'){
                    $this->request->data['role'] = 'admin';
                }
                elseif ($this->request->data['role'] == 'Representante'){
                    $this->request->data['role'] = 'rep';
                }


                $role = $this->request->data['role'];
            }
            elseif(($this->request->session()->read('Auth.User.role')) == 'rep')
            {
                $this->request->data['association_id'] = $this->request->session()->read('Auth.User.association_id');
                $this->request->data['role'] = 'rep';
            }

            $user = $this->Users->newEntity($this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario ha sido agregado', ['key' => 'success']);
                //return $this->redirect(['action' => 'add']);
            }
            else{
                $this->Flash->error(__('Error al agregar usuario.', ['key'=>'error']));
            }

        }

        //debug($association_id);
        //debug($role);
        $role = array('Administrador'=> 0, 'Representante' => 1);

        $this->set('role', $role);
        $this->set('association', $this->Users->Associations->find('list'));
        $this->set('user', $user);


      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    public function modify($id = null)
    {
      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');

          if($id){

            if(($this->request->session()->read('Auth.User.role')) == 'admin'){

              $this->loadModel('Associations');
              $association =
              $this->Associations->find()
                                  ->hydrate(false)
                                  ->select(['name'])
                                  ->where(['id'=>$id]);

              $association = $association->toArray();

              //$user = $this->Users->get($id);
              $user = $this->Users->find()
                                  ->where(['association_id'=>$id]);
              $user= $user->toArray();

            }

          }

          if(($this->request->session()->read('Auth.User.role')) == 'rep'){

            $this->loadModel('Associations');
            $association_id = $this->request->session()->read('Auth.User.association_id');
            $association =
            $this->Associations->find()
                                ->hydrate(false)
                                ->select(['name'])
                                ->where(['id'=>$association_id]);

            $association = $association->toArray();

            $user = $this->Users->find()
                                ->where(['association_id'=>$association_id]);
            $user = $user->toArray();
          }

          $this->set('association',$association);
          $this->set('data',$user);

      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    public function modifyUser($id = null) {
      if($this->Auth->user() && $id){
        $this->viewBuilder()->layout('admin_views');

             if($this->request->is(array('post','put'))) {
               if($this->request->data['role'] == 'Administrador'){
                   $this->request->data['role'] = 'admin';
               }
               elseif ($this->request->data['role'] == 'Representante'){
                   $this->request->data['role'] = 'rep';
               }

               $user = $this->Users->newEntity($this->request->data);
                    $blocked = (isset($this->request->data['state']) ? 1 : 0); //Verifica si se checó el checkbox de bloqueado
                    //debug($user->errors());
                    if(!$user->errors()) {
                      $query = $this->Users->query();
                      $query->update()
                            ->set(['username'=>$this->request->data['username'], 'name'=>$this->request->data['name'],
                                  'last_name_1'=>$this->request->data['last_name_1'], 'last_name_2'=>$this->request->data['last_name_2'],
                                  'role'=>$this->request->data['role'], 'state'=>$blocked])
                            ->where(['id'=>$id])
                            ->execute();
                      $this->Flash->success(__('Usuario modificado correctamente.', ['key'=>'success']));
                    }
                    else{
                        $this->Flash->error(__('Error al modificar usuario.'));
                      }
          }
          $user = $this->Users->get($id);
          $this->set('user', $user);

      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    public function delete()
    {
      if($this->Auth->user()){

      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    public function login()
        {

        if(!$this->Auth->user()){
            if ($this->request->is('post')) {

                $user = $this->Auth->identify();
                if ($user) {
                  //debug($this->request->session()->read('Auth.User.state'));
                    if($this->request->session()->read('Auth.User.state') == 0){
                      $this->Auth->setUser($user);
                      return $this->redirect($this->Auth->redirectUrl());
                    }
                    else{
                      $this->Flash->error('Usuario Bloqueado', ['key' => 'error']);
                    }
                }
                else{
                  $this->Flash->error('Usuario o contraseña inválidos. Intente nuevamente.', ['key' => 'error']);

                }
            }
          }
          else{
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
          }

        }

        public function logout()
        {
            return $this->redirect($this->Auth->logout());
        }

        public function perfil() {
          if($this->Auth->user()){
            $this->viewBuilder()->layout('admin_views'); //Se deja este hasta mientras se haga el de representante

            $id =  $this->request->session()->read('Auth.User.id');; // Lo que me dijo Slon
            if($id) {




                if($this->request->is(array('post','put')))
                {


                    try
                    {
                        $query = $this->Users->query();

                        $query->update()
                          ->set(['name'=> $this->request->data['name'],'last_name_1'=>$this->request->data['last_name_1'],'last_name_2'=>$this->request->data['last_name_2']])
                          ->where(['id'=> $id])
                          ->execute();

                        $this->Flash->success('Se modificó el usuario correctamente');

                    }
                    catch(Exception $e)
                    {
                        $this->Flash->error('No se pudo modificar el usuario');
                    }


                }

                $user = $this->Users->get($id);

                $head = $this->Users->Associations->find()
                    ->hydrate(false)
                    ->select(['id','name'])
                    ->where(['id'=>$user->association_id]);

                $head = $head->toArray();

                $user['association'] = $head[0]['name'];
                    $this->set('data',$user); // set() Pasa la variable association a la vista.

            }

          }
          else{
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
          }
      }

      public function resetPassword($id = null){

        if($this->Auth->user()){
          debug($this->Auth);
          //$this->viewBuilder()->layout('admin_views');
          if($id){
            $user = $this->Users->get($id);
            //$user = $this->Users->findByToken($id);
            //debug($user);
            if($this->request->is(array('post','put'))) {
              if(($this->request->session()->read('Auth.User.role')) == 'admin'){
                //$pwtable = TableRegistry::get('Users');
                $repass = $this->request->data['repass'];
                $pw = $this->request->data['new_password'];

                if($pw == $repass){
                  debug($user);
                  debug($this->users);
                  $user->password= $pw;
                  if($this->Users->save($user)){
                    //$this->Users->save($user)
                    $this->Flash->success(__('La contraseña se ha establecido correctamente.', ['key'=>'success']));
                    debug($user);
                  }
                  else{
                    $this->Flash->error(__('Error al cambiar la contraseña.', ['key'=>'error']));
                  }


                  /*
                  if(!$user->errors()) {
                    $query = $this->Users->query();
                    $query->update()
                          ->set(['password'=>$new_password])
                          ->where(['id'=>$id])
                          ->execute();
                    $this->Flash->success(__('La contraseña se ha establecido correctamente.', ['key'=>'success']));
                    debug($user);
                  }
                  else{
                    $this->Flash->error(__('Error al cambiar la contraseña.', ['key'=>'error']));
                  }
                  */
                }
                else{
                  $this->Flash->error(__('Las contraseñas no coinciden.', ['key'=>'error']));
                }
              }

              if(($this->request->session()->read('Auth.User.role')) == 'rep'){
                $pwtable = TableRegistry::get('Users');
                $old_password = $this->request->data['old_password'];
                $new_password = $this->request->data['new_password'];
                $repass = $this->request->data['repass'];

                if( $old_password == $user['password']){      //TODO: COMPARAR PASSWORDS HASHEADOS
                  if($new_password == $repass){
                    if(!$user->errors()) {
                      $query = $this->Users->query();
                      $query->update()
                            ->set(['password'=>$new_password])
                            ->where(['id'=>$id])
                            ->execute();
                      $this->Flash->success(__('La contraseña se ha establecido correctamente.', ['key'=>'success']));
                      debug($user);
                    }
                    else{
                      $this->Flash->error(__('Error al cambiar la contraseña.', ['key'=>'error']));
                    }
                  }
                  else{
                    $this->Flash->error(__('Las contraseñas no coinciden.', ['key'=>'error']));
                  }
                }
                else{
                  $this->Flash->error(__('La contraseña no coincide con la actual.', ['key'=>'error']));
                }
              }

            }
            $this->set('user', $user);
          }
        }
        else{
          return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }

      }

/*
    public function addUser()
    {
      if(($this->request->session()->read('Auth.User.role')) != 'rep'){
  			return $this->redirect($this->Auth->redirectUrl());
  		}
      else{
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

        }
      }
    }
    */

    public function isAuthorized($user)
    {

        if(in_array($this->request->action,['read','logout']))
        {
          return true;
        }



        return parent::isAuthorized($user);
    }

}

?>
