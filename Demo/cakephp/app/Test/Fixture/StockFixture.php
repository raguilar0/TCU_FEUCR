<?php
class StockFixture extends CakeTestFixture {
      // Set this property to load fixtures to a different test datasource
      //public $useDbConfig = 'test';
	  public $import = array('model' => 'Stock'); //, 'records' => true);

	  public $records = array(
        array(
            'id' => 1,
            'product_id' => 1,
            'amount' => 5
		  )
      );
 }
 ?>