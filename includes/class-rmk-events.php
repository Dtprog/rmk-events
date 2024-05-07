<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 */
class Rmk_Events
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @access   protected
     * @var      Rmk_Events_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @access   protected
     * @var      string $rmk_events The string used to uniquely identify this plugin.
     */
    protected $rmk_events;

    /**
     * The current version of the plugin.
     *
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     */
    public function __construct()
    {
        if (defined('RMK_EVENTS_VERSION')) {
            $this->version = RMK_EVENTS_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->rmk_events = 'rmk-events';

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Rmk_Test_Loader. Orchestrates the hooks of the plugin.
     * - Rmk_Test_i18n. Defines internationalization functionality.
     * - Rmk_Test_Admin. Defines all hooks for the admin area.
     * - Rmk_Test_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rmk-events-loader.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rmk-events-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-rmk-events-public.php';


        $this->loader = new Rmk_Events_Loader();

    }

    /**
     * Register all the hooks related to the admin area functionality
     * of the plugin.
     *
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Rmk_Events_Admin($this->get_rmk_events(), $this->get_version());

        $this->loader->add_action('init', $plugin_admin, 'events_custom_post_type');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all the hooks related to the public-facing functionality of the plugin.
     *
     * @access   private
     */
    private function define_public_hooks()
    {

		$plugin_public = new Rmk_Events_Public( $this->get_rmk_events(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
//		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        $this->loader->add_filter('theme_page_templates', $plugin_public, 'plugin_add_templates');
        $this->loader->add_filter('page_template', $plugin_public, 'rmk_events_content');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     */
    public function get_rmk_events()
    {
        return $this->rmk_events;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Rmk_Events_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

}
