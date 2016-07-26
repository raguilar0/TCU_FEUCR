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
        $this->Auth->allow('logout');
    }





    public function add()
    {

      if($this->Auth->user()){
        $this->viewBuilder()->layout('admin_views');
        $user = $this->Users->newEntity($this->request->data); //El parámetro es

        if($this->request->is('post'))
        {
            $data = $this->request->data;
            if(($this->request->session()->read('Auth.User.role')) == 'admin'){

                if(isset($data['role']) && ($data['role'] !== 'rep' && $data['role'] !== 'admin'))
                {
                    $this->Flash->error(__('Está tratando de ingresar datos inválidos.'));
                    return $this->redirect(['controller'=>'Associations','action' => 'init']);
                }
                elseif($data['role'] === 'admin')
                {
                    $data['association_id'] = NULL;
                }
                elseif (($data['role'] === 'rep') && ($data['association_id'] === ''))
                {
                    $this->Flash->error(__('Debe elegir una asociación.'));
                    return $this->redirect(['action' => 'modify']);
                }
            }
            elseif(($this->request->session()->read('Auth.User.role')) == 'rep')
            {
                $data['association_id'] = $this->request->session()->read('Auth.User.association_id');
                $data['role'] = 'rep';
            }

            $user = $this->Users->newEntity($data);

            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario ha sido agregado');
                return $this->redirect(['action' => 'modify']);
            }
            else{
                $this->Flash->error(__('Error al agregar usuario.'));
            }

        }
          
        $role = array('admin'=>'Administrador', 'rep'=>'Representante');

        $this->set('role', $role);
        $this->set('association', $this->Users->Associations->find('list'));
        $this->set('user', $user);


      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }
    }

    public function modify()
    {
        if ($this->Auth->user()) {
            $this->viewBuilder()->layout('admin_views');



                $this->paginate = [
                    'contain' => ['Associations']
                ];


            if(($this->request->session()->read('Auth.User.role')) == 'rep'){
                $association_id = $this->request->session()->read('Auth.User.association_id');

                $query = $this->Users->find()
                    ->andWhere(['association_id'=>$association_id]);
            }
            elseif (($this->request->session()->read('Auth.User.role')) == 'admin')
            {
                $query = $this->Users;
            }


                $users = $this->paginate($query);

                $this->set(compact('users'));
                $this->set('_serialize', ['users']);

        }
    }

    public function modifyUser($id = null) {
      if($this->Auth->user() && $id){
        $this->viewBuilder()->layout('admin_views');

          try
          {
              $user = $this->Users->get($id);
          }
          catch (RecordNotFoundException $e)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['controller'=>'Associations','action' => 'init']);
          }

          if ($this->request->is(['patch', 'post', 'put']))
          {
              $data = $this->request->data;

              if(isset($data['role']) && ($data['role'] !== 'rep' && $data['role'] !== 'admin'))
              {
                  $this->Flash->error(__('Está tratando de ingresar datos inválidos.'));
                  return $this->redirect(['controller'=>'Associations','action' => 'init']);
              }
              elseif($data['role'] === 'admin')
              {
                  $data['association_id'] = NULL;
              }
              elseif (($data['role'] === 'rep') && ($data['association_id'] === ''))
              {
                  $this->Flash->error(__('Si va a cambiarle el rol a un usuario, deberá elegir una asociación.'));
                  return $this->redirect(['action' => 'modify']);
              }


              $user = $this->Users->patchEntity($user,$data);

              if($this->Users->save($user))
              {
                  $this->Flash->success(__('El usuario se guardó exitosamente.'));
                  return $this->redirect(['action' => 'modify']);
              }
              else
              {
                  $this->Flash->error(__('El usuario no pudo ser guardado. Por favor intente de nuevo'));
              }
          }



          $role['admin'] = 'Administrador';
          $role['rep'] = 'Representante';
          $associations = $this->Users->Associations->find('list')
                                            ->where(['enable'=>1]);

          $this->set(compact('user', 'associations', 'role'));
      }
      else{
        return $this->redirect(['controller'=>'pages', 'action'=>'home']);
      }

    }

    public function delete($id = null)
    {

        try
        {
            $this->viewBuilder()->layout('admin_views');
            $this->request->allowMethod(['post', 'delete']);

            try
            {
                $query = $this->Users->query();
                $query->update()
                    ->set(['state' => 1])
                    ->where(['id' => $id])
                    ->execute();
                $this->Flash->success(__('El usuario se deshabilitó exitosamente.'));
            }
            catch (Exception $e)
            {
                $this->Flash->error(__('El usuario no pudo ser deshabilitado. Por favor intente de nuevo.'));
            }

            return $this->redirect(['action' => 'modify']);
        }
        catch (RecordNotFoundException $e)
        {
            $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
            return $this->redirect(['controller'=>'Associations','action' => 'init']);
        }

    }


    

    public function login()
    {

    if(!$this->Auth->user()){
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {

                if(!$user['state'] && ($this->validateAssociation($user['association_id']) || $user['role'] === 'admin')){
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


        if(in_array($this->request->action,['modifyUser','delete']))
        {
            $userId = (int)$this->request->params['pass'][0];
            if ((($this->request->session()->read('Auth.User.role')) == 'rep') && $this->Users->isOwnedBy($userId, $user['association_id'])) {
                return true;
            }
        }

        if(in_array($this->request->action,['modify', 'logout', 'resetPass', 'perfil', 'add']))
        {
          return true;
        }



        return parent::isAuthorized($user);
    }

}

?>
