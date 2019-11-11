<?php

namespace Member\Form;

use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

use Member\Form\MedicalRecordFilter;

class MedicalRecordForm extends Form
{
  public function __construct(Adapter $dbAdapter, $hospitalMapper)
  {
    parent::__construct('medical-record-add');
    $this->setInputFilter(new MedicalRecordFilter($dbAdapter));
    $this->setAttribute('method', 'post');
    $this->setHydrator(new ClassMethods());

    $this->add([
      'name' => 'patient_public_address',
      'type' => 'text',
      'options' => [
        'label' => 'Patient Public Address',
      ],
      'attributes' => [
        'class' => 'form-control form-control-user',
        'id' => 'patient_public_address',
        'placeholder' => 'Patient Public Address',
        'readonly' => 'readonly',
      ],
    ]);

    $this->add([
      'name' => 'doctor_public_address',
      'type' => 'text',
      'options' => [
        'label' => 'Doctor Public Address',
      ],
      'attributes' => [
        'class' => 'form-control form-control-user',
        'id' => 'doctor_public_address',
        'placeholder' => 'Doctor Public Address',
        'readonly' => 'readonly',
      ],
    ]);

    $this->add([
      'name' => 'doctor',
      'type' => 'text',
      'options' => [
        'label' => 'Doctor',
      ],
      'attributes' => [
        'class' => 'form-control form-control-user',
        'id' => 'doctor',
        'placeholder' => 'Doctor',
        'readonly' => 'readonly',
      ],
    ]);

    $this->add(array(
	    'name' => 'hospital_id',
	    'type' => 'Select',
	    'attributes' => array(
        'class' => 'form-control',
        'id' => 'hospital_id',
        'options' => $this->_getHospitals($hospitalMapper),
        'required' => 'required',
	    ),
	    'options' => array(
        'label' => 'Hospital',
	    ),
		));

    $this->add([
      'name' => 'diagnostics',
      'type' => 'textarea',
      'options' => [
        'label' => 'Diagnostics',
      ],
      'attributes' => [
        'class' => 'form-control form-control-user',
        'id' => 'diagnostics',
        'placeholder' => 'Diagnostics',
        'onkeyup' => 'countChar(this)',
      ],
    ]);

    $this->add([
      'name' => 'prescriptions',
      'type' => 'textarea',
      'options' => [
        'label' => 'Prescriptions',
      ],
      'attributes' => [
        'class' => 'form-control form-control-user',
        'id' => 'prescriptions',
        'placeholder' => 'Prescriptions',
      ],
    ]);

    $this->add([
      'name' => 'submit',
      'type' => 'submit',
      'attributes' => [
        'value' => 'Submit',
        'class' => 'btn btn-primary',
      ],
    ]);
  }

  private function _getHospitals($hospitalMapper){
    $hospitals = array(
      '' => 'Select Hospital',
    );
    $filter = array();
    $order = array(
      'name',
    );
    $temp = $hospitalMapper->fetch(false, $filter, $order);
    foreach ($temp as $hospital){
      $hospitals[$hospital->getId()] = $hospital->getName();
    }

    return $hospitals;
	}
}
