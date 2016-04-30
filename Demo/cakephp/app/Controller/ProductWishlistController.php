<?php

App::uses('AppController', 'Controller');

class ProductWishlistController extends AppController{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('ProductWishlist', 'Product', 'Wishlist');

	
	public function index() {
        $user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

        $consult = $this->Product->find('all', array('joins' => array(
            array(
                'table' => 'product_wishlists',
                'alias' => 'ProductWishlist',
                'type' => 'inner',
                'foreignKey' => false,
                'conditions'=> array(
                    'Product.id = ProductWishlist.product_id',
                    'ProductWishlist.wishlist_id' => $wish
                )
            )
        )));

        $this->set('ProductWishlistList',$consult);
    }

    public function add($product_id = null){

        $user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

       $this->ProductWishlist->set(array(
            'wishlist_id' => $wish,
            'product_id' => $product_id
        ));
        $this->ProductWishlist->save();

      return $this->redirect(array('action' => 'index'));
    }
	
	public function delete($product_id = null){
        $user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

        $this->ProductWishlist->deleteAll(array('wishlist_id'=>$wish,'product_id'=>$product_id));
        return $this->redirect(array('action' => 'index'));
    }
}

?>