<!DOCTYPE html>
<html>
<head>
    <title>Localhost | <?php echo get_current_user();?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <!-- Header -->
    <header class="w3-container w3-theme w3-padding" id="myHeader">
        <div class="w3-center">
            <h4><?php echo get_current_user();?>@Localhost (<?php echo $server_address;?>)</h4>
            <h1 class="w3-xxxlarge w3-animate-bottom">PHP/ MySQL/ Apache</h1>
        </div>
    </header>
    <div class="w3-row-padding w3-center w3-margin-top">
        <div class="w3-third">
            <div class="w3-card-2 w3-container project" style="min-height:460px">
                <h3>Project</h3>
                <i class="fa fa-cubes w3-margin-bottom w3-text-theme" style="font-size:70px"></i>
                <?php
                if (!empty($projects)) {
                    ?>
                    <ul class="w3-ul w3-margin-bottom w3-hoverable w3-border">
                        <?php foreach ($projects as $project) {
                        echo "<li><span class='fa fa-folder'></span> <a href='../".$project."'>".ucwords($project)."</a></li>";
                    } ?>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="w3-third">
            <div class="w3-card-2 w3-container web-development" style="min-height:460px">
                <h3>Server Configuration</h3>
                <i class="fa fa-connectdevelop w3-margin-bottom w3-text-theme" style="font-size:70px"></i>
                <br />
                <ul class="w3-ul w3-margin-bottom">
                    <li>
                        <img src="img/php.png" alt="php-logo">
                        <?php echo $server_info['php_version'];?> |
                        <a href="phpinfo.php" class="label label-primary">View PHP INFO</a>
                    </li>
                    <li>
                        <img src="img/apache.png" alt="apache-logo">
                        <?php echo $server_info['apache_version'];?>
                    </li>
                    <li>
                        <img src="img/mysql.png" alt="mysql-logo">
                        <?php echo $server_info['mysql_version'];?> |
                        <?php echo $server_info['mysql_status'];?>
                    </li>
                    <li>
                        <b>Zend engine version</b>
                        <?php echo $server_info['zend_version'];?>
                    </li>
                    <li>
                        <b>Operating System</b>
                        <?php echo $server_info['operating_system']; ?>
                    </li>

                </ul>
            </div>
        </div>
        <div class="w3-third">
            <div class="w3-card-2 w3-container path-virtual-host" style="min-height:460px">
                <h3>Paths/ Virtual host</h3>
                <i class="fa fa-cogs w3-margin-bottom w3-text-theme" style="font-size:70px"></i>

                <ul class="w3-ul w3-margin-bottom">
                    <li>
                        <p>
                            <span class="fa fa-link"></span>
                            php.ini
                            <span>
                                <?php echo $loaded_file['php_ini'];?>
                            </span>
                        </p>
                    </li>
                    <li>
                        <h4><span class="fa fa-link"></span> Apache httpd.conf</h4>

                        <?php
                        foreach ($apache_files as $key => $file) {
                            echo '<p>'.$key.' <span>'.$file.'</span></p>';
                        }
                        ?>

                    </li>

                    <li>
                        <h4><span class="fa fa-motorcycle"></span> Apache VirtualHost</h4>

                        <?php
                        foreach ($apache_vhosts as $key => $file) {
                            echo '<p>'.$key.' <span>'.$file.'</span></p>';
                        }
                        ?>

                    </li>

                    <li>
                        <h4><span class="fa fa-bolt"></span> Useful Command</h4>

                        <?php
                        foreach ($terminal_command as $key => $val) {
                            echo '<p>'.$key.' <span>'.$val.'</span></p>';
                        }
                        ?>
                        <div>PS: Depending on OS version, apachectl command can be used as 'service apache2 restart' or '/etc/init.d/apache2 restart'. </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <hr>

    <!-- Tabs -->
    <h2 class="w3-center">More Info...</h2>
    <div class="w3-border">
        <!-- Tab menus -->
        <div class="w3-bar w3-theme">
            <button class="w3-bar-item w3-button testbtn w3-padding-16 w3-dark-grey" onclick="openCity(event,'virtualhost')">Apache Vhost</button>
            <button class="w3-bar-item w3-button testbtn w3-padding-16" onclick="openCity(event,'httpdconf')">Apache Httpd.Conf</button>
            <button class="w3-bar-item w3-button testbtn w3-padding-16" onclick="openCity(event,'apachemodules')">Apache Loaded Modules</button>
            <button class="w3-bar-item w3-button testbtn w3-padding-16" onclick="openCity(event,'phpmodules')">PHP Loaded Extensions</button>
            <button class="w3-bar-item w3-button testbtn w3-padding-16 w3-dark-grey" onclick="openCity(event,'hosts')">Hosts</button>
        </div>

        <!-- Tab page content -->
        <!-- Apache Virtualhost -->
        <div id="virtualhost" class="w3-container city w3-animate-opacity" style="display: block;">
            <h2>Virtual Host File</h2>
            <pre><?php echo $virtualhost_content;?></pre>
        </div>

        <!-- Apache HTTPD -->
        <div id="httpdconf" class="w3-container city w3-animate-opacity" style="display: none;">
            <h2>Apache httpd.Conf</h2>
            <pre><?php echo $apacheConfig_content; ?></pre>
        </div>

        <!-- Apache Modules -->
        <div id="apachemodules" class="w3-container city w3-animate-opacity" style="display: none;">
            <h2>Loaded Modules</h2>
            <?php echo $apache_modules_html;?>
            <br />
        </div>

        <!-- PHP Modules -->
        <div id="phpmodules" class="w3-container city w3-animate-opacity" style="display: none;">
            <h2>Enabled Extensions</h2>
            <?php echo $phploadedext_html;?>
            <br />
        </div>

        <!-- Host file content -->
        <div id="hosts" class="w3-container city w3-animate-opacity" style="display: block;">
            <h2>Host File</h2>
            <pre><?php echo $host_content;?></pre>
        </div>
        <br>
    </div>
    <br>

    <!-- Footer -->
    <footer class="w3-container w3-theme-dark w3-padding-16">
        <div>&copy; Localhost</div>
    </footer>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
    <script src="js/app.js"></script>
</body>
</html>
