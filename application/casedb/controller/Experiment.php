<?php
namespace app\casedb\controller;

use think\Controller;
use \think\Request;

class Experiment extends Controller
{
	public function edit() {   
        $edit_action = 'add';
        $experiment_info = null;
        $sample_id = intval(Request::instance()->param('sample_id'));
        if(Request::instance()->has('experiment_id', 'param')) {
            $id = Request::instance()->param('experiment_id');
            $edit_action = 'update';
            $experiment = model('Experiment');
            $experiment_info = $experiment->get_experiment_info($id);
            $sample_id = $experiment_info['sample_id'];
        }
        $this->assign('experiment_info', $experiment_info);
        $this->assign('edit_action', $edit_action);

        $sample = model('Sample');
        $sample_info = $sample->get_sample_info($sample_id);
        $this->assign('sample_info', $sample_info);
        return $this->fetch('edit');
    }

    public function add() {
        $experiment = model('Experiment');
        $experiment->add_experiment($this->get_experiment_data());

        $this->redirect(url('experiment/list'));
    }

    public function update() {
        $experiment = model('Experiment');
        $experiment_id = Request::instance()->param('experiment_id');
        $experiment->update_experiment($experiment_id, $this->get_experiment_data());

        $this->redirect(url('experiment/detail', ['experiment_id' => $experiment_id]));
    }

    public function list() {
        $experiment = model('Experiment');
        $sample_id = null;
        if(Request::instance()->has('sample_id', 'param')) {
            $sample_id = Request::instance()->param('sample_id');
        }
        $experiment_grouped_list = $experiment->get_grouped_experiment_list($sample_id);
        $this->assign('experiment_grouped_list', $experiment_grouped_list);

        return $this->fetch('list');
    }
    
    public function detail() {
        $experiment = model('Experiment');
        $experiment_id = Request::instance()->param('experiment_id');
        $experiment_info = $experiment->get_experiment_info($experiment_id);
        
        $sample_id = $experiment_info['sample_id'];
        $sample = model('Sample');
        $sample_info = $sample->get_sample_info($sample_id);

        $this->assign('experiment_info', $experiment_info);
        $this->assign('sample_info', $sample_info);

        return $this->fetch('detail');
    }

    public function delete() {
        $experiment = model('Experiment');
        $experiment->delete_experiment(Request::instance()->param('experiment_id'));

        $this->redirect(url('experiment/list'));
    }

    private function get_experiment_data() {
        return array(
            'sample_id' => Request::instance()->post('sample_id'),
            'experiment_type' => Request::instance()->post('experiment_type'),
            'note' => Request::instance()->post('note'),
            'library' => Request::instance()->post('library'),
            'comment' => Request::instance()->post('comment')
        );
    }
}