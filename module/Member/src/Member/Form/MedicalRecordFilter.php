<?php

namespace Member\Form;

use Zend\Db\Adapter\Adapter;
use Zend\InputFilter\InputFilter;

class MedicalRecordFilter extends InputFilter
{
  public function __construct(Adapter $dbAdapter)
  {
    $this->add(array(
	    'name' => 'patient_public_address',
	    'required' => true,
		));

    $this->add(array(
	    'name' => 'doctor_public_address',
	    'required' => true,
		));

    $this->add(array(
	    'name' => 'doctor',
	    'required' => true,
		));

    $this->add(array(
	    'name' => 'hospital_id',
	    'required' => true,
		));

    $this->add([
      'name' => 'diagnostics',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
    ]);

    $this->add([
      'name' => 'prescriptions',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
    ]);
  }
}
