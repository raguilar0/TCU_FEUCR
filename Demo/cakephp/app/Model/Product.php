<?php
/**
 * Created by PhpStorm.
 * User: Erick
 * Date: 09/10/14
 * Time: 12:40 AM
 */

class Product extends AppModel
{
/*The $validate array tells CakePHP how to validate your data when the save() method is called.*/
	public $belongsTo = array('Platform');//, 'Stock');
	public $hasOne = array('Stock');//, 'Stock');
	public $belongsToMany = array('ProductWishlist');
	public $hasAndBelongsToMany = array(
        //todo producto puede estar asociado a varias wishlist (solo una vez)
		'Wishlist' =>
			array(
				'className' => 'Wishlist',
				'joinTable' => 'product_wishlists',
				'foreignKey' => 'product_id',
				'associationForeignKey' => 'wishlist_id',
				'unique' => true /*,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'finderQuery' => '',
				'with' => '' */
			),
		'Category' =>
            array(
                'className' => 'Category',
                'joinTable' => 'category_products',
                'foreignKey' => 'product_id',
                'associationForeignKey' => 'category_id',
                'unique' => true /*,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => '' */
            ),
		'Check' =>
            array(
                'className' => 'Check',
                'joinTable' => 'check_products',
                'foreignKey' => 'product_id',
                'associationForeignKey' => 'check_id',
                'unique' => true /*,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => '' */
            )
    );
	public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
			'rule' => 'isUnique',
            'message' => 'The name is already used'
        ),
		'platform_id' => array(
            'rule' => 'notEmpty'
        ),
		'release_year' => array(
            'rule' => 'notEmpty'
        ),
		'price' => array(
            'rule' => 'notEmpty'
        ),
        'discount'=>array(
            'rule1' => 'notEmpty',
            'rule2' => array(
                'rule' => array('between', 1, 2),
                'message' => 'Debe ser un valor entre 0 y 99'
            ),
            'rule3' => 'numeric'
        ),
		'tax'=>array(
            'rule1' => 'notEmpty',
            'rule2' => array(
                'rule' => array('between', 1, 2),
                'message' => 'Debe ser un valor entre 0 y 99'
            ),
            'rule3' => 'numeric'
        ),
		'description' => array(
            'rule' => 'notEmpty'
        )
    );
	
	public function bringAllRegisters() {
        return $this->find('all');
    }
	
	public function editField() {
        $data = array('id' => 1, 'name' => 'RE5');
		// This will update Recipe with id 10
		$this->save($data);
		return $this->bringAllRegisters();
    }
	
	public function removeRegister() {
		$this->delete(1,false);
		return $this->bringAllRegisters();
    }
	
	public function getProductStock() {
        /*$data = array(
                    'id' => 1,
                    'name' => 'RE4',
                    'platform_id' => 2,
                    'release_year' => '2004', //no estoy segura si va en comillas
                    'price' => 5,
                    'description' => 'a really nice game',
                    'presentation' => 1,
                    'enabled' => 1,
                    'requirement' => '',
                    'rated' => 0,
                    'discount' => 0,
                    'rating' => 0,
                    'image' => null,
                    'video' => null,
                    'outofstock' => 0,
                    'tax' => 0
        );
        $this->save($data);
        $this->Stock->save(['id'=>1, 'product_id'=>1, 'amount'=>5]); */
        return $this->Stock->find('first');
    }

    public function delProductStock() {
        $this->Stock->delete(1);
        return $this->Stock->find('first');
    }

    public function enable() {
        $this->id = 1;
        $this->saveField('enabled', 1);
        return $this->find('first');
    }

    public function disable() {
        //$data = array('enabled' => 0);
        // This will update Recipe with id 10
        $this->id = 1;
        $this->saveField('enabled', 0);
        return $this->find('first');
    }
}

?>