<?php
class ProductFixture extends CakeTestFixture {

	 public $import = array('model' => 'Product'); //, 'records' => true);

	  public $records = array(
        array(
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
        )
     );
	/*
      // Optional.
      // Set this property to load fixtures to a different test datasource
      //public $useDbConfig = 'test';
	  public $import = 'Product';
	  //public $import = array('model' => 'Product'); //, 'records' => true);
	  public $records = array(
        array(
			  'id' => 1,
			  'name' => 'RE4',
			  'genre' => 'Horror',
			  'console' => 'PS3',
			  'release_year' => '2004', //no estoy segura si va en comillas
			  'price' => 5,
			  'description' => 'a really nice game',
			  'amount' => 5,
			  'image' => 'http://frikarte.com/wp-content/uploads/2013/03/Resident-Evil-4-Wii-Frikarte.jpg',
			  'video' => 'www.youtube.com/embed/PHQFgS44lMA'
		  ),
     );
	 
	 /*
     public function init() {
        $this->records = array(
         array(
			  'id' => 1,
			  'name' => 'RE4',
			  'genre' => 'Horror',
			  'console' => 'PS3',
			  'release_year' => '2004', //no estoy segura si va en comillas
			  'price' => 5,
			  'description' => 'a really nice game',
			  'amount' => 5,
			  'image' => 'http://frikarte.com/wp-content/uploads/2013/03/Resident-Evil-4-Wii-Frikarte.jpg',
			  'video' => 'www.youtube.com/embed/PHQFgS44lMA'
		  ),
        );
        parent::init();
    }
	*/
 }
 ?>