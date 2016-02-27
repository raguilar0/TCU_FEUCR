<?php

App::uses('AppController', 'Controller');

class CategoryProductController extends AppController{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('CategoryProduct', 'Product', 'Category');

	public function index() {
        $this->set(
             'CategoryProductList',
             $this->CategoryProduct->find('all')
         );
    }

    public function add() {
        $this->set('products', $this->Product->find('list'));
        $this->set('categories', $this->Category->find('list'));
        if ($this->request->is('post')) {
			if ($this->CategoryProduct->saveAll($this->request->data, ['validate' => 'first'])) {
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
}

?>