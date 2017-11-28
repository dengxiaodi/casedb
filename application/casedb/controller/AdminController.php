<?php
namespace app\casedb\controller;

use think\Controller;
use \think\Request;

class AdminController extends Controller {
	protected $user_id = null;
	protected $user_info = null;

	function __construct() {
		parent::__construct();

		$user = model("Account");
		$this->user_id = $user->login_user();
		$this->user_info = $user->get_user_info($this->user_id);

		$this->assign('login_user', $this->user_info);
	}

	protected function check_login() {
		if(!$this->user_id) {
			$this->redirect(url('account/login'));
		}
	}

	protected function is_super_admin() {
		if(!$this->user_id OR !$this->user_info) {
			return false;
		}

		return $this->user_info['role'] == 0;
	}

	protected function is_admin() {
		if(!$this->user_id OR !$this->user_info) {
			return false;
		}

		return ($this->user_info['role'] == 0 OR $this->user_info['role'] == 1);
	}
}