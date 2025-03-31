document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("career-quiz-form");
    const resultContainer = document.getElementById("career-quiz-result");

    if (!form || !resultContainer) {
        console.error("Career Quiz: Required elements not found.");
        return;
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        let totalScore = 0;
        let selectedOptions = document.querySelectorAll("input[type=radio]:checked");

        if (selectedOptions.length === 0) {
            resultContainer.innerHTML = "<p>Please answer all questions before submitting.</p>";
            return;
        }

        selectedOptions.forEach(option => {
            totalScore += parseInt(option.value);
        });

        let recommendation = totalScore > 10 ? "Engineering or Data Science" : "Arts or Business";
        resultContainer.innerHTML = `<h3>Recommended Career Path: ${recommendation}</h3>`;
    });
});
