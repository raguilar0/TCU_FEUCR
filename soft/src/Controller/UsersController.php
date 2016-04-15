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

            case 2:
                $query['link'] = 'add';
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

    public function read()
    {
      $this->viewBuilder()->layout('admin_views');
      $user = $this->Users->find();
      $this->set('data',$user);

    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido agregado.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Error al agregar usuario.'));
        }
        $this->set('user', $user);
    }

    public function modify()
    {

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
