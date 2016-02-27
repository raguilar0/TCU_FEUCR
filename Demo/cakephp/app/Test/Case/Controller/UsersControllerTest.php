<?php
class UsersControllerTest extends ControllerTestCase {
    public $fixtures = array('app.user');

    public function testIndex() {
        $result = $this->testAction('/users/index');
        debug($result);
    }
	
	public function testIndexShort() {
        $result = $this->testAction('/users/index/short');
        debug($result);
    }

    public function testIndexShortGetRenderedHtml() {
        $result = $this->testAction(
           '/users/index/short',
            array('return' => 'contents')
        );
        debug($result);
    }

    public function testIndexShortGetViewVars() {
        $result = $this->testAction(
            '/users/index/short',
            array('return' => 'vars')
        );
        debug($result);
    }

    public function testIndexPostData() {
        $data = array(
            'User' => array(
                'id' => 1,
                'username' => 'zxcvzxcv'
                'password' => '$2a$10$z8hlB9jELbP8HQZV/FjE9enYGsuhOn2OQG68TsHTWvcw6/gsKgmuG',
                'name' => 'zxcvzxcv',
                'lastname' => 'zxcvzxcv'
				'country' => 'zxcvzxcv'
				'role' => 'admin'
            )
        );
        $result = $this->testAction(
            '/users/index',
            array('data' => $data, 'method' => 'post')
        );
        debug($result);
    }
}
?>