<?php
/**
 * Handles database interactions for the Career Quiz Plugin.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Function to create a database table if needed
function career_quiz_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'career_quiz_results';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT(20) UNSIGNED NULL,
        score INT NOT NULL,
        recommendation VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// Function to save quiz results
function career_quiz_save_result($user_id, $score, $recommendation) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'career_quiz_results';

    $wpdb->insert(
        $table_name,
        [
            'user_id' => $user_id ?: NULL, // Allow NULL for guests
            'score' => $score,
            'recommendation' => sanitize_text_field($recommendation),
        ],
        ['%d', '%d', '%s']
    );
}

// Function to retrieve quiz results
function career_quiz_get_results($user_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'career_quiz_results';

    return $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name WHERE user_id = %d ORDER BY created_at DESC",
        $user_id
    ));
}
