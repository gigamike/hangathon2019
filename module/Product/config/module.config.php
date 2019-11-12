<?php
return array(
		'controllers' => array(
			'invokables' => array(
				'Product\Controller\Index' => 'Product\Controller\IndexController',
			),
		),
		'view_manager' => array(
				'template_path_stack' => array(
						'product' => __DIR__ . '/../view',
				),
		),
);
