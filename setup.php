<?php
if(isset($_POST['btn_setup'])) {
	// $myfile = fopen("config1.php", "+a") or die("Unable to create file! Check file permission");

	$data = "<?php return array(
				'VHOST' => '".filter_input(INPUT_POST, 'vhost_dir', FILTER_SANITIZE_STRING)."',
				'HOSTS' => '".filter_input(INPUT_POST, 'hosts_dir', FILTER_SANITIZE_STRING)."',
				'PROJECT_DIR' => '".filter_input(INPUT_POST, 'project_dir', FILTER_SANITIZE_STRING)."',
				'DB' => array(
					'USER' => '".filter_input(INPUT_POST, 'db_user', FILTER_SANITIZE_STRING)."',
					'PASSWORD' => '".filter_input(INPUT_POST, 'db_password', FILTER_SANITIZE_STRING)."',
					'HOST' => '".filter_input(INPUT_POST, 'db_host', FILTER_SANITIZE_STRING)."',
					),
			);\n";

	file_put_contents("./config/config.php", $data) or die("Unable to create file! Check file permission");
	
	if(file_exists('./config/config.php')){
		$msg = "File Created! Go to <a href='index.php'>HomePage</a>";
	} else {
		$msg = "Unable create file";
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Setup Configuration</title>
        <style type="text/css">
        	h1{
        		border-bottom: 1px solid #0b95ba;
        	}
        	table{
        		width: 700px
        	}
        	table input{
        		width: 300px;
        		border: 1px solid #0b95ba;
        		height: 30px;
        		border-radius: 4px;
        		padding: 4px;
        		font-size: 14px;
        		color: #498b0e;
        	}

        	table input:focus{
        		border: 1px solid #ba420b;
        	}

        	form table input[type=submit] {
        		line-height: 30px;
        		height: 40px;
        		width: 310px;
        		background-color: #0081C6;
				border-color: #005E90;
				color: #FFFFFF;
				cursor: pointer;
        	}

        	form table input[type=submit]:hover {
        		background-color: #005E90;
				border-color: #0081C6;
        	}
        </style>
    </head>
    <body>
		<div style="width: 700px; margin:0 auto;">
			<h1>Setup Configuration</h1>

			<?php if(isset($msg)) {
				echo "<h2>".$msg."</h2>";
			}
			?>
			<form name="frm_setup" action="" method="post">
				<table>
				    <tr>
				        <td><label>Project Directory</label></td>
				        <td><input type="text" name="project_dir" required="true" placeholder="/var/www/html"></td>
				    </tr>
				    <tr>
				        <td><label>Virtual Host File (Optional)</label></td>
				        <td><input type="text" name="vhost_dir" placeholder="/etc/apache2/extra/httpd-vhosts.conf"></td>
				    </tr>
				    <tr>
				        <td><label>Hosts File (Optional)</label></td>
				        <td><input type="text" name="hosts_dir" placeholder="/etc/hosts"></td>
				    </tr>
				    <tr>
				        <td><label>Database Host</label></td>
				        <td><input type="text" value="localhost" name="db_host" required="true"></td>
				    </tr>
				    <tr>
				        <td><label>Database User</label></td>
				        <td><input type="text" value="root" name="db_user" required="true"></td>
				    </tr>
				    <tr>
				        <td><label>Database Password</label></td>
				        <td><input type="text" value="" name="db_password"></td>
				    </tr>
				    <tr>
				    	<td></td>
				        <td><input type="submit" name="btn_setup" value="Submit"></td>
				    </tr>
				</table>
			</form>

		</div>        
    </body>
</html>

