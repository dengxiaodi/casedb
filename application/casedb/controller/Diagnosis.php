<?php
namespace app\casedb\controller;

use think\Controller;
use \think\Request;

class Diagnosis extends Controller
{
	public function edit() {	
    	$edit_action = 'add';
    	if(Request::instance()->has('id', 'param')) {
    		$id = Request::instance()->param('id');
    		$edit_action = 'update';
    		$diagnosis = model('Diagnosis');
    		$diagnosis_info = $diagnosis->get_diagnosis_info($id);

    		$this->assign('diagnosis_info', $diagnosis_info);
    	}

    	$this->assign('edit_action', $edit_action);
    	return $this->fetch('edit');
    }
}