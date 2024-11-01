<?php
/**
 * Created by Share5s Team.
 * Date: 4/20/2019
 * Time: 9:18 PM
 */
if (!defined('ABSPATH')) exit();
include_once __DIR__ . '/Curl.php';

class Share5S_API {
	public $logined = false;
	private $username;
	private $password;
	private $account_id;
	private $access_token;

	public function __construct($username = null, $password = null) {
		if ($username) {
			$this->username = $username;
		}

		if ($password) {
			$this->password = $password;
		}

		if ($this->username && $this->password) {
			$this->login($this->username, $this->password);
		}
	}

	public function login($username, $password) {

		if ($username) {
			$this->username = $username;
		}

		if ($password) {
			$this->password = $password;
		}

		if ($this->username && $this->password) {
			$params = ['username' => $this->username, 'password' => $this->password];
			$response = Curl::post(SHARE5S_API_URI . 'authorize', $params);
			if ($response->_status == 'success') {
				$this->access_token = $response->data->access_token;
				$this->account_id = $response->data->account_id;
				$this->logined = true;
			}

			return $response;
		}

		return false;
	}

	public function folder_listing($folder_id) {

		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'parent_folder_id' => $folder_id
			];

			$response = Curl::get(SHARE5S_API_URI . 'folder/listing', $params);
			return $response;
		}

		return false;
	}

	public function remove_file($file_id) {
		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'file_id' => $file_id
			];

			$response = Curl::get(SHARE5S_API_URI . 'file/delete', $params);
			return $response;
		}

		return false;
	}

	public function remove_folder($folder_id) {
		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'folder_id' => $folder_id
			];

			$response = Curl::get(SHARE5S_API_URI . 'folder/delete', $params);
			return $response;
		}

		return false;
	}

	public function move_folder($folder_id, $new_parent_folder_id) {
		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'folder_id' => $folder_id,
				'new_parent_folder_id' => $new_parent_folder_id
			];

			$response = Curl::get(SHARE5S_API_URI . 'folder/move', $params);
			return $response;
		}

		return false;
	}

	public function move_file($file_id, $new_parent_folder_id) {
		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'file_id' => $file_id,
				'new_parent_folder_id' => $new_parent_folder_id
			];

			$response = Curl::get(SHARE5S_API_URI . 'folder/move', $params);
			return $response;
		}

		return false;
	}

	public function add_folder($folder_name, $parent_id, $is_public, $access_password = null) {
		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'folder_name' => $folder_name,
				'parent_id' => $parent_id,
				'is_public' => $is_public,
				'access_password' => empty($access_password) ? '' : md5($access_password)
			];

			$response = Curl::get(SHARE5S_API_URI . 'folder/create', $params);
			return $response;
		}

		return false;
	}

	public function before_upload($folder_id) {
		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'folder_id' => $folder_id,
			];

			$response = Curl::get(SHARE5S_API_URI . 'file/before_upload', $params);
			return $response;
		}

		return false;
	}

	public function after_upload($folder_id) {
		if ($this->logined) {
			$params = [
				'access_token' => $this->access_token,
				'account_id' => $this->account_id,
				'folder_id' => $folder_id,
			];

			$response = Curl::get(SHARE5S_API_URI . 'file/after_upload', $params);
			return $response;
		}

		return false;
	}
}