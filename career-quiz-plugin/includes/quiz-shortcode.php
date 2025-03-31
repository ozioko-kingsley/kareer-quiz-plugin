<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Shortcode to display the quiz
function career_quiz_shortcode() {
    ob_start();
    $questions = get_career_quiz_questions();
    ?>
    <div id="career-quiz-container">
        <h2>Career Quiz</h2>
        <form id="career-quiz-form">
            <?php foreach ($questions as $index => $q) : ?>
                <div class="quiz-question">
                    <p><?php echo esc_html($q['question']); ?></p>
                    <?php foreach ($q['options'] as $opt) : ?>
                        <label>
                            <input type="radio" name="question<?php echo $index; ?>" value="<?php echo esc_attr($opt['score']); ?>">
                            <?php echo esc_html($opt['text']); ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit">Get Recommendation</button>
        </form>
        <div id="career-quiz-result"></div>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#career-quiz-form').submit(function(e) {
            e.preventDefault();
            let totalScore = 0;
            $('input[type=radio]:checked').each(function() {
                totalScore += parseInt($(this).val());
            });
            let recommendation = totalScore > 10 ? 'Engineering or Data Science' : 'Arts or Business';
            $('#career-quiz-result').html('<h3>Recommended Career Path: ' + recommendation + '</h3>');
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('career_quiz', 'career_quiz_shortcode');
?>