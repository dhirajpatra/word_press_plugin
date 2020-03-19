<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin by Dhiraj
 * Plugin URI:        http://example.com/wpp-dhiraj/
 * Description:       This is not just a plugin. When a visitor navigate he will see all users in a table format. Clicking on any user it will show the details of that user.
 * Version:           1.0.0
 * Author:            Dhiraj Patra
 * Author URI:        https://dhriajpatra.github.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpp-dhiraj
 * Domain Path:       /languages
 *
 * Copyright 2020 DHJIRAJ PATRA (email : dhiraj.patra@gmail.com)
 * wpp-dhiraj is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * wpp-dhiraj is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with wpp-dhiraj. If not, see (http://link to your plugin license).
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WPP_DHIRAJ_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_wpp_dhiraj()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wpp-dhiraj-activator.php';
    Wpp_Dhiraj_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_wpp_dhiraj()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wpp-dhiraj-deactivator.php';
    Wpp_Dhiraj_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wpp_dhiraj');
register_deactivation_hook(__FILE__, 'deactivate_wpp_dhiraj');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wpp-dhiraj.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name()
{

    $plugin = new Wpp_Dhiraj();
    $plugin->run();
}
run_plugin_name();