<?php
namespace app\casedb\controller;

use think\Controller;
use \think\Request;

class Sample extends Controller
{
	public function edit() {   
        $edit_action = 'add';
        $sample_info = null;
        $patient_id = intval(Request::instance()->param('patient_id'));

        if(Request::instance()->has('sample_id', 'param')) {
            $id = Request::instance()->param('sample_id');
            $edit_action = 'update';
            $sample = model('Sample');
            $sample_info = $sample->get_sample_info($id);
            $patient_id = $sample_info['patient_id'];
        }

        $this->assign('sample_info', $sample_info);
        $this->assign('patient_id', $patient_id);
        $patient = model('Patient');
        $patient_info = $patient->get_patient_info($patient_id);
        $this->assign('patient_info', $patient_info);
        $this->assign('edit_action', $edit_action);
        return $this->fetch('edit');
    }

    public function add() {
        $sample = model('Sample');
        $sample->add_sample($this->get_sample_data());

        $this->redirect(url('sample/list'));
    }

    public function update() {
        $sample = model('Sample');
        $sample_id = Request::instance()->param('sample_id');
        $sample->update_sample($sample_id, $this->get_sample_data());

        $this->redirect(url('sample/detail', ['sample_id' => $sample_id]));
    }

    public function list() {
        $sample = model('Sample');
        $patient_id = null;
        if(Request::instance()->has('patient_id', 'param')) {
            $patient_id = Request::instance()->param('patient_id');
        }
        $grouped_sample = $sample->get_grouped_sample_list($patient_id);
        $this->assign('sample_grouped_list', $grouped_sample['list']);
        $this->assign('pagination', $grouped_sample['pagination']);

        return $this->fetch('list');
    }
    
    public function detail() {
        $sample = model('Sample');
        $sample_id = Request::instance()->param('sample_id');
        $sample_info = $sample->get_sample_info($sample_id);
        
        $patient_id = $sample_info['patient_id'];
        $patient = model('Patient');
        $patient_info = $patient->get_patient_info($patient_id);

        $this->assign('sample_info', $sample_info);
        $this->assign('patient_info', $patient_info);

        return $this->fetch('detail');
    }

    public function delete() {
        $sample = model('Sample');
        $sample->delete_sample(Request::instance()->param('sample_id'));

        $this->redirect(url('sample/list'));
    }

    private function get_sample_data() {
        return array(
            'patient_id' => Request::instance()->post('patient_id'),
            'sample_time' => intval(Request::instance()->post('sample_time') / 1000),
            'tissue' => Request::instance()->post('tissue'),
            'type' => Request::instance()->post('type'),
            'amount' => Request::instance()->post('amount'),
            'location' => Request::instance()->post('location'),
            'comment' => Request::instance()->post('comment')
        );
    }
}