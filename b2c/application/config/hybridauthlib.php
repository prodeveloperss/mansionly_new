<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/hauth/endpoint',

		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => true
			),

			"Yahoo" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array (
				"enabled" => true
			),

			"Google" => array (
				"enabled" => true,
				//"keys"    => array ( "id" => "719244979715-jf7qdc04ak6mto6btcil2r4o9mdkclil.apps.googleusercontent.com", "secret" => "UDjtpydNVf0JYn16Z7isaxU3" ),
				"keys"    => array ( "id" => "54451932076-r5mon0nttqchdkqcqb8vhrrd8thll183.apps.googleusercontent.com", "secret" => "hZzsnIma8hmCly8NHpAKkk-K" )
			),

			"Facebook" => array (
				"enabled" => true,
				//"keys"    => array ( "id" => "1461654683851364", "secret" => "a75d28832fa753c8f23429fe9c2ea81e" ),
				"keys"    => array ( "id" => "1868156570090678", "secret" => "73f81502b8eed03995df3af38580c77b" )
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			// windows live
			"Live" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"LinkedIn" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => (ENVIRONMENT == 'development'),

		"debug_file" => APPPATH.'logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */