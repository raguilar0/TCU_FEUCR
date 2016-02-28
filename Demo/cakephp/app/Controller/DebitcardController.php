<?php

App::uses('AppController', 'Controller');
class DebitcardController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    var $uses = array('User', 'Debitcard', 'CardUser');

    public function index()
    {
        $user =  $this->Session->read("Auth.User.id");
        $debcard =  $this->Debitcard->CardUser->field('card_id', array('user_id ' => $user));
		
		$this->set('name',$this->User->field('name',array('id'=> $user)));
        $this->set('lastname',$this->User->field('lastname',array('id'=> $user)));

        $this->set('data', $this->Debitcard->find('all',array('conditions' => array('Debitcard.id'=> $debcard))));
    }

    public function add()
    {
        if($this->Session->read("Auth.User.role") == 'admin')
        {
            if ($this->request->is('post'))
            {
                $this->Debitcard->create();
                if ($this->Debitcard->save($this->request->data))
                {
                    $this->Session->setFlash(__('La tarjeta ha sido creada'));
                    return $this->redirect(array('controller' => 'products', 'action' => 'index'));
                }
                $this->Session->setFlash(__('La tarjeta no ha podido ser creada'));
            }
        }
        else
        {
            $this->Session->setFlash(__('Acceso no permitido.'));
            return $this->redirect(array('controller' => 'products', 'action' => 'index'));
        }
    }

    public function register()
    {
        $user =  $this->Session->read("Auth.User.id");
        if ($this->request->is('post'))
        {
            $cardnumber = $this->request->data['Debitcard']['card_number'];
            $cardcsc = $this->request->data['Debitcard']['csc'];
            $card = $this->Debitcard->findByCardNumber($cardnumber);
            $card_type = 1;

            if(($cardnumber == $card['Debitcard']['card_number']) && ($cardcsc == $card['Debitcard']['csc']))
            {
                $this->Debitcard->CardUser->saveAll(['user_id'=>$user, 'card_id'=>$card['Debitcard']['id'], 'card_type'=> $card_type]);
                $this->Session->setFlash(__('Se ha registrado su tarjeta'));
                return $this->redirect(array('controller' => 'products', 'action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('No se ha podido registrado su tarjeta, intente de nuevo'));
            }
        }
    }
}
?>