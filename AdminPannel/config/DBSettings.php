<?php
//INSTALL FLYWEB
class DatabaseSettings
{
	var $settings;
	function getSettings()
	{
		// install
		// Database variables
		// Host name
		$settings['dbhost'] = 'install_db_host';//'install_db_host';
		// Database name
		$settings['dbname'] = 'install_db_name';//'install_db_name';
		// Username
		$settings['dbusername'] = 'install_db_user';//'install_db_user';
		// Password 
		$settings['dbpassword'] = 'install_db_password';//'install_db_password';

		return $settings;
	}
} 

