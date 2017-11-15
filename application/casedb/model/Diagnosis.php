<?php

namespace app\casedb\model;

use think\Model;

class Diagnosis extends Model
{
	protected $table = "diagnosis";

	public function get_diagnosis_info($diagnosis_id) {
		return $this->where(array(
			'id' => intval($diagnosis_id)
		))->find();
	}

	public function add_diagnosis($diagnosis_data) {
		$diagnosis_data['create_time'] = time();
		$this->data($diagnosis_data)->save();
		$this->update_diagnosis_count($diagnosis_data['patient_id']);
	}

	public function update_diagnosis($diagnosis_id, $diagnosis_data) {
		$this->save($diagnosis_data, array(
			'id' => intval($diagnosis_id)
		));
	}

	public function get_patient_diagnosis($patient_id) {
		$patient = model('Patient');
		$patient_diagnosis['patient_info'] = $patient->get_patient_info($patient_id);
		$patient_diagnosis['diagnosis_list'] = $this->where(array(
			'patient_id' => intval($patient_id)
		))->order('time desc')->select();

		return $patient_diagnosis;
	}

	public function get_grouped_diagnosis_list($patient_id = null) {
		$diagnosis_grouped_list = array();
		if($patient_id) {
			$diagnosis_grouped_list[$patient_id] = $this->get_patient_diagnosis($patient_id);
		} else {
			// get patient ids

			$patient_ids = $this->distinct(true)->field('patient_id')->column('patient_id');

			foreach ($patient_ids as $patient_id) {
				$diagnosis_grouped_list[$patient_id] = $this->get_patient_diagnosis($patient_id);
			}
		}

		return $diagnosis_grouped_list;
	}

	public function get_diagnosis_list() {
		$diagnosis_list = $this->where(array(
		))->order('time desc, patient_id')->select();

		$patient = model('Patient');
		foreach ($diagnosis_list as $key => $value) {
			$diagnosis_list[$key]['patient_info'] = $patient->get_patient_info($value['patient_id']);
		}

		return $diagnosis_list;
	}

	public function update_diagnosis_count($patient_id) {
		$count = $this->where(array(
			'patient_id' => intval($patient_id)
		))->count();

		$patient = model('Patient');
		$patient->update_diagnosis_count($patient_id, $count);
	}

	public function delete_diagnosis($diagnosis_id) {
		$diagnosis_info = $this->get_diagnosis_info($diagnosis_id);
		$patient_id = $diagnosis_info['patient_id'];

		$this->destroy(array(
			'id' => intval($diagnosis_id)
		));

		$this->update_diagnosis_count($patient_id);
	}
}