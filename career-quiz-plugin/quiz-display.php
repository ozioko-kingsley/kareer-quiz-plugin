<?php
/**
 * Handles the display logic for the Career Quiz.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function render_career_quiz() {
    ob_start();
    ?>
    <div id="career-quiz-container">
        <form id="career-quiz-form">
            <div id="quiz-questions"></div>
            <button type="submit">Submit</button>
        </form>
        <div id="quiz-result"></div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const questions = [
                { question: "What is your favorite subject?", options: ["Math", "Science", "Arts", "Sports"] },
                { question: "Do you prefer working in teams or alone?", options: ["Teams", "Alone"] },
                { question: "Do you like problem-solving?", options: ["Yes", "No"] }
            ];
            
            const quizContainer = document.getElementById("quiz-questions");
            questions.forEach((q, index) => {
                let div = document.createElement("div");
                div.innerHTML = `<p>${q.question}</p>`;
                q.options.forEach(option => {
                    div.innerHTML += `<label><input type='radio' name='q${index}' value='${option}'> ${option}</label><br>`;
                });
                quizContainer.appendChild(div);
            });

            document.getElementById("career-quiz-form").addEventListener("submit", function (e) {
                e.preventDefault();
                document.getElementById("quiz-result").innerHTML = "Thank you for completing the quiz! Your result will be processed soon.";
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('career_quiz', 'render_career_quiz');
