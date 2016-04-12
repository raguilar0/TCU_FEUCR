<?php

class ArticleFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';
      public $fields = array(
          'id' => array('type' => 'integer', 'key' => 'primary'),
          'title' => array(
            'type' => 'string',
            'length' => 255,
            'null' => false
          ),
          'body' => 'text',
          'published' => array(
            'type' => 'integer',
            'default' => '0',
            'null' => false
          ),
          'created' => 'datetime',
          'updated' => 'datetime'
      );
      public $records = array(
          array(
            'id' => 1,
            'title' => 'First Article',
            'body' => 'First Article Body',
            'published' => '1',
            'created' => '2007-03-18 10:39:23',
            'updated' => '2007-03-18 10:41:31'
          ),
          array(
            'id' => 2,
            'title' => 'Second Article',
            'body' => 'Second Article Body',
            'published' => '1',
            'created' => '2007-03-18 10:41:23',
            'updated' => '2007-03-18 10:43:31'
          ),
          array(
            'id' => 3,
            'title' => 'Third Article',
            'body' => 'Third Article Body',
            'published' => '1',
            'created' => '2007-03-18 10:43:23',
            'updated' => '2007-03-18 10:45:31'
          )
      );
 }
 
 ?>