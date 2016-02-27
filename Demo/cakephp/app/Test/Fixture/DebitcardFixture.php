<?php
class DebitcardFixture extends CakeTestFixture {

    public $import = 'Debitcard';

    public $records = array(
        array(
            'id' => 1,
            'card_number' => '1185417256930701',
            'nip' => '1122',
            'csc' => '2211',
            'expiration_date' => '2018-12-10',
            'brand' => 'Visa',
            'balance' => 1000,
            'check_id' => 0
        ),
        array(
            'id' => 2,
            'card_number' => '2185417256930702',
            'nip' => '3344',
            'csc' => '4433',
            'expiration_date' => '2018-12-10',
            'brand' => 'Master Card',
            'balance' => 2000,
            'check_id' => 0
        ),
        array(
            'id' => 3,
            'card_number' => '3185417256930703',
            'nip' => '5566',
            'csc' => '6655',
            'expiration_date' => '2018-12-10',
            'brand' => 'American Express',
            'balance' => 3000,
            'check_id' => 0
        )
    );
}
?>