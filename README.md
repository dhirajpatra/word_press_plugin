# === Plugin Name ===

Contributors: dhirajpatra
Donate link: http://example.com/
Tags: comments, spam
Requires at least: 5.0.1
Tested up to: 5.3.2
Stable tag: 5.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a test wordpress plugin with tests to learn plugin development. You can use it as a bolierplate to develop a plugin.

# == Description ==

When installed, the plugin has to make available a custom endpoint on the WordPress site. With “custom endpoint” we mean an arbitrary URL not recognized by WP as a standard URL, like a permalink or so.

Note that this is not a REST endpoint.

When a visitor navigates to that endpoint, the plugin has to send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.

The plugin will parse the JSON response and will use it to build and display an HTML table.
If you want you can call this endpoint using AJAX, but that is optional.

Each row in the HTML table will show the details for a user. The column's id, name, and username are mandatory, but you can show more details if you want.

We don’t mind you to use any JavaScript, including 3rd party libraries, to improve the table look and feel. Things like client-side ordering and filtering, for example, are ok but not required.

The content of three mandatory columns must be a link (<a> tag). When a visitor clicks any of these links, the details of that user must be shown. For that, the plugin will do another API request to the user-details endpoint.


# == Installation ==

Kindly follow the installations steps below. After clone this repository to your development directory. 

1. Make a zip of whole folder after clone down 
2. Install this plugin via wordpress admin panel New Plugin installation. Upload the plugin zip file and click on install and activate.
3. or you can upload wpp-dhiraj.zip to the `/wp-content/plugins/` directory directly
4. Activate the plugin through the 'Plugins' menu in WordPress
5. Go to wordpress home page and refresh. To get all users lists from api. 
6. when you click on any of the link from any of the user's [id, name or username]. It will open user details hidden div above of user lists table.
7. To tests run `phpunit` inside the plugins/wpp-dhirah [plugin] folder

# == Screen Shots ==

![All Users](all_users.png?raw=true "All Users")
![User Details](user_details.png?raw=true "User Details")
![All Tests](all_tests.png?raw=true "All Tests")


# == Frequently Asked Questions ==

# == Changelog ==

= 1.0 =
* It is a new plugin.

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`