<?php

namespace app\casedb\model;

use think\Model;

class Sample extends Model
{
	protected $table = "sample";

	public function get_sample_info($sample_id) {
		return $this->where(array(
			'id' => intval($sample_id)
		))->find();
	}

	public function add_sample($sample_data) {
		$sample_data['create_time'] = time();
		$this->data($sample_data)->save();
		$this->update_sample_count($sample_data['patient_id']);
	}

	public function update_sample($sample_id, $sample_data) {
		$this->save($sample_data, array(
			'id' => intval($sample_id)
		));
	}

	public function get_patient_sample($patient_id) {
		$patient = model('Patient');
		$patient_sample['patient_info'] = $patient->get_patient_info($patient_id);
		$patient_sample['sample_list'] = $this->where(array(
			'patient_id' => intval($patient_id)
		))->order('sample_time desc')->select();

		return $patient_sample;
	}

	public function get_grouped_sample_list($patient_id = null) {
		$sample_grouped_list = array();
		if($patient_id) {
			$sample_grouped_list[$patient_id] = $this->get_patient_sample($patient_id);
		} else {
			// get patient ids

			$patient_ids = $this->distinct(true)->field('patient_id')->column('patient_id');

			foreach ($patient_ids as $patient_id) {
				$sample_grouped_list[$patient_id] = $this->get_patient_sample($patient_id);
			}
		}

		return $sample_grouped_list;
	}

	public function update_sample_count($patient_id) {
		$count = $this->where(array(
			'patient_id' => intval($patient_id)
		))->count();

		$patient = model('Patient');
		$patient->update_sample_count($patient_id, $count);
	}

	public function update_experiment_count($sample_id, $experiment_count) {
		$this->save(array(
			'experiment_count' => intval($experiment_count)
		), array(
			'id' => intval($sample_id)
		));
	}

	public function delete_sample($sample_id) {
		$sample_info = $this->get_sample_info($sample_id);
		$patient_id = $sample_info['patient_id'];

		$this->destroy(array(
			'id' => intval($sample_id)
		));

		$this->update_sample_count($patient_id);
	}
}