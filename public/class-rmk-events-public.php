<?php

/**
 * The public-facing functionality of the plugin.
 *
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 */
class Rmk_Events_Public
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
     * Plugin content output filename.
     */
    const EVENT_CONTENT_FILENAME = 'template-events-listing.php';

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles()
    {

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rmk-events-public.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     */
    public function enqueue_scripts()
    {

//        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );

    }

    /**
     * Add custom templates to the existing templates array.
     *
     * @param $templates
     * @return array
     */
    public function plugin_add_templates($templates)
    {
        $plugin_templates = array(
            self::EVENT_CONTENT_FILENAME => 'RMK Events',
        );
        return array_merge($templates, $plugin_templates);
    }


    /**
     * Retrieves the content for the RMK Events plugin.
     *
     * @param $template
     * @return mixed|string
     */
    public function rmk_events_content($template)
    {
        $post = get_post();
        $page_template_slug = get_page_template_slug($post->ID);

        if (self::EVENT_CONTENT_FILENAME === $page_template_slug) {
            $plugin_path = plugin_dir_path(__FILE__) . 'partials/' . self::EVENT_CONTENT_FILENAME;
            if (file_exists($plugin_path)) {
                return $plugin_path;
            }
        }

        return $template;

    }

}