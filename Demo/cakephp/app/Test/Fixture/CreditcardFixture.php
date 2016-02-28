<?php
class CreditcardFixture extends CakeTestFixture {

    public $import = 'Creditcard';

    public $records = array(
        array(
            'id' => 100,
            'card_number' => '4185417256930711',
            'nip' => '1234',
            'csc' => '4321',
            'expiration_date' => '2018-12-10',
            'brand' => 'Visa',
            'card_limit' => 1000,
            'check_id' => 0
        ),
        array(
            'id' => 101,
            'card_number' => '5185417256930712',
            'nip' => '5678',
            'csc' => '8765',
            'expiration_date' => '2018-12-10',
            'brand' => 'Master Card',
            'card_limit' => 2000,
            'check_id' => 0
        ),
        array(
            'id' => 102,
            'card_number' => '6185417256930713',
            'nip' => '9012',
            'csc' => '2109',
            'expiration_date' => '2018-12-10',
            'brand' => 'American Express',
            'card_limit' => 3000,
            'check_id' => 0
        )
    );
}
?>