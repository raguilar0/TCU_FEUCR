<?php
class DebitcardsUserFixture extends CakeTestFixture {

    public $useDbConfig = 'test';

    public $fields = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'user_id' => array('type' => 'integer'),
        'debitcard_id' => array('type' => 'integer')
    );
    public $records = array(
        array(
            'id' => 1,
            'user_id' => 1,
            'debitcard_id' =>1,
        )
    );

}
?>