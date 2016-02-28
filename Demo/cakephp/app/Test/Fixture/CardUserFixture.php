<?php
class CardUserFixture extends CakeTestFixture
{
    public $useDbConfig = 'test';

    public $fields = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'user_id' => array('type' => 'integer'),
        'card_id' => array('type' => 'integer'),
        'card_type' => array('type' => 'integer')
    );

    public $records = array(
        array(
            'id' => 1,
            'user_id' => 1,
            'card_id' =>1,
            'card_type' => 1
        ),
        array(
            'id' => 2,
            'user_id' => 1,
            'card_id' =>100,
            'card_type' => 2
        )
    );
}
?>