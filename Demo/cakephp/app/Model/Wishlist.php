<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 18/10/14
 * Time: 11:47 PM
 */

class Wishlist extends AppModel {
    public $belongsTo = 'User'; //la wishlist le pertenece a un usuario (un usuario tiene una wishlist)
    //vamos a tener una tabla que ligue el wishlist_id con el product_id
    //es para ver cuáles productos se asocian a la wishlist del usuario
	public $hasAndBelongsToMany = array(
        'Product' =>
            array(
                'className' => 'Product',
                'joinTable' => 'product_wishlists',
                'foreignKey' => 'wishlist_id',
                'associationForeignKey' => 'product_id',
                'unique' => true
            )
    );
    public $validate = array(
        'user_id' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        )
    );
	
	public function bringAllRegisters() {
        return $this->find('all');
    }


    public function removeRegister() {
        $this->delete(1);
        return $this->bringAllRegisters();
    }
}

?>