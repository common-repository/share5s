<?php
/**
 * Created by Share5s Team.
 * Date: 4/20/2019
 * Time: 9:18 PM
 */
if (!defined('ABSPATH')) exit();

include_once(ABSPATH . WPINC .'/pluggable.php');

class CShare5s {

	public function __construct() {
		add_action('admin_init', array(&$this, 'init'));
	}

	public function init() {

		if (current_user_can('edit_others_posts')) {
			$this->page_setting();
			$this->create_media_tab();
			$ajax = new Share5s_Ajax();
			$ajax->init();

			add_action( 'admin_menu', array( &$this, 'create_menu' ) );
		}

	}

	public function page_setting() {
		register_setting( 'share5s-settings', 'share5s_username');
		register_setting( 'share5s-settings', 'share5s_password');
	}

	public function create_menu() {
		add_menu_page(__('Share5s Settings', 'share5s'), 'Share5s', 'administrator', 'share5s-settings', array(&$this, 'settings_page'), plugins_url('share5s/images/icon.png'), 10);
		add_submenu_page('upload.php', __('Load form Share5s', 'share5s'), 'Share5s', 'manage_options', 'share5s-load', array(&$this, 'share5s_load_media'));
	}

	public function settings_page() {
		$user = get_option('share5s_username');
		$pass = get_option('share5s_password');

		if ($user && $pass) {
			$api = new Share5S_API($user, $pass);
			$login = $api->login($user, $pass);
			if ($login->status === 'error') {
				$this->reset_option();
			}
		}

		include __DIR__ . '/../templates/setting.php';
	}

	public function was_setting() {
		$user = get_option('share5s_username');
		$pass = get_option('share5s_password');

		if ($user && $pass) {
			return true;
		}

		return false;
	}

	public function reset_option() {
		delete_option('share5s_username');
		delete_option('share5s_password');
	}

	public function create_media_tab() {

		if ($this->was_setting()) {
			add_action('admin_enqueue_scripts', array(&$this, 'share5s_admin_script'));
		}
	}

	public function share5s_admin_script() {
		wp_enqueue_script( 'share5s-script-admin', plugins_url('/styles/js/admin.js', SHARE5S_PLUGIN_FILE), array( 'jquery' ), '1.0', true);

		wp_enqueue_script( 'share5s-script-resumable', plugins_url('/styles/js/resumable.js', SHARE5S_PLUGIN_FILE), array( 'jquery' ), '', true);

		$translation_array = array(
			'ajaxurl' => admin_url('admin-ajax.php', $protocol),
			'ajax_nonce' => wp_create_nonce('share5s_nonce'),
			'uploadurl' => 'https://download.share5s.com/api/v1/upload/resumable.json',
			'delete_question' => __( 'Are you sure you want to delete the selected files?', 'share5s' ),
			'no_selected' => __('No files selected', 'share5s'),
			'file_folder_link' => __('Link Files & Folder'),
			'add_folder' => __('Add Folder', 'share5s'),
			'loading' => __('Loading...', 'share5s'),
		);

        wp_localize_script('share5s-script-admin', 'langvars', $translation_array);
		wp_enqueue_style('share5s-style-adminf1', plugins_url('/styles/css/fonts.css', SHARE5S_PLUGIN_FILE), false, '1.1');
		wp_enqueue_style('share5s-style-adminf2', plugins_url('/styles/font-icons/entypo/css/entypo.css', SHARE5S_PLUGIN_FILE), false, '1.1');
		wp_enqueue_style('share5s-style-adminf3', plugins_url('/styles/font-icons/font-awesome/css/font-awesome.min.css', SHARE5S_PLUGIN_FILE), false, '1.1');
		wp_enqueue_style('share5s-style-admin', plugins_url('/styles/css/admin.css', SHARE5S_PLUGIN_FILE), false, '1.1');
		wp_enqueue_style('share5s-style-modal', plugins_url('/styles/css/modal.css', SHARE5S_PLUGIN_FILE), false, '1.1');
	}

	public function share5s_load_media() {
		include __DIR__ . '/../templates/media.php';
	}
}