<?php
/**
 * Plugin Name: Share5s - Upload, manage, sharing your file in free file hosting
 * Plugin URI: https://share5s.com
 * Description: Plugin by share5s.com upload, share and manage files in one simple to use file host
 * Version: 1.0
 * Author: Share5s Team
 * Author URI: https://www.facebook.com/share5scom/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

define( 'SHARE5S_API_URI', 'https://share5s.com/api/v2/' );
define( 'SHARE5S_PLUGIN_FILE', __FILE__ );

include __DIR__ . '/lib/Share5S_API.php';
include __DIR__ . '/lib/CShare5s.php';
include __DIR__ . '/ajax.php';


$share5s = new CShare5s();
$share5s->init();




