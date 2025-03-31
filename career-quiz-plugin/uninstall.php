<?php
// If uninstall not called from WordPress, exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete stored options
delete_option('career_quiz_questions');

global $wpdb;

// Remove custom data if necessary (modify as needed)
$table_name = $wpdb->prefix . 'career_quiz_results';
$wpdb->query("DROP TABLE IF EXISTS $table_name");
