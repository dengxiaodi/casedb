<?php
namespace app\casedb\controller;

use think\Controller;

class Index extends AdminController 
{
    public function index()
    {
    	$this->check_login();

    	$patient = model('Patient');
    	$patient_count = $patient->count();

    	$diagnosis = model('Diagnosis');
    	$diagnosis_count = $diagnosis->count();

    	$sample = model('Sample');
    	$sample_count = $sample->count();

    	$experiment = model('Experiment');
    	$experiment_count = $experiment->count();
    	
    	$this->assign('patient_count', $patient_count);
    	$this->assign('diagnosis_count', $diagnosis_count);
    	$this->assign('sample_count', $sample_count);
    	$this->assign('experiment_count', $experiment_count);

        return $this->fetch('index');
    }
}
