<?php
// a11yc config path
define('A11YC_CONFIG_PATH', __DIR__.'/a11yc.php');

$config = array(
	'A11yc' => array(
		'models'	=> array(
			'Page' => array('Page', 'PageCategory'),
			'BlogPost' => array('BlogPost', 'BlogTag'),
		),
		'views' => array(
			'BlogPost' => array('controller'=> 'blog_posts', 'action' => 'admin_edit'),
			'Page' => array('controller'=> 'pages', 'action' => 'admin_edit')
		),
		'keys'	=> array(
			'Page' => 'contents',
			'BlogPost' => 'content',
		),
	),
);
