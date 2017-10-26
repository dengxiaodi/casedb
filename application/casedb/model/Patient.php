<?php

namespace app\casedb\model;

use think\Model;

class Patient extends Model
{
	protected $table = "patient";

	public function add_patient($patient_data) {
		$patient_data['create_time'] = time();
		$this->data($patient_data)->save();
	}

	public function update_patient($patient_id, $patient_data) {
		$this->save($patient_data, array(
			'id' => intval($patient_id)
		));
	}

	public function get_patient_info($patient_id) {
		return $this->where(array(
			'id' => intval($patient_id)
		))->find();
	}

	public function delete_patient($patient_id) {
		$this->destroy(array(
			'id' => intval($patient_id)
		));
	}

	public function get_patient_list() {
		return $this->where(array(
		))->select();
	}

	public function update_diagnosis_count($patient_id, $diagnosis_count) {
		$this->save(array(
			'diagnosis_count' => intval($diagnosis_count)
		), array(
			'id' => intval($patient_id)
		));
	}
}