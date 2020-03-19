<?php

class WP_Wpp_DhirajTest extends WP_Ajax_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->pub_class_instance = new Wpp_Dhiraj_Public('wpp-dhiraj', '1.0.0');
		$this->admin_class_instance = new Wpp_Dhiraj_Admin('wpp-dhiraj', '1.0.0');

		$this->nonce = wp_create_nonce('user_details_nonce');
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * this will test all users from api method
	 * @return [type] [description]
	 */
	public function test_show_users() {
		$users = $this->pub_class_instance->fetch_users_api();

		$this->assertTrue(is_array($users));
		$this->assertCount(10, $users);
		$this->assertGreaterThanOrEqual(1, count($users));
		$this->assertArrayHasKey('id', $users[0]);
		$this->assertArrayHasKey('name', $users[0]);
		$this->assertArrayHasKey('username', $users[0]);
		$this->assertArrayHasKey('email', $users[0]);
	}

	/**
	 * this will test user details by ajax
	 * @return [type] [description]
	 */
	public function test_user_details() {
		$_SERVER["HTTP_REFERER"] = 'tests/test-wpp-dhiraj.php';
		$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
		$_POST['nonce'] = $this->nonce;
		$_POST['user_id'] = rand(1, 10);
		$_POST['action'] = "user_details_call";

		try {
			$this->_handleAjax('user_details_call');
			$this->setExpectedException('WPAjaxDieStopException');

		} catch (WPAjaxDieStopException $e) {}

		// write your tests assertions here
	}
}