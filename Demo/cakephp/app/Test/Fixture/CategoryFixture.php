<?php
class CategoryFixture extends CakeTestFixture {

    public $import = array('model' => 'Category');
	  public $records = array
      (
          array(
		  	  'id' => 1,
			  'name' => 'AVENTURA',
			  'parent_id' => NULL,
			  'lft' => 1,
			  'rght' => 2
          )
      );
 }
 ?>

