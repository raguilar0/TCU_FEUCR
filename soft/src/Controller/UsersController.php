<?php
// src/Controller/UsersController.php

namespace App\Controller;


use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;

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

    /**
    public function view($id)
    {
      if($this->Auth->user()){
          try
          {
              $user = $this->Users->get($id);
              $this->set(compact('user'));
          }
          catch (RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }

      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }
**/
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
                $this->Flash->success('El usuario ha sido agregado');
                //return $this->redirect(['action' => 'add']);
            }
            else{
                $this->Flash->error(__('Error al agregar usuario.'));
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
                      $this->Flash->success(__('Usuario modificado correctamente.'));
                    }
                    else{
                        $this->Flash->error(__('Error al modificar usuario.'));
                      }
          }

          try
          {
             $user = $this->Users->get($id);
          }
          catch(RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['controller'=>'Associations','action' => 'init']);
          }

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
                if(!$user['state'] && $this->validateAssociation($user['association_id'])){
                  $this->Auth->setUser($user);
                  return $this->redirect($this->Auth->redirectUrl());
                }
                else{
                  $this->Flash->error('Usuario o contraseña inválidos. Intente nuevamente.');
                }
            }
            else{
              $this->Flash->error('Usuario o contraseña inválidos. Intente nuevamente.');

            }
        }
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    public function validateAssociation($association_id)
    {
        $query = $this->Users->Associations->find()
                            ->hydrate(false)
                            ->select(['enable'])
                            ->where(['id'=>$association_id]);

        $query = $query->toArray();

        return $query[0]['enable'];
    }


        public function logout()
        {
            return $this->redirect($this->Auth->logout());
        }

        public function perfil() {
          if($this->Auth->user()){
            $this->viewBuilder()->layout('admin_views'); //Se deja este hasta mientras se haga el de representante

            $id =  $this->request->session()->read('Auth.User.id'); // Lo que me dijo Slon
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

                try
                {
                  $user = $this->Users->get($id);
                }
                catch(RecordNotFoundException $e)
                {
                    $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                    return $this->redirect(['controller'=>'Associations','action' => 'init']);
                }


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

      public function resetPassword($id = null)
      {
        $this->viewBuilder()->layout('admin_views');

        if($id)
        {

            if($id == $this->request->session()->read('Auth.User.id')) //Si el usuario al que estoy tratando de editar, soy yo mismo, use esta otra vista
            {
                return $this->redirect(['action' => 'resetPass']);
            }

            try
            {
                $user = $this->Users->get($id);

            }
            catch (RecordNotFoundException $e)
            {
                $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
                return $this->redirect(['controller'=>'Associations','action' => 'init']);
            }


          if($this->request->is(array('post','put')))
          {

              $user = $this->Users->patchEntity($user, $this->request->data,
                  ['validate' => 'changePassword']
              );

              if ($this->Users->save($user)) {
                  $this->Flash->success('La contraseña se cambió exitosamente');

              }
              else {
                  $this->Flash->error('Hubo un error mientras se intentaba cambiar la contraseña');
              }


          }

          $this->set('id', $id);
          $this->set('user',$user);

        }
        else
        {
            return $this->redirect(['controller'=>'pages', 'action'=>'home']);
        }


      }

      public function resetPass()
      {
          $this->viewBuilder()->layout('admin_views');

        try
        {
            $user = $this->Users->get($this->request->session()->read('Auth.User.id')); // Lo que me dijo Slon);
        }
        catch (RecordNotFoundException $e)
        {
            $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
            return $this->redirect(['controller'=>'Associations','action' => 'init']);
        }



        if($this->request->is(array('post','put')))
        {
            $user = $this->Users->patchEntity($user, [
                    'old_password'  => $this->request->data['old_password'],
                    'password'      => $this->request->data['password'],
                    'repass'     => $this->request->data['repass']
                ],
                ['validate' => 'changePass']
            );
            if ($this->Users->save($user)) {
                $this->Flash->success('La contraseña se cambió exitosamente');

            } else {
                $this->Flash->error('No se pudo guardar la contraseña.');
            }

            //return $this->redirect(['controller'=>'users', 'action'=>'modify']);
        }
        $this->set('user',$user);



      }

    public function isAuthorized($user)
    {

        if(in_array($this->request->action,['modify', 'modifyUser', 'logout', 'resetPass', 'perfil']))
        {
          return true;
        }



        return parent::isAuthorized($user);
    }

}

?>
