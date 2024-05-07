<?php


/**
 *
 * Plugin Name:       RMK Events Plugin
 * Description:       Events management system
 * Version:           1.0.0
 * Author:            Aleksandr Popenov
 */


// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function activate_rmk_events()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-rmk-events-activator.php';
    Rmk_Events_Activator::activate();
}

function deactivate_rmk_events() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-rmk-events-deactivator.php';
    Rmk_Events_Deactivator::deactivate();
}

register_activation_hook(
    __FILE__,
    'activate_rmk_events'
);

register_deactivation_hook(
    __FILE__,
    'deactivate_rmk_events'
);

/**
 * Custom plugin post fields.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rmk-events-metabox.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rmk-events.php';


function run_rmk_events() {
    $plugin = new Rmk_Events();
    $plugin->run();
}

run_rmk_events();