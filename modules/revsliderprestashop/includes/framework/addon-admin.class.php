<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       h
 * @since      1.0.0
 *
 * @package    Rev_addon
 * @subpackage Rev_addon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rev_addon
 * @subpackage Rev_addon/admin
 * @author     ThemePunch <info@themepunch.com>
 */
class Rev_addon_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
 		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
 
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rev_addon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rev_addon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if(isset($_GET["view"]) && $_GET["view"]=="rev_addon-admin-display"){
                  
			wp_enqueue_style('rs-plugin-settings', RS_PLUGIN_URL .'admin/assets/css/admin.css', array(), RevSliderGlobals::SLIDER_REVISION);
			wp_enqueue_style( $this->plugin_name, RS_PLUGIN_URL . 'admin/assets/css/rev_addon-admin.css', array( ), $this->version);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rev_addon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rev_addon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
 
		 if(isset($_GET["view"]) && $_GET["view"]=="rev_addon-admin-display"){
			wp_enqueue_script('tp-tools', RS_PLUGIN_URL .'public/assets/js/jquery.themepunch.tools.min.js', array(), RevSliderGlobals::SLIDER_REVISION );
			wp_enqueue_script('unite_admin', RS_PLUGIN_URL .'admin/assets/js/admin.js', array(), RevSliderGlobals::SLIDER_REVISION );
			wp_enqueue_script( $this->plugin_name, RS_PLUGIN_URL .'admin/assets/js/rev_addon-admin.js', array( 'jquery' ), $this->version, false );
			wp_localize_script( $this->plugin_name, 'rev_slider_addon', array(
					'ajax_url' => rev_site_admin_url()."?route=extension/module/revslideropencart/ajaxexecute&token=".sds_get_oc_token(), 
					'please_wait_a_moment' => __("Please Wait a Moment",'revslider'),
					'settings_saved' => __("Settings saved",'revslider')
				));
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		$this->plugin_screen_hook_suffix = add_submenu_page(
			'revslider',
			__( 'Add-Ons', 'revslider' ),
			__( 'Add-Ons', 'revslider' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_plugin_admin_page' )
		);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( RS_PLUGIN_PATH.'admin/views/rev_addon-admin-display.php' );
	}

	/**
	 * Activates Installed Add-On/Plugin
	 *
	 * @since    1.0.0
	 */
	public function activate_plugin() { 
            
                        
            
 			if(isset($_REQUEST['plugin'])){
                            
                                update_option($_REQUEST['plugin'],'active');
                                $hook_register = get_option('hook_register', array());
                                if(!empty($hook_register)){
                                  $hook_register = json_decode($hook_register,true); 
                                }
                                 
                                if(isset($hook_register[$_REQUEST['plugin']])){
                                    $hook_info = $hook_register[$_REQUEST['plugin']];
                                    if(is_array($hook_register[$_REQUEST['plugin']])){
                                        call_user_func_array(array($hook_info[0],$hook_info[1]),array());
                                    }else{
                                       require_once(RS_PLUGIN_ADDONS_PATH . $_REQUEST['plugin']);
                                        call_user_func_array($hook_register[$_REQUEST['plugin']],array());
                                    }
                                    
                                } 
				die( '1' );
			}
			else{
				die( '0' );
			}
 
	}

	/**
	 * Deactivates Installed Add-On/Plugin
	 *
	 * @since    1.0.0
	 */
	public function deactivate_plugin() {
		// Verify that the incoming request is coming with the security nonce
		//if( wp_verify_nonce( $_REQUEST['nonce'], 'ajax_rev_slider_addon_nonce' ) ) {
			if(isset($_REQUEST['plugin'])){
				//update_option( "rev_slider_addon_gal_default", sanitize_text_field($_REQUEST['default_gallery']) );
				//$result = deactivate_plugins( $_REQUEST['plugin'] );
				update_option($_REQUEST['plugin'],'deactive');
                                $hook_deregister = get_option('hook_deregister', array());
                                if(!empty($hook_deregister)){
                                $hook_deregister = json_decode($hook_deregister,true);
                                }
                                if(isset($hook_deregister[$_REQUEST['plugin']])){ 
                                    $hook_info = $hook_deregister[$_REQUEST['plugin']];
                                    if(is_array($hook_deregister[$_REQUEST['plugin']])){
                                        call_user_func_array(array($hook_info[0],$hook_info[1]),array());
                                    }else{
                                        require_once(RS_PLUGIN_ADDONS_PATH . $_REQUEST['plugin']);
                                        call_user_func_array($hook_deregister[$_REQUEST['plugin']],array());
                                    }
                                }
				die( '1' );
			}
			else{
				die( '0' );
			}
//		} 
//		else {
//			die( '-1' );
//		}
	}

	/**
	 * Install Add-On/Plugin
	 *
	 * @since    1.0.0
	 */
	public function install_plugin() {
		
			if(isset($_REQUEST['plugin'])){
				global $wp_version;
				$plugin_slug = basename($_REQUEST['plugin']);
				$plugin_result = false;
				$plugin_message = 'UNKNOWN';

				if(0 !== strpos($plugin_slug, 'revslider-')) die( '-1' );
                               
				$code = get_option('revslider-code', '');
                                
                                $url = 'http://updates.themepunch.tools/revslider-prestashop/addons/'.$plugin_slug.'/download.php?code='.$code.'&type='.$plugin_slug;
				
				$get = wp_remote_post($url, array(
					'user-agent' => 'Prestashop/'.$wp_version.'; '.get_bloginfo('url'),
					'body' => '',
					'timeout' => 400
				));
                               
                               
				if( $get == null || $get["info"]["http_code"] != "200" ){
				  $plugin_message = 'FAILED TO DOWNLOAD';
				}else{  
                                 //   var_dump($get);die();
					$plugin_message = 'ZIP is there';
					$upload_dir = wp_upload_dir();
					$file = $upload_dir. '/revslider/templates/' . $plugin_slug . '.zip';
                                       
					@mkdir(dirname($file));
					$ret = @file_put_contents( $file, $get['body'] );

				//	WP_Filesystem();
				//	global $wp_filesystem;

					$upload_dir = wp_upload_dir();
					//$d_path = WP_PLUGIN_DIR;
                                        $d_path = RS_PLUGIN_PATH  . '/addons/';
                                        if(class_exists("ZipArchive")){
					//   var_dump($d_path);var_dump($exactfilepath);die();
                                                $zip = new ZipArchive;
                                                $unzipfile = $zip->open($file, ZIPARCHIVE::CREATE); 
                                                $zip->extractTo($d_path); 
                                        } 
       		  
					@unlink($file);
					die('1');
				}
				//$result = activate_plugin( $plugin_slug.'/'.$plugin_slug.'.php' );
			}
			else{
				die( '0' );
			}
		
	}

} // END of class