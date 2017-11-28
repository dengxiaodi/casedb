<?php

namespace app\casedb\model;

use think\Model;
use think\Session;

class Account extends Model
{
	protected $table = "user";

	public function name_exists($name) {
		return $this->where(array(
			'name' => $name
		))->select();
	}

	public function email_exists($email) {
		return $this->where(array(
			'email' => $email
		))->select();
	}

	public function is_valid_name($name) {
		return true;
	}

	public function is_valid_email($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function check_name($name) {
		return $this->is_valid_name($name) && !$this->name_exists($name);
	}

	public function check_email($email) {
		return $this->is_valid_email($email) && !$this->email_exists($email);
	}

	public function get_user_info($user_id) {
		return $this->where(array(
			'id' => intval($user_id)
		))->find();
	}

	public function add_user($user_data) {
		$user_data['create_time'] = time();
		$this->data($user_data)->save();
	}

	public function update_user($user_id, $user_data) {
		$this->save($user_data, array(
			'id' => intval($user_id)
		));
	}

	public function login($user_name, $password) {
		$user_info = $this->where(array(
			'name' => trim($user_name),
			'password' => md5($password)
		))->find();

		if($user_info) {
			Session::set('user', $user_info['id']);
			return true;
		}

		return false;
	}

	public function logout() {
		Session::delete('user');
	}

	public function login_user() {
		return Session::get('user');
	}

	public function get_grouped_user_list($patient_id = null) {
		$user_grouped_list = array();
		if($patient_id) {
			$user_grouped_list[$patient_id] = $this->get_patient_user($patient_id);
			$pagination = null;
		} else {
			// get patient ids

			$user_list = $this->distinct(true)->field('patient_id')->paginate(10);
			$pagination = $user_list->render();

			foreach ($user_list as $user_info) {
				$user_grouped_list[$user_info['patient_id']] = $this->get_patient_user($user_info['patient_id']);
			}
		}

		return array(
			'list' => $user_grouped_list,
			'pagination' => $pagination
		);
	}

	public function delete_user($user_id) {
		$user_info = $this->get_user_info($user_id);
		$patient_id = $user_info['patient_id'];

		$this->destroy(array(
			'id' => intval($user_id)
		));
	}
}