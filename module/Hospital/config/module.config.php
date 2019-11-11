<?php
return array(
		'controllers' => array(
			'invokables' => array(
				'Hospital\Controller\Index' => 'Hospital\Controller\IndexController',
			),
		),
		'view_manager' => array(
				'template_path_stack' => array(
						'hospital' => __DIR__ . '/../view',
				),
		),
);
