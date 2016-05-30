<?php

App::uses('AppController', 'Controller');

class CheckProductController extends AppController
{
    var $uses = array('Check', 'Product','CheckProduct');
    /*public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist');
    */


    public function sales(){
		       if($this->Session->read("Auth.User.role")== 'admin') {
            $options =
                array(
                    array(
                        'table' => 'products',
                        'alias' => 'Product',
                        'type' => 'left',
                        'foreignKey' => false,
                        'conditions' => array('Product.id = CheckProduct.product_id')
                    ),
                    array(
                        'table' => 'checks',
                        'alias' => 'Check',
                        'type' => 'left',
                        'foreignKey' => false,
                        'conditions' => array('Check.id = CheckProduct.check_id')
                    )
                );
        }
        else{
            $options =
                array(
                    array(
                        'table' => 'card_users',
                        'alias' => 'CardUser',
                        'type' => 'inner',
                        'foreignKey' => false,
                        'conditions' => array('CardUser.user_id' =>$this->Session->read("Auth.User.id"))
                    ),
                    array(
                        'table' => 'checks',
                        'alias' => 'Check',
                        'type' => 'inner',
                        'foreignKey' => false,
                        'conditions' => array('Check.id = CheckProduct.check_id','Check.debitcard_id = CardUser.card_id')
                    ),
                    array(
                        'table' => 'products',
                        'alias' => 'Product',
                        'type' => 'inner',
                        'foreignKey' => false,
                        'conditions' => array('Product.id = CheckProduct.product_id')
                    )

                );

        }
        $this->set('sale',$this->CheckProduct->find('all',array('fields' => array('Check.*','Product.*','CheckProduct.*'),'joins'=>$options)));


    }
}

?>