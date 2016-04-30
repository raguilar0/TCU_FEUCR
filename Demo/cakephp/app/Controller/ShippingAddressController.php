<?php

App::uses('AppController', 'Controller');

class ShippingAddressController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    var $uses = array('User', 'Country', 'ShippingAddress', 'SaddressUser');

    public function index()
    {
        $this->set('shippingaddress',$this->ShippingAddress->find('all'));
    }

    public function add()
    {
        $this->set('countries', $this->Country->find('list', array('fields' => array('Country.country_name'))));

        if(($this->Session->read("Auth.User.role") == 'admin')||($this->Session->read("Auth.User.role") == 'cust'))
        {
            if ($this->request->is('post'))
            {
                $this->ShippingAddress->create();
                $user =  $this->Session->read("Auth.User.id");

                if ($this->ShippingAddress->save($this->request->data))
                {
                    $address_id = $this->ShippingAddress->getLastInsertID();
                    $this->ShippingAddress->SaddressUser->saveAll(['address_id' => $address_id, 'user_id'=>$user]);
                    $this->Session->setFlash(__('Se ha registrado la dirección de envío'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
                }
                $this->Session->setFlash(__('No se ha podido registrar la dirección de envío'));
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
            }
        }
        else
        {
            $this->Session->setFlash(__('Acceso no permitido.'));
            return $this->redirect(array('controller' => 'products', 'action' => 'index'));
        }
    }
	
    public function edit($id = null)
    {
        $this->ShippingAddress->id = $id;
        $this->set('countries', $this->Country->find('list', array('fields' => array('Country.country_name'))));
        if (!$this->ShippingAddress->exists())
        {
            throw new NotFoundException(__('Dirección inexistente'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->ShippingAddress->save($this->request->data))
            {
                $this->Session->setFlash(__('Se han guardado los cambios'));
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
            }
            $this->Session->setFlash(__('No se pudo almacenar los cambios, inténtelo de nuevo'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
        else
        {
            $this->request->data = $this->ShippingAddress->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        $this->ShippingAddress->id = $id;
        if (!$this->ShippingAddress->exists())
        {
            throw new NotFoundException(__('Dirección inexistente'));
        }
        if ($this->ShippingAddress->delete())
        {
            $address = $this->SaddressUser->field('id', array('address_id' => $id));
            $this->SaddressUser->delete(array('id'=>$address, 'user_id'=>$this->User->id));
            $this->Session->setFlash(__('Dirección borrada'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
        }
        $this->Session->setFlash(__('La dirección no pudo eliminarse, intente de nuevo'));
        return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read("Auth.User.id")));
    }
}
?>