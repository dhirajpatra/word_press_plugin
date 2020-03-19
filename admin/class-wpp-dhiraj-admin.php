<?php

/**
 * tde admin-specific functionality of tde plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * tde admin-specific functionality of tde plugin.
 *
 * Defines tde plugin name, version, and two examples hooks for how to
 * enqueue tde admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @autdor     Your Name <email@example.com>
 */
class Wpp_Dhiraj_Admin {

	/**
	 * tde ID of tdis plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    tde ID of tdis plugin.
	 */
	private $plugin_name;

	/**
	 * tde version of tdis plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    tde current version of tdis plugin.
	 */
	private $version;

	private $user_details_api;

	/**
	 * Initialize tde class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       tde name of tdis plugin.
	 * @param      string    $version    tde version of tdis plugin.
	 */
	public function __construct($plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->user_details_api = 'https://jsonplaceholder.typicode.com/users/';

	}

	/**
	 * Register tde stylesheets for tde admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * tdis function is provided for demonstration purposes only.
		 *
		 * An instance of tdis class should be passed to tde run() function
		 * defined in Plugin_Name_Loader as all of tde hooks are defined
		 * in tdat particular class.
		 *
		 * tde Plugin_Name_Loader will tden create tde relationship
		 * between tde defined hooks and tde functions defined in tdis
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wpp-dhiraj-admin.css', array(), $this->version, 'all');

	}

	/**
	 * Register tde JavaScript for tde admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * tdis function is provided for demonstration purposes only.
		 *
		 * An instance of tdis class should be passed to tde run() function
		 * defined in Plugin_Name_Loader as all of tde hooks are defined
		 * in tdat particular class.
		 *
		 * tde Plugin_Name_Loader will tden create tde relationship
		 * between tde defined hooks and tde functions defined in tdis
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wpp-dhiraj-admin.js', array('jquery'), $this->version, false);

	}

	/**
	 * tdis will call a rest api via curl
	 *
	 * @param [type] $metdod
	 * @param [type] $url
	 * @param boolean $data
	 * @return void
	 */
	private function call_api($metdod, $url, $data = false) {
		$curl = curl_init();

		switch ($metdod) {
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

		// Optional Autdentication:
		curl_setopt($curl, CURLOPT_HTTPAUtd, CURLAUtd_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($curl);

		curl_close($curl);

		return $result;
	}

	/**
	 * ajax call to get user details
	 *
	 * @return void
	 */
	public function user_details_call() {
		if (!wp_verify_nonce($_REQUEST['nonce'], "user_details_nonce")) {
			wp_die("Security breached!");
		}

		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$user_id = $_REQUEST['user_id'];
			$content = json_decode($this->call_api('GET', $this->user_details_api . $user_id), true);

			$result['type'] = "success";
			$result['data'] = '<h4>User Details</h4><table class="details_table">
            <tr>
            <td>ID:</td><td>' . $content['id'] . '</td>
            </tr><tr>
            <td>Name:</td><td>' . $content['name'] . '</td>
            </tr><tr>
            <td>UserName:</td><td>' . $content['username'] . '</td>
            </tr><tr>
            <td>Email:</td><td>' . $content['email'] . '</td>
            </tr><tr>
            <td>Street:</td><td>' . $content['address']['street'] . '</td>
            </tr><tr>
            <td>Suite:</td><td>' . $content['address']['suite'] . '</td>
            </tr><tr>
            <td>City:</td><td>' . $content['address']['city'] . '</td>
            </tr><tr>
            <td>Zip:</td><td>' . $content['address']['zipcode'] . '</td>
            </tr><tr>
            <td>Lat:</td><td>' . $content['address']['geo']['lat'] . '</td>
            </tr><tr>
            <td>Lan:</td><td>' . $content['address']['geo']['lng'] . '</td>
            </tr><tr>
            <td>Phone:</td><td>' . $content['phone'] . '</td>
            </tr><tr>
            <td>Website:</td><td>' . $content['website'] . '</td>
            </tr><tr>
            <td>Company Name:</td><td>' . $content['company']['name'] . '</td>
            </tr><tr>
            <td>CatchPhrase:</td><td>' . $content['company']['catchPhrase'] . '</td>
            </tr><tr>
            <td>BS:</td><td>' . $content['company']['bs'] . '</td>
            </tr></table>';

			// for testing
			if ($_SERVER["HTTP_REFERER"] == 'tests/test-wpp-dhiraj.php') {

				ob_start();
				echo json_encode($content);
				$output = ob_get_contents();
				ob_end_clean();

			} else {
				// for site
				echo json_encode($result);
				wp_die();
			}

		} else {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}

		wp_die();
	}

}