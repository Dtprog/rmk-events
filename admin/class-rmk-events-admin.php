<?php

/**
 * The admin-specific functionality of the plugin.
 *
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 */
class Rmk_Events_Admin
{

    /**
     * The ID of this plugin.
     *
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the JavaScript for the admin area.
     *
     */
    public function enqueue_scripts() {

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meta-box-image.js', array( 'jquery' ), $this->version, false );

    }

    /**
     * Registers a custom post type for events.
     *
     * @return void
     */
    public function events_custom_post_type()
    {
        register_post_type('events',
            [
                'labels' => array(
                    'name' => 'Events',
                    'singular_name' => 'Event',
                    'add_new_item' => 'Add new Event'
                ),
                'description' => 'Here you can add posts about events',
                'has_archive' => false,
                'public' => true,
                'show_in_menu' => true,
                'show_in_nav_menus' => true,
                'show_in_admin_bar' => true,
                'rewrite' => array('slug' => 'rmk-events'),
                'supports' => array('title', 'editor')
            ]
        );
    }

}
