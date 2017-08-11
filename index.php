<?php 
// Load required functions
include 'function.php';

// Get project list
$projects = getProjectList();

// PHP loaded
$phploadedext = get_loaded_extensions(); 
$phploadedext_html = formatExtension($phploadedext);


// Apache modules
$apache_modules = apache_get_modules();
$apache_modules_html = formatExtension($apache_modules);
$server_address = apache_getenv("SERVER_ADDR");

$server_info = serverConfiguration();
$loaded_file = serverLoadedFiles();

// Apache paths
$apache_files = apacheConfFiles();
$apache_vhosts = virtualHostFile();


// Terminal command
$terminal_command = terminalCommands();

// Host file content
$host_content = getHostFileContent();

//Load view page
include 'view.php';