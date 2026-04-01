<?php
/**
 * Plugin Name: Visit Logger
 * Description: Logs page visits.
 * Version: 1.0.2
 */

if (!defined('ABSPATH')) exit;

/**
 * ========================
 * AUTO UPDATE SETUP
 * ========================
 */
require_once plugin_dir_path(__FILE__) . 'lib/updater/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$updateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/Majid-Ali1/Visit-Logger',
    __FILE__,
    'visit-logger'
);

$updateChecker->setBranch('main');


/**
 * ========================
 * CORE PLUGIN
 * ========================
 */
require_once plugin_dir_path(__FILE__) . 'includes/logger.php';
require_once plugin_dir_path(__FILE__) . 'admin/admin-page.php';

add_action('init', 'vl_log_visit');

function vl_log_visit() {
    if (!is_admin()) {
        vl_save_log();
    }
}


/**
 * ========================
 * DB TABLE
 * ========================
 */
register_activation_hook(__FILE__, 'vl_create_table');

function vl_create_table() {
    global $wpdb;

    $table = $wpdb->prefix . 'vl_logs';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id INT NOT NULL AUTO_INCREMENT,
        ip VARCHAR(100),
        visited_at DATETIME,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}