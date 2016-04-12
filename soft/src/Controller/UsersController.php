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

    public function read()
    {

    }

    public function modify()
    {

    }

    public function delete()
    {

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

    public function login()
        {
          $this->viewBuilder()->layout('admin_views');

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
