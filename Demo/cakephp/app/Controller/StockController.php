<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 19/10/14
 * Time: 01:16 PM
 */
App::uses('AppController', 'Controller');
class StockController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    public function index()
    {
        $this->set('stock', $this->Stock->find('all'));
    }
}
