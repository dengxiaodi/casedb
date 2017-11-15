<?php

namespace app\casedb\model;

use think\Model;

class Experiment extends Model
{
	protected $table = "experiment";

	public function get_experiment_info($experiment_id) {
		return $this->where(array(
			'id' => intval($experiment_id)
		))->find();
	}

	public function add_experiment($experiment_data) {
		$experiment_data['create_time'] = time();
		$this->data($experiment_data)->save();
		$this->update_experiment_count($experiment_data['sample_id']);
	}

	public function update_experiment($experiment_id, $experiment_data) {
		$this->save($experiment_data, array(
			'id' => intval($experiment_id)
		));
	}

	public function get_sample_experiment($sample_id) {
		$sample = model('Sample');
		$sample_experiment['sample_info'] = $sample->get_sample_info($sample_id);
		$sample_experiment['experiment_list'] = $this->where(array(
			'sample_id' => intval($sample_id)
		))->order('create_time desc')->select();

		return $sample_experiment;
	}

	public function get_grouped_experiment_list($sample_id = null) {
		$experiment_grouped_list = array();
		if($sample_id) {
			$experiment_grouped_list[$sample_id] = $this->get_sample_experiment($sample_id);
		} else {
			// get sample ids

			$sample_ids = $this->distinct(true)->field('sample_id')->column('sample_id');

			foreach ($sample_ids as $sample_id) {
				$experiment_grouped_list[$sample_id] = $this->get_sample_experiment($sample_id);
			}
		}

		return $experiment_grouped_list;
	}

	public function update_experiment_count($sample_id) {
		$count = $this->where(array(
			'sample_id' => intval($sample_id)
		))->count();

		$sample = model('Sample');
		$sample->update_experiment_count($sample_id, $count);
	}

	public function delete_experiment($experiment_id) {
		$experiment_info = $this->get_experiment_info($experiment_id);
		$sample_id = $experiment_info['sample_id'];

		$this->destroy(array(
			'id' => intval($experiment_id)
		));

		$this->update_experiment_count($sample_id);
	}
}