<?php
return array(
		'controllers' => array(
			'invokables' => array(
				'Patient\Controller\Index' => 'Patient\Controller\IndexController',
			),
		),
		'view_manager' => array(
				'template_path_stack' => array(
						'patient' => __DIR__ . '/../view',
				),
		),
);
