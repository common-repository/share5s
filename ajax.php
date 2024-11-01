<?php
/**
 * Created by Share5s Team.
 * Date: 4/20/2019
 * Time: 9:18 PM
 */
if (!defined('ABSPATH')) exit();
class Share5s_Ajax {

	public function init() {
		add_action('wp_ajax_share5s_ajax_request', array(&$this, 'ajax_request'));
	}

	public static function json_message($message, $status = 'success') {
		header('Content-Type: application/json');
		echo json_encode(['message' => $message, 'status' => $status]);
		exit();
	}

	public static function json_result($result_data) {
		header('Content-Type: application/json');
		echo json_encode($result_data);
		exit();
	}

	public function get_response($response) {
		if ($response == false) {
			self::json_message(__('login failed', 'share5s'), 'error');
		}

		if ($response->status == 'error') {
			self::json_message($response->response, 'error');
		}

		self::json_result($response);
		exit();
	}

	public function ajax_request() {

		check_ajax_referer('share5s_nonce', 'security');

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$action = sanitize_text_field($_POST['load']);
			if (empty($action)) {
				self::json_message(__('Invalid request', 'share5s'), 'error');
			}

			if (method_exists($this, $action)) {
				$this->{$action}();
				exit();
			}

			self::json_message(__('Invalid request', 'share5s'), 'error');
		}

		die();
	}

	private function load_modal() {

		$template = sanitize_text_field($_POST['template']);

		if ($template) {
			include __DIR__ . '/templates/'. $template . '.php';
			exit();
		}

		echo '';
	}

	private function load_folder() {

		$folder_id = (int) $_POST['folder_id'];
		$username = get_option('share5s_username');
		$password = get_option('share5s_password');

		if (empty($username) || empty($password)) {
			self::json_message(__('No setup', 'share5s'), 'error');
		}

		$api = new Share5S_API($username, $password);
		$response = $api->folder_listing($folder_id);
		$this->get_response($response);
	}

	private function delete_items() {
		$username = get_option('share5s_username');
		$password = get_option('share5s_password');

		if (empty($username) || empty($password)) {
			self::json_message(__('No setup', 'share5s'), 'error');
		}

		$files = (array) $_POST['files'];
		$folders = (array) $_POST['folders'];
		$api = new Share5S_API($username, $password);

		foreach ($files as $file) {
			$result = $api->remove_file($file);
		}

		foreach ($folders as $folder) {
			$result = $api->remove_folder($folder);
		}

		self::json_message('ok');
	}

	private function add_folder() {
		$username = get_option('share5s_username');
		$password = get_option('share5s_password');

		if (empty($username) || empty($password)) {
			self::json_message(__('No setup', 'share5s'), 'error');
		}

		$folderName = sanitize_text_field($_POST['folderName']);
		$isPublic = (int) $_POST['isPublic'];
		$enablePassword = (int) $_POST['enablePassword'];
		$parentId = (int) $_POST['parentId'];
		$folderPassword = md5($_POST['password']);

		$api = new Share5S_API($username, $password);
		$response = $api->add_folder($folderName, $parentId, $isPublic, $folderPassword);
		$this->get_response($response);
	}

	private function before_upload_setup() {
		$username = get_option('share5s_username');
		$password = get_option('share5s_password');

		if (empty($username) || empty($password)) {
			self::json_message(__('No setup', 'share5s'), 'error');
		}

		$current_folder = (int) $_POST['current_folder'];
		$api = new Share5S_API($username, $password);
		$response = $api->before_upload($current_folder);
		$this->get_response($response);
	}

	private function after_upload_setup() {
		$username = get_option('share5s_username');
		$password = get_option('share5s_password');

		if (empty($username) || empty($password)) {
			self::json_message(__('No setup', 'share5s'), 'error');
		}

		$current_folder = (int) $_POST['current_folder'];
		$api = new Share5S_API($username, $password);
		$response = $api->after_upload($current_folder);
		$this->get_response($response);
	}
}

