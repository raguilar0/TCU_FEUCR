<?php

App::uses('AppController', 'Controller');
class BillingAddressController extends AppController {

    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    var $uses = array('User', 'Country', 'BillingAddress', 'baddressUser');

    public function index()
    {
        $this->set('data',$this->BillingAddress->find('all'));
    }

    public function add()
    {
        $id = $this->Session->read("Auth.User.id");
        $address = $this->BillingAddress->BaddressUser->find("first", array('conditions' => array('user_id' => $id)));
        $this->set('countries', $this->Country->find('list', array('fields' => array('Country.country_name'))));
        if($address != null)
        {
            $this->Session->setFlash(__('No puede agregarse otra dirección de facturación a su nombre.'));
            return $this->redirect(array('controller' => 'products', 'action' => 'index'));
        }
        if(($this->Session->read("Auth.User.role") == 'admin')||($this->Session->read("Auth.User.role") == 'cust'))
        {
            if ($this->request->is('post'))
            {
                $this->BillingAddress->create();
                $user = $this->Session->read("Auth.User.id");

                if($this->BillingAddress->save($this->request->data))
                {
                    $address_id = $this->BillingAddress->getLastInsertID();
                    $this->BillingAddress->BaddressUser->saveAll(['address_id' => $address_id, 'user_id'=>$user]);
                    $this->Session->setFlash(__('Se ha registrado la dirección de facturación'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
                }
                $this->Session->setFlash(__('No se ha podido registrar la dirección de facturación'));
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
            }
        }
        else
        {
            $this->Session->setFlash(__('Acceso denegado.'));
            return $this->redirect(array('controller' => 'products', 'action' => 'index'));
        }
    }

    public function edit($id = null)
    {
        $this->BillingAddress->id = $id;
        $this->set('countries', $this->Country->find('list', array('fields' => array('Country.country_name'))));
        if (!$this->BillingAddress->exists())
        {
            throw new NotFoundException(__('Dirección inexistente'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->BillingAddress->save($this->request->data))
            {
                $this->Session->setFlash(__('Se han guardado los cambios'));
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
            }
            $this->Session->setFlash(__('No se pudo almacenar los cambios, inténtelo de nuevo'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
        else
        {
            $this->request->data = $this->BillingAddress->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        $this->BillingAddress->id = $id;
        if (!$this->BillingAddress->exists())
        {
            throw new NotFoundException(__('Dirección inexistente'));
        }
        if ($this->BillingAddress->delete())
        {
            $address = $this->BaddressUser->field('id', array('address_id' => $id));
            $this->BaddressUser->delete(array('id'=>$address, 'user_id'=>$this->User->id));
            $this->Session->setFlash(__('Dirección borrada'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
        $this->Session->setFlash(__('La dirección no pudo eliminarse, intente de nuevo'));
        return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
    }
}