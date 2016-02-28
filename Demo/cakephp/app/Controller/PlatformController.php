<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 19/10/14
 * Time: 01:16 PM
 */
App::uses('AppController', 'Controller');
class PlatformController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    public function index()
    {
        $this->set('platforms', $this->Platform->find('all'));
    }
    public function add() {
        if ($this->request->is('post')) {
            $this->Platform->create();
            if ($this->Platform->save($this->request->data)) {
                $this->Session->setFlash(__('Esta plataforma ha sido guardada.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido guardar esta plataforma'));
        }
    }
}
