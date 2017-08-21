<?php
// Rename to config.php if the file doesn't exist
// (incase setup.php does not work for you)

return array(
	'VHOST' => '',				// Virtual host file name eg. /etc/httpd/conf.d/myvirtualhost.conf
	'HOSTS' => '',				// Host file name eg. /etc/hosts
	'PROJECT_DIR' => '',		// Directory where your all project lives
	'DB' => array(		
		'USER' => 'root',	
		'PASSWORD' => '',
		'HOST' => 'localhost',
		),
);