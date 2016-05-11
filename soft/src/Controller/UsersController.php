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

          $role = $this->request->data['role'];

          debug($role);

          if($this->request->data['role'] == 'Administrador'){
              $this->request->data['role'] = 'admin';
          }
          if($this->request->data['role'] == 'Representante'){
              $this->request->data['role'] = 'rep';
          }

          debug($this->request->data['role']);

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
                    return $this->redirect($this->Auth->redirectUrl("/associations/"));
                }
                $this->Flash->error(__('Nombre de usuario o contraseña invalidos, intentelo de nuevo.'));
            }

        }

        public function logout()
        {
            return $this->redirect($this->Auth->logout());
        }
}

?>
