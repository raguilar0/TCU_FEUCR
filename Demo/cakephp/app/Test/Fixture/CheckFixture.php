<?php
/**
 * Created by PhpStorm.
 * User: MariaJose
 * Date: 13/11/2014
 * Time: 08:13 PM
 */

class CheckFixture extends CakeTestFixture {

    public $import = 'Check';

    public $records = array(
        array(
            'id' => 1,
            'debitcard_id' => 1,
            'amount'=> '10000',
            'general_discount' => '0',
            'sold_the' => '2014-11-11'
        )
    );

}
?>