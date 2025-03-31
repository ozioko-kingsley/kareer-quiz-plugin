<?php
/**
 * Quiz Template
 * Provides the HTML markup for the Career Quiz UI
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function career_quiz_template() {
    ob_start(); ?>
    <div id="career-quiz-container">
        <h2>Career Quiz</h2>
        <form id="career-quiz-form">
            <div id="career-quiz-questions"></div>
            <button type="submit">Get Recommendation</button>
        </form>
        <div id="career-quiz-result"></div>
    </div>
    <?php return ob_get_clean();
}
?>

