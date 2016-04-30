<?php
App::uses('AppController', 'Controller');

class CardUserController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    var $uses = array('CardUser', 'Debitcard', 'Creditcard','User');


    public function index()
    {
        $user =  $this->Session->read("Auth.User.id");

        $this->set('name',$this->User->field('name',array('id'=> $user)));
        $this->set('lastname',$this->User->field('lastname',array('id'=> $user)));

        $this->set('CardUserList',$this->CardUser->find('all'));


    }

    public function delete_debit($id = null)
    {
        $this->Debitcard->id = $id;
        $cardId = $this->Debitcard->id;
        $card = $this->CardUser->field('id', array('card_id' => $cardId));
        if (!$this->Debitcard->exists())
        {
            throw new NotFoundException(__('Tarjeta de débito inexistente'));
        }
        if ($this->CardUser->delete(array('id'=> $card, 'user_id'=>$this->User->id, 'card_type' => 1)))
        {
            $this->Session->setFlash(__('Tarjeta de débito borrada'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
        else
        {
            $this->Session->setFlash(__('La tarjeta de débito no pudo eliminarse, intente de nuevo'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
    }

    public function delete_credit($id = null)
    {
        $this->Creditcard->id = $id;
        $cardId = $this->Creditcard->id;
        $card = $this->CardUser->field('id', array('card_id' => $cardId));
        if (!$this->Creditcard->exists())
        {
            throw new NotFoundException(__('Tarjeta de crédito inexistente'));
        }
        if ($this->CardUser->delete(array('id'=> $card, 'user_id'=>$this->User->id, 'card_type' => 2)))
        {
            $this->Session->setFlash(__('Tarjeta de crédito borrada'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
        else
        {
            $this->Session->setFlash(__('La tarjeta de crédito no pudo eliminarse, intente de nuevo'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
    }
}
?>