<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Function to get quiz questions
function get_career_quiz_questions() {
    $questions_json = get_option('career_quiz_questions', '[]');
    return json_decode($questions_json, true);
}

// Function to calculate quiz results
function calculate_career_quiz_result($answers) {
    $totalScore = array_sum($answers);
    
    if ($totalScore > 10) {
        return 'Engineering or Data Science';
    } else {
        return 'Arts or Business';
    }
}
?>
