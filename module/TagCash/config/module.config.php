<?php
return array(
		'controllers' => array(
			'invokables' => array(
				'TagCash\Controller\Index' => 'TagCash\Controller\IndexController',
			),
		),
		'view_manager' => array(
				'template_path_stack' => array(
						'tag-cash' => __DIR__ . '/../view',
				),
		),
);
