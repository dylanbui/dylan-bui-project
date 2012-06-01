<?php
class SystemComponent {

var $settings;

function getSettings() {

// System variables
$settings['siteDir'] = '/path/to/your/intranet/';

// Database variables
$settings['dbhost'] = 'localhost';
$settings['dbusername'] = 'root';
$settings['dbpassword'] = '';
$settings['dbname'] = 'karaoke';

return $settings;

}

}
?>