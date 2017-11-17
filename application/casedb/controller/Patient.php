<?php
namespace app\casedb\controller;

use think\Controller;
use \think\Request;

class Patient extends Controller
{
    public function list() {
    	$patient = model('Patient');
    	$patient_list = $patient->get_patient_list();

    	$this->assign('patient_list', $patient_list);
    	$this->assign('pagination', $patient_list->render());
        return $this->fetch('list');
    }

    public function edit() {	
    	$edit_action = 'add';
    	$patient_info = null;
    	if(Request::instance()->has('id', 'param')) {
    		$id = Request::instance()->param('id');
    		$edit_action = 'update';
    		$patient = model('Patient');
    		$patient_info = $patient->get_patient_info($id);
    	}

    	$this->assign('patient_info', $patient_info);
    	$this->assign('edit_action', $edit_action);
    	return $this->fetch('edit');
    }

    public function add() {
    	$patient = model('Patient');
    	$patient->add_patient($this->get_patient_data());

    	$this->redirect(url('patient/list'));
    }

    public function update() {
    	$patient = model('Patient');
    	$patient->update_patient(Request::instance()->post('id'), $this->get_patient_data());

    	$this->redirect(url('patient/list'));
    }

    public function delete() {
    	$patient = model('Patient');
    	$patient->delete_patient(Request::instance()->param('id'));

    	$this->redirect(url('patient/list'));
    }

    public function detail() {
    	$patient = model('Patient');
    	$patient_info = $patient->get_patient_info(Request::instance()->param('id'));
    	$this->assign('patient_info', $patient_info);
    	
    	return $this->fetch('detail');
    }

    private function get_patient_data() {
    	return array(
    		'name' => Request::instance()->post('name'),
    		'sex' => Request::instance()->post('sex'),
    		'age' => intval(Request::instance()->post('age')),
    		'hospital_id' => Request::instance()->post('hospital_id'),
    		'department_id' => Request::instance()->post('department_id'),
    		'diagnosis' => Request::instance()->post('diagnosis'),
    		'primary_site' => Request::instance()->post('primary_site'),
    		'involved_site' => Request::instance()->post('involved_site'),
    		'transplate' => Request::instance()->post('transplate'),
    		'onset_time' => intval(Request::instance()->post('onset_time') / 1000),
    		'death_time' => intval(Request::instance()->post('death_time') / 1000),
    		'comment' => Request::instance()->post('comment')
    	);
    }
}