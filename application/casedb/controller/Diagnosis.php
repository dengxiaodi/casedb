<?php
namespace app\casedb\controller;

use think\Controller;
use \think\Request;

class Diagnosis extends Controller
{
	public function edit() {	
    	$edit_action = 'add';
    	$diagnosis_info = null;
    	$patient_id = intval(Request::instance()->param('patient_id'));

    	if(Request::instance()->has('diagnosis_id', 'param')) {
    		$id = Request::instance()->param('diagnosis_id');
    		$edit_action = 'update';
    		$diagnosis = model('Diagnosis');
    		$diagnosis_info = $diagnosis->get_diagnosis_info($id);
    		$patient_id = $diagnosis_info['patient_id'];
    	}

    	$this->assign('diagnosis_info', $diagnosis_info);
    	$this->assign('patient_id', $patient_id);
    	$patient = model('Patient');
    	$patient_info = $patient->get_patient_info($patient_id);
    	$this->assign('patient_info', $patient_info);
    	$this->assign('edit_action', $edit_action);
    	return $this->fetch('edit');
    }

    public function add() {
    	$diagnosis = model('Diagnosis');
    	$diagnosis->add_diagnosis($this->get_diagnosis_data());

    	$this->redirect(url('diagnosis/list'));
    }

    public function update() {
    	$diagnosis = model('Diagnosis');
    	$diagnosis_id = Request::instance()->param('diagnosis_id');
    	$diagnosis->update_diagnosis($diagnosis_id, $this->get_diagnosis_data());

    	$this->redirect(url('diagnosis/detail', ['diagnosis_id' => $diagnosis_id]));
    }

    public function list() {
    	$diagnosis = model('Diagnosis');
    	$patient_id = null;
    	if(Request::instance()->has('patient_id', 'param')) {
    		$patient_id = Request::instance()->param('patient_id');
    	}

    	$grouped_diagnosis = $diagnosis->get_grouped_diagnosis_list($patient_id);
    	$this->assign('diagnosis_grouped_list', $grouped_diagnosis['list']);
    	$this->assign('pagination', $grouped_diagnosis['pagination']);

    	return $this->fetch('list');
    }

    public function detail() {
    	$diagnosis = model('Diagnosis');
    	$diagnosis_id = Request::instance()->param('diagnosis_id');
    	$diagnosis_info = $diagnosis->get_diagnosis_info($diagnosis_id);
    	
    	$patient_id = $diagnosis_info['patient_id'];
    	$patient = model('Patient');
    	$patient_info = $patient->get_patient_info($patient_id);

    	$this->assign('diagnosis_info', $diagnosis_info);
    	$this->assign('patient_info', $patient_info);

    	return $this->fetch('detail');
    }

    public function delete() {
    	$diagnosis = model('Diagnosis');
    	$diagnosis->delete_diagnosis(Request::instance()->param('diagnosis_id'));

    	$this->redirect(url('diagnosis/list'));
    }

    private function get_diagnosis_data() {
    	return array(
    		'patient_id' => Request::instance()->post('patient_id'),
    		'time' => intval(Request::instance()->post('time') / 1000),
    		'diagnosis' => Request::instance()->post('diagnosis'),
    		'clinical_representation' => Request::instance()->post('clinical_representation'),
    		'stage' => intval(Request::instance()->post('stage')),
    		'cytological_diagnosis' => Request::instance()->post('cytological_diagnosis'),
    		'pathologic_diagnosis' => Request::instance()->post('pathologic_diagnosis'),
    		'immunology_diagnosis' => Request::instance()->post('immunology_diagnosis'),
    		'cytogenetical_diagnosis' => Request::instance()->post('cytogenetical_diagnosis'),
    		'molecular_biology_diagnosis' => Request::instance()->post('molecular_biology_diagnosis'),
    		'genetic_diagnosis' => Request::instance()->post('genetic_diagnosis'),
    		'other_diagnosis' => Request::instance()->post('other_diagnosis'),
    		'comment' => Request::instance()->post('comment')
    	);
    }
}