<?php

function vl_save_log() {
    global $wpdb;

    $table = $wpdb->prefix . 'vl_logs';

    $wpdb->insert($table, [
        'ip' => $_SERVER['REMOTE_ADDR'],
        'visited_at' => current_time('mysql')
    ]);
}