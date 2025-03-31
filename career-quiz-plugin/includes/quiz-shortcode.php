<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Ensure get_career_quiz_questions() exists to avoid errors
if (!function_exists('get_career_quiz_questions')) {
    function get_career_quiz_questions() {
        return [
            [
                'question' => 'What type of work do you enjoy most?',
                'options' => [
                    ['text' => 'Tech', 'score' => 5],
                    ['text' => 'Health', 'score' => 4],
                    ['text' => 'Arts', 'score' => 3]
                ]
            ],
            [
                'question' => 'Do you prefer working with people or independently?',
                'options' => [
                    ['text' => 'People', 'score' => 4],
                    ['text' => 'Independently', 'score' => 5]
                ]
            ],
            [
                'question' => 'What is your preferred work environment?',
                'options' => [
                    ['text' => 'Office', 'score' => 4],
                    ['text' => 'Remote', 'score' => 5],
                    ['text' => 'Field', 'score' => 3]
                ]
            ]
        ];
    }
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
                            <input type="radio" name="question<?php echo esc_attr($index); ?>" value="<?php echo esc_attr($opt['score']); ?>">
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
    (function($) {
        $(document).ready(function() {
            $('#career-quiz-form').submit(function(e) {
                e.preventDefault();
                let totalScore = 0;
                let selectedOptions = $('input[type=radio]:checked');

                if (selectedOptions.length === 0) {
                    $('#career-quiz-result').html('<p>Please answer all questions before submitting.</p>');
                    return;
                }

                selectedOptions.each(function() {
                    totalScore += parseInt($(this).val()) || 0;
                });

                let recommendation = totalScore > 10 ? 'Engineering or Data Science' : 'Arts or Business';
                $('#career-quiz-result').html('<h3>Recommended Career Path: ' + recommendation + '</h3>');
            });
        });
    })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('career_quiz', 'career_quiz_shortcode');
