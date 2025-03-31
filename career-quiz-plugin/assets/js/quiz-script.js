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
                let value = Number(selectedOption.value); // More reliable than parseInt()
                totalScore += isNaN(value) ? 0 : value;
            }
        });

        if (!allAnswered) {
            resultContainer.innerHTML = `<p style="color: red;">Please answer all questions before submitting.</p>`;
            return;
        }

        // Career recommendation logic
        let recommendation = totalScore >= 15 
            ? "Engineering, Data Science, or Technology" 
            : totalScore >= 8 
            ? "Business, Marketing, or Management" 
            : "Arts, Humanities, or Creative Fields";

        resultContainer.innerHTML = `<h3>Recommended Career Path: ${recommendation}</h3>`;
    });
});
