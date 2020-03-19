<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    wpp-dhiraj
 * @subpackage wpp-dhiraj/public
 * @author     Dhiraj Patra <dhiraj.patra@gmail.com>
 */
class Wpp_Dhiraj_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->users_api = 'https://jsonplaceholder.typicode.com/users';

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wpp-dhiraj-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wpp-dhiraj-public.js', array('jquery'), $this->version, false);

		wp_localize_script($this->plugin_name, 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

	}

	/**
	 * this will call a rest api via curl
	 *
	 * @param [type] $method
	 * @param [type] $url
	 * @param boolean $data
	 * @return void
	 */
	private function call_api($method, $url, $data = false) {
		$curl = curl_init();

		switch ($method) {
		case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);

			if ($data) {
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			}

			break;
		case "PUT":
			curl_setopt($curl, CURLOPT_PUT, 1);
			break;
		default:
			if ($data) {
				$url = sprintf("%s?%s", $url, http_build_query($data));
			}

		}

		// Optional Authentication:
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($curl);

		curl_close($curl);

		return $result;
	}

	/**
	 * this will create table for all users
	 *
	 * @param [type] $content
	 * @return void
	 */
	private function create_table($content) {
		$nonce = wp_create_nonce("user_details_nonce");

		$modal = '<div id="details_modal" class="modal">
      </div>';

		$result = $modal . '<h4>All Users</h4><table class="details_table"><tr><th width="10%">ID</th><th width="30%">Name</th><th width="25%">UserName</th><th width="35%">Email</th></tr>';
		foreach ($content as $row) {
			$link = admin_url('admin-ajax.php?action=user_details_call&user_id=' . $row['id'] . '&nonce=' . $nonce);
			$result .= '<tr>
              <td><a class="user_details" data-nonce="' . $nonce . '" data-user_id="' . $row['id'] . '" href="' . $link . '">' . $row['id'] . '</a></td>
              <td><a class="user_details" data-nonce="' . $nonce . '" data-user_id="' . $row['id'] . '" href="' . $link . '">' . $row['name'] . '</a></td>
              <td><a class="user_details" data-nonce="' . $nonce . '" data-user_id="' . $row['id'] . '" href="' . $link . '">' . $row['username'] . '</a></td>
              <td>' . $row['email'] . '</td>
            </tr>';
		}

		$result .= '</table>';

		return $result;
	}

	/**
	 * this will call users api
	 *
	 * @return void
	 */
	public function fetch_users_api() {
		$content = json_decode($this->call_api('GET', $this->users_api), true);

		return $content;
	}

	/**
	 * this will create table to show all users
	 *
	 * @param string $content
	 * @return void
	 */
	public function show_users($content) {
		return $this->create_table($this->fetch_users_api());
	}

}