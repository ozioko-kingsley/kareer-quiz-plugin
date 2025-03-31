document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("career-quiz-form");
    const resultContainer = document.getElementById("career-quiz-result");

    if (!form || !resultContainer) {
        console.error("Career Quiz: Required elements not found.");
        return;
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        let totalScore = 0;
        let questions = document.querySelectorAll(".quiz-question");
        let allAnswered = true;

        questions.forEach(question => {
            let selectedOption = question.querySelector("input[type=radio]:checked");

            if (!selectedOption) {
                allAnswered = false;
            } else {
                let value = parseInt(selectedOption.value) || 0;
                totalScore += value;
            }
        });

        if (!allAnswered) {
            resultContainer.innerHTML = `<p style="color: red;">Please answer all questions before submitting.</p>`;
            return;
        }

        // Career recommendation logic
        let recommendation;
        if (totalScore >= 15) {
            recommendation = "Engineering, Data Science, or Technology";
        } else if (totalScore >= 8) {
            recommendation = "Business, Marketing, or Management";
        } else {
            recommendation = "Arts, Humanities, or Creative Fields";
        }

        resultContainer.innerHTML = `<h3>Recommended Career Path: ${recommendation}</h3>`;
    });
});
