<?php
class ProductWishlistFixture extends CakeTestFixture {

    public $useDbConfig = 'test';

    public $fields = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'wishlist_id' => array('type' => 'integer'),
        'product_id' => array('type' => 'integer')
    );
	  public $records = array(
        array(
			  'id' => 1,
              'wishlist_id' => 1,
              'product_id' =>1,
		  ),
     );
	 
 }
 ?>