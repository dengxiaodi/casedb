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
}