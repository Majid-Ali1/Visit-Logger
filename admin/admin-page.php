<?php

add_action('admin_menu', function () {
    add_menu_page('Visit Logger', 'Visit Logger', 'manage_options', 'visit-logger', 'vl_admin_page');
});

function vl_admin_page() {
    global $wpdb;

    $table = $wpdb->prefix . 'vl_logs';
    $logs = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 20");

    echo "<h1>Visit Logs</h1>";

    foreach ($logs as $log) {
        echo "<p>{$log->ip} - {$log->visited_at}</p>";
    }
}