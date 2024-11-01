<?php
/**
 * Created by Share5s Team.
 * Date: 4/20/2019
 * Time: 9:18 PM
 */
if (!defined('ABSPATH')) exit();
class Curl {

	public static function get($url, $params = null) {

		/*if ($params) {
			$url .= '?';
			foreach ( $params as $key => $param ) {
				$url .= '&'.$key . '='. urlencode($param);
			}
		}*/
		$args = array(
			'body' => $params,
		);

		$response = wp_remote_get($url, $args);
		$response = wp_remote_retrieve_body($response);
		return json_decode($response);
	}

	public static function post($url, $params = null) {

		/*if ($params) {
			$post_str = '';
			foreach ( $params as $key => $param ) {
				$post_str .= '&'.$key . '='. urlencode($param);
			}
		}*/
		$args = array(
			'body' => $params,
		);
		$response = wp_remote_post($url, $args);
		$response = wp_remote_retrieve_body($response);
		return json_decode($response);
	}


}