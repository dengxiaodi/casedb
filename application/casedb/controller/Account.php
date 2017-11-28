<?php
namespace app\casedb\controller;

use think\Controller;
use \think\Request;

class Account extends AdminController
{
	public function edit() {   
        $edit_action = 'add';
        $user_info = null;

        if(Request::instance()->has('user_id', 'param')) {
            $id = Request::instance()->param('user_id');
            $edit_action = 'update';
            $user = model('Account');
            $user_info = $user->get_user_info($id);
        }

        $this->assign('user_info', $user_info);
        $this->assign('edit_action', $edit_action);
        return $this->fetch('edit');
    }

    public function login() {
        return $this->fetch('login');
    }

    public function login_action() {
        $user = model('Account');
        $name = Request::instance()->post('name');
        $password = Request::instance()->post('password');
        if($user->login($name, $password)){  
            return ['code' => 0, 'message' => '登录成功！', 'redirect' => url('index/index')];
        } else {  
            return ['code' => -1, 'message' => '登录失败！用户名密码错误']; 
        }         
    }

    public function logout() {
        $user = model('Account');
        $user->logout();

        $this->redirect('index/index');
    }

    public function add() {
        $user = model('Account');
        $user_data = $this->get_user_data();
        $user_data['create_time'] = time();

        if(!$user->check_name($user_data['name'])) {
            return ['code' => -1, 'message' => '添加用户失败！用户名已存在或者不符合规范'];
        }

        if(!$user->check_email($user_data['email'])) {
            return ['code' => -1, 'message' => '添加用户失败！电子邮件已存在或者不符合规范'];
        }

        $user->add_user($user_data);
        return ['code' => 0, 'message' => '添加用户成功！', 'redirect' => url('account/list')];
    }

    public function update() {
        $user = model('Account');
        $user_id = Request::instance()->param('user_id');
        $user->update_user($user_id, $this->get_user_data());

        $this->redirect(url('account/detail', ['user_id' => $user_id]));
    }

    public function list() {
        $user = model('Account');
        $patient_id = null;
        if(Request::instance()->has('patient_id', 'param')) {
            $patient_id = Request::instance()->param('patient_id');
        }
        $grouped_user = $user->get_grouped_user_list($patient_id);
        $this->assign('user_grouped_list', $grouped_user['list']);
        $this->assign('pagination', $grouped_user['pagination']);

        return $this->fetch('list');
    }
    
    public function detail() {
        $user = model('Account');
        $user_id = Request::instance()->param('user_id');
        $user_info = $user->get_user_info($user_id);
        
        $this->assign('user_info', $user_info);
        return $this->fetch('detail');
    }

    public function delete() {
        $user = model('Account');
        $user->delete_user(Request::instance()->param('user_id'));

        $this->redirect(url('user/list'));
    }

    private function get_user_data() {
        return array(
            'name' => Request::instance()->post('name'),
            'password' => md5(Request::instance()->post('password')),
            'email' => Request::instance()->post('email'),
            'role' => Request::instance()->post('role'),
            'title' => Request::instance()->post('title'),
            'phone' => Request::instance()->post('phone'),
            'office' => Request::instance()->post('office'),
            'comment' => Request::instance()->post('comment')
        );
    }
}