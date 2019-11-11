<?php
namespace Hospital;

use Hospital\Model\HospitalMapper;

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
					'HospitalMapper' => function ($sm) {
						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
						$mapper = new HospitalMapper($dbAdapter);
						return $mapper;
					},
  			),
    	);
    }
}
