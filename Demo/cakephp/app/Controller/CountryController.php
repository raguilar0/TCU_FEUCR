<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 27/10/14
 * Time: 11:38 PM
 */

App::uses('AppController', 'Controller');
class CountryController extends AppController
{
    public $displayField = 'country_name';
    public $helpers = array('Html', 'Form');
    var $components = array('Session');

    public function index()
    {
        $this->set('countries', $this->Country->find('all'));
    }
}

