<?php 

if (!file_exists('./config/config.php')) {
	header('location:setup.php');
}

// Include config file
$CONFIG = (require_once('./config/config.php'));

// Load required functions
include 'ServerInfo.php';
$objSI = new ServerInfo($CONFIG);

// Get project list
$projects = $objSI->getProjectList();

// PHP loaded
$phploadedext = get_loaded_extensions(); 
$phploadedext_html = $objSI->formatExtension($phploadedext);


// Apache modules
$apache_modules = apache_get_modules();
$apache_modules_html = $objSI->formatExtension($apache_modules);
$server_address = apache_getenv("SERVER_ADDR");

$server_info = $objSI->serverConfiguration();
$loaded_file = $objSI->serverLoadedFiles();

// Apache paths
$apache_files = $objSI->apacheConfFiles();
$apache_vhosts = $objSI->virtualHostFile();


// Terminal command
$terminal_command = $objSI->terminalCommands();

// Host file content
$host_content = $objSI->getHostFileContent();

// Vurtual host file content
$virtualhost_content = $objSI->getVhostFileContent();

//Load view page
include 'view.php';