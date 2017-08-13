<?php
class ServerInfo {

	public $CONFIG;

	public function __construct($conf){
		$this->CONFIG = $conf;
	}

	// Get Server Configuration 
	public function serverConfiguration() {
	    return array(
	        'php_version' => phpversion(),
	        'apache_version' => apache_get_version(),
	        'mysql_version' => $this->mysqlVersion(),
	        'mysql_status' => $this->mysqlStatus_formating(),
	        'zend_version' => zend_version(),
	        'operating_system' => php_uname(),
	    );
	}

	public function serverLoadedFiles() {
		return array(
			'php_ini' => php_ini_loaded_file(),
			'other_ini' => php_ini_scanned_files(),
		);
	}

	public function apacheConfFiles() {
		return array(
			'Mac OSX' => '/etc/apache2/httpd.conf',
			'CentOS' => '/etc/httpd/conf/httpd.conf',
			'XAMPP' => '/Applications/XAMPP/etc/httpd.conf',
			'Search' => '$ sudo find / -name httpd.conf',
		);
	}

	public function virtualHostFile(){
		$output = array(
			'Mac OSX' => '/etc/apache2/extra/httpd-vhosts.conf',
			'CentOS' =>'/etc/httpd/conf/extra/httpd-vhosts.conf',
			'Ubuntu' => '/etc/apache2/sites-available/000-default.conf',	
		);

		if(!empty($this->CONFIG['VHOST'])){
			$addn= array('Your Setting' => $this->CONFIG['VHOST']);
			$output = array_merge($addn, $output);
		}

		return $output;
	}

	public function terminalCommands(){
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
	public function getHostFileContent(){
		$file = !empty($this->CONFIG['HOSTS'])? $this->CONFIG['HOSTS'] : '/etc/hosts';

		if (file_exists($file)) {
			return trim(htmlentities(file_get_contents($file, FILE_USE_INCLUDE_PATH)));
		}
		return 'Unable to find hosts file.';
	}

	// Get Virtual host file content
	public function getVhostFileContent(){
		$file = !empty($this->CONFIG['VHOST'])? $this->CONFIG['VHOST'] : 
			'/etc/apache2/extra/httpd-vhosts.conf';

		if (file_exists($file)) {
			return trim(htmlentities(file_get_contents($file, FILE_USE_INCLUDE_PATH)));
		}
		return 'Unable to find hosts file.';
	}

	// Get Project lists
	public function getProjectList() {
		$path = !empty($this->CONFIG['PROJECT_DIR'])? $this->CONFIG['PROJECT_DIR'].'/' : '../';
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
	public function formatExtension($array) {
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
	public function mysqlCon() {
		$host = !empty($this->CONFIG['DB']['HOST'])? $this->CONFIG['DB']['HOST'] : 'localhost';
		$user = !empty($this->CONFIG['DB']['USER'])? $this->CONFIG['DB']['USER'] : 'root';
		$password = !empty($this->CONFIG['DB']['PASSWORD'])? $this->CONFIG['DB']['PASSWORD'] : '';
		
		//echo $this->CONFIG['PASSWORD'];die();
		@$mysqli = new mysqli($host, $user, $password);
		return $mysqli;
	}

	// Get Mysql database connection status
	public function mysqlStatus() {
		$mysqli = $this->mysqlCon();
		
		// check connection 
		if (mysqli_connect_errno()) {
		    return false;
		}
		return true;
	}

	// Get mysql server version 
	public function mysqlVersion() {
		$mysqli = $this->mysqlCon();
		
		if (mysqli_connect_errno()) {
		    return 'Not Available :(';
		}

		$version = $mysqli->server_info;
		$mysqli->close();
		return $version; 
	}

	public function mysqlStatus_formating(){
		$color = "green";
		$text = "Running";

		if (!$this->mysqlStatus()) {
		    $color = "red";
		    $text = "Not Running";
		} 

		return 'Status <span class="fa fa-circle" style="color: '.$color.'"> '.$text.'</span>';
	}
}