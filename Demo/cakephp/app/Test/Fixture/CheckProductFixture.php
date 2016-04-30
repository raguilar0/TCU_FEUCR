<?php
/**
 * Created by PhpStorm.
 * User: MariaJose
 * Date: 13/11/2014
 * Time: 08:20 PM
 */

class CheckProductFixture extends CakeTestFixture {

    public $import = 'CheckProduct';

    public $records = array(
        array(
            'id' => 1,
            'check_id' => 1,
            'product_id'=> 1,
            'discount' => '0',
            'prize' => '15',
            'quantity' => '1'
        )
    );

}
?>