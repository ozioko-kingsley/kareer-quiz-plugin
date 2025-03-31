<?php
/**
 * Plugin Name: Career Quiz Plugin
 * Plugin URI: https://github.com/ozioko-kingsley/kareer-quiz-plugin
 * Description: A simple career quiz plugin that recommends career paths based on user responses.
 * Version: 1.0
 * Author: Kingsley Ozioko
 * Author URI: https://skilllink.infinityfreeapp.com/
 * License: GPL2
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue scripts and styles
function career_quiz_enqueue_assets() {
    wp_enqueue_style('career-quiz-style', plugin_dir_url(__FILE__) . 'assets/css/career-quiz.css');
    wp_enqueue_script('career-quiz-script', plugin_dir_url(__FILE__) . 'assets/js/career-quiz.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'career_quiz_enqueue_assets');

// Include required files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/quiz-display.php';

// Shortcode to display the quiz
function career_quiz_shortcode() {
    ob_start();
    career_quiz_display();
    return ob_get_clean();
}
add_shortcode('career_quiz', 'career_quiz_shortcode');

// Register plugin menu
function career_quiz_admin_menu() {
    add_menu_page(
        'Career Quiz Settings',
        'Career Quiz',
        'manage_options',
        'career-quiz-settings',
        'career_quiz_settings_page',
        'dashicons-welcome-learn-more',
        20
    );
}
add_action('admin_menu', 'career_quiz_admin_menu');

// Register plugin settings
function career_quiz_register_settings() {
    register_setting('career_quiz_options_group', 'career_quiz_questions');
    add_settings_section('career_quiz_main_section', 'Quiz Questions', null, 'career-quiz-settings');
    add_settings_field('career_quiz_questions_field', 'Enter Questions (JSON format)', 'career_quiz_questions_callback', 'career-quiz-settings', 'career_quiz_main_section');
}
add_action('admin_init', 'career_quiz_register_settings');

// Settings field callback
function career_quiz_questions_callback() {
    $questions = get_option('career_quiz_questions', '[]');
    echo '<textarea name="career_quiz_questions" rows="10" cols="50" class="large-text code">' . esc_textarea($questions) . '</textarea>';
}
