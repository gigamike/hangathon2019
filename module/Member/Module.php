<?php
namespace Member;

use Hospital\Model\HospitalMapper;
use Member\Model\MedicalRecordMapper;
use Member\Form\MedicalRecordForm;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
      return array(
        'Zend\Loader\StandardAutoloader' => array(
          'namespaces' => array(
            __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
          ),
        ),
      );
    }

    public function getServiceConfig()
    {
    	return array(
  			'factories' => array(
          'MedicalRecordMapper' => function ($sm) {
            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
            $mapper = new MedicalRecordMapper($dbAdapter);
            return $mapper;
          },
          'MedicalRecordForm' => function ($sm) {
            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

            $hospitalMapper = new HospitalMapper($dbAdapter);

            $form = new MedicalRecordForm($dbAdapter, $hospitalMapper);
            return $form;
          },
  			),
    	);
    }
}
