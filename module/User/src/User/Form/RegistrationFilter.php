<?php

namespace User\Form;

use Zend\Db\Adapter\Adapter;
use Zend\InputFilter\InputFilter;

class RegistrationFilter extends InputFilter
{
  public function __construct(Adapter $dbAdapter)
  {
    $this->add(array(
	    'name' => 'role',
	    'required' => true,
	    'validators' => array(
        array(
          'name' => 'InArray',
          'options' => array(
            'haystack' => array('admin', 'doctor', 'patient'),
          ),
        ),
	    ),
		));

    $this->add([
      'name' => 'public_address',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 255,
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'first_name',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 255,
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'middle_name',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 255,
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'last_name',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 255,
          ],
        ],
      ],
    ]);

    $this->add(array(
	    'name' => 'gender',
	    'required' => true,
	    'validators' => array(
        array(
          'name' => 'InArray',
          'options' => array(
            'haystack' => array('m', 'f'),
          ),
        ),
	    ),
		));

    $this->add([
      'name' => 'title',
      'required' => false,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 255,
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'email',
      'required' => true,
      'filters' => [
          ['name' => 'StripTags'],
          ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 100,
          ],
        ],
        [
          'name' => 'EmailAddress',
          'options' => [
            'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
            'useMxCheck' => false,
          ],
        ],
        [
          'name' => 'Zend\Validator\Db\NoRecordExists',
          'options' => [
            'adapter' => $dbAdapter,
            'table' => 'user',
            'field' => 'email',
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'password',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 5,
            'max' => 255,
          ],
        ],
        [
          'name'    => 'Identical',
          'options' => [
            'token' => 'confirm_password',
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'confirm_password',
      'required' => true,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 5,
            'max' => 255,
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'birth_date',
      'required' => true,
    ]);

    $this->add([
      'name' => 'city',
      'required' => false,
      'filters' => [
        ['name' => 'StripTags'],
        ['name' => 'StringTrim'],
      ],
      'validators' => [
        [
          'name' => 'StringLength',
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 5,
            'max' => 255,
          ],
        ],
      ],
    ]);

    $this->add([
      'name' => 'country_id',
      'required' => true,
    ]);

    $this->add(array(
	    'name' => 'photo',
	    'required' => false,
		));
  }
}
