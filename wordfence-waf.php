<?php
// Before removing this file, please verify the PHP ini setting `auto_prepend_file` does not point to this.

if (file_exists('/home3/ai4atm/ai4atm-main/wp-content/plugins/wordfence/waf/bootstrap.php')) {
	define("WFWAF_LOG_PATH", '/home3/ai4atm/ai4atm-main/wp-content/wflogs/');
	include_once '/home3/ai4atm/ai4atm-main/wp-content/plugins/wordfence/waf/bootstrap.php';
}
?>