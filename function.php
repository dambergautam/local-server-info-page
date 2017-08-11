<?php

// Get Server Configuration 
function serverConfiguration() {
    return array(
        'php_version' => phpversion(),
        'apache_version' => apache_get_version(),
        'mysql_version' => mysqlVersion(),
        'mysql_status' => mysqlStatus_formating(),
        'zend_version' => zend_version(),
        'operating_system' => php_uname(),
    );
}

function serverLoadedFiles() {
	return array(
		'php_ini' => php_ini_loaded_file(),
		'other_ini' => php_ini_scanned_files(),
	);
}

function apacheConfFiles() {
	return array(
		'Mac OSX' => '/etc/apache2/httpd.conf',
		'CentOS' => '/etc/httpd/conf/httpd.conf',
		'XAMPP' => '/Applications/XAMPP/etc/httpd.conf',
		'Search' => '$ sudo find / -name httpd.conf',
	);
}

function virtualHostFile(){
	return array(
		'Mac OSX' => '/etc/apache2/extra/httpd-vhosts.conf',
		'CentOS' =>'/etc/httpd/conf/extra/httpd-vhosts.conf',
		'Ubuntu' => '/etc/apache2/sites-available/000-default.conf',	
	);
}

function terminalCommands(){
	return array(
		'PHP Directory' => '$ which php',
		'PHP Version' => '$ php -v',
		'PHP Modules' => '$ php -m',
		'Apache Version' => '$ apachectl -v',
		'Apache Modlues' => '$ apachectl -M',
		'Apace Virtualhost' => '$ apachectl -S',
		'Apache Restart' => '$ sudo apachectl restart'
	);
}

// Get host file content
function getHostFileContent(){
	$file = '/etc/hosts';

	if (file_exists($file)) {
		return file_get_contents($file, FILE_USE_INCLUDE_PATH);
	}
	return 'Unable to find hosts file.';
}

// Get Project lists
function getProjectList($user_path='') {
	$path = !empty($dir)? $user_path : '../';
	$files = array_diff(scandir($path), array('..', '.'));

	$output = array();
	foreach($files as $file){
		if(is_dir($path.$file)){
			$output[]= $file;
		}
	}
	return $output;
}

// Format php extensions
function formatExtension($array) {
	$html = "<div class='loaded-extensions'>";
	$html .="<div class='row'>";

	$i = 0;

	foreach ($array as $value) {
		if ($i > 0 && $i % 3 === 0) {
			$html .="</div><div class='row'>";
		}
		$html .= "<div class='col-md-4'><span class='fa fa-check' style='color:green;'></span> ".$value."</div>";
		$i++;
	}

	$html .= "</div></div>";
	return $html;
}



/**
 * MySQL 
 */

// Connect mysql database
function mysqlCon() {
	@$mysqli = new mysqli('localhost', 'root', 'Prakash123');
	return $mysqli;
}

// Get Mysql database connection status
function mysqlStatus() {
	$mysqli = mysqlCon();
	
	// check connection 
	if (mysqli_connect_errno()) {
	    return false;
	}
	return true;
}

// Get mysql server version 
function mysqlVersion() {
	$mysqli = mysqlCon();
	
	if (mysqli_connect_errno()) {
	    return 'Not Available :(';
	}

	$version = $mysqli->server_info;
	$mysqli->close();
	return $version; 
}

function mysqlStatus_formating(){
	$color = "green";
	$text = "Running";

	if (!mysqlStatus()) {
	    $color = "red";
	    $text = "Not Running";
	} 

	return 'Status <span class="fa fa-circle" style="color: '.$color.'"> '.$text.'</span>';
}
